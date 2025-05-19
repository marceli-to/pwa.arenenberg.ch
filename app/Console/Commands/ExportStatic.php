<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Http;

class ExportStatic extends Command
{
    protected $signature = 'export:static';
    protected $description = 'Export static HTML files and fix links for offline usage';
    protected $assetVersion;

    public function __construct()
    {
      parent::__construct();
      $this->assetVersion = env('ASSET_VERSION', 'dev');
    }

    // File extensions that should be excluded from link modification
    protected $excludedExtensions = [
        'html', 'php', 'css', 'js', 'svg', 'png', 'jpg', 'jpeg', 'gif', 'ico', 
        'pdf', 'mp3', 'mp4', 'woff', 'woff2', 'ttf', 'eot', 'txt', 'json', 'xml', 'webmanifest'
    ];

    public function handle()
    {
        $this->info('Starting static export process...');
        
        // Step 1: Call the export command to generate static files
        $this->call('export');
        
        // Step 2: Fix missing pages by fetching them from the live site
        $this->fixMissingPages();
        
        // Step 3: Replace test URL with production URL
        $this->replaceUrls();
        
        // Step 4: Add /index.html to links
        $this->fixLinks();
        
        // Step 5: Remove preload attributes
        $this->removePreloadAttributes();

        // Step 6: Update service worker
        // $this->updateServiceWorker();

        // Step 7: Copy validate.php to dist
        $this->copyValidationScript();
        
        $this->info('Static export completed successfully!');
    }

    /**
     * Fix missing pages by fetching them from the live site
     */
    protected function fixMissingPages()
    {
        $this->info('Fetching missing pages from live site...');

        $routes = [
            // German
            'zugang',
            'download',
            'standorte/liste',
            'standorte/karte',
            'standorte/arenenberger-vielfalt',
            'standorte/milch-mit-zukunft',
            'standorte/vom-acker-auf-den-tisch',
            'standorte/wundervolle-gartenwelt',
            'standorte/kaiserliches-leben',
            // French
            'fr',
            'fr/acces',
            'fr/download',
            'fr/sites/liste',
            'fr/sites/carte',
            'fr/standorte/arenenberger-vielfalt',
            'fr/standorte/milch-mit-zukunft',
            'fr/standorte/vom-acker-auf-den-tisch',
            'fr/standorte/wundervolle-gartenwelt',
            'fr/standorte/kaiserliches-leben',
            // English
            'en',
            'en/access',
            'en/download',
            'en/locations/list',
            'en/locations/map',
            'en/standorte/arenenberger-vielfalt',
            'en/standorte/milch-mit-zukunft',
            'en/standorte/vom-acker-auf-den-tisch',
            'en/standorte/wundervolle-gartenwelt',
            'en/standorte/kaiserliches-leben',
        ];

        $fetchedCount = 0;
        
        // Get the content for each route
        foreach ($routes as $route) {
            $url = env('APP_URL') . '/' . $route;
            
            try {
                $response = Http::get($url);
                
                if ($response->successful()) {
                    $content = $response->body();
                    
                    // Create directory if it doesn't exist
                    $dirPath = base_path('dist/' . $route);
                    if (!is_dir($dirPath)) {
                        mkdir($dirPath, 0755, true);
                    }
                    
                    // Save the content to the dist folder
                    $filePath = $dirPath . '/index.html';
                    file_put_contents($filePath, $content);
                    $fetchedCount++;
                } else {
                    $this->error("Failed to fetch {$url}: HTTP status " . $response->status());
                }
            } catch (\Exception $e) {
                $this->error("Error fetching {$url}: " . $e->getMessage());
            }
        }

        $this->info("Successfully fetched {$fetchedCount} pages");
    }

    /**
     * Replace test URLs with production URLs
     */
    protected function replaceUrls()
    {
        $this->info('Replacing test URLs with production URLs...');
        
        $searchUrl = 'https://pwa.arenenberg.ch.test';
        $replaceUrl = env('APP_URL_PROD');
        
        $distPath = base_path('dist');
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($distPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        $replacedCount = 0;
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'html') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);
                $newContent = str_replace($searchUrl, $replaceUrl, $content);
                
                if ($content !== $newContent) {
                    file_put_contents($filePath, $newContent);
                    $replacedCount++;
                }
            }
        }
        
        $this->info("Replaced URLs in {$replacedCount} files");
    }

    /**
     * Fix links by adding /index.html to appropriate URLs
     */
    protected function fixLinks()
    {
        $this->info('Adding /index.html to links...');
        
        $distPath = base_path('dist');
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($distPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        $filesProcessed = 0;
        $linksModified = 0;
        
        // Build the pattern for excluded extensions
        $extensionPattern = implode('|', array_map('preg_quote', $this->excludedExtensions));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'html') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);
                $originalContent = $content;
                $fileLinksModified = 0;
                
                // First, fix any links that already have /index.html incorrectly appended to file extensions
                $pattern = '/(href|src)=(["\'])([^"\']+\.(' . $extensionPattern . '))\/index\.html\2/i';
                $content = preg_replace_callback($pattern, function($matches) {
                    return $matches[1] . '=' . $matches[2] . $matches[3] . $matches[2];
                }, $content);
                
                // Now add /index.html to links that need it
                $linkPattern = '/(href|action)=(["\'])([^"\']+)\2/i';
                $content = preg_replace_callback($linkPattern, function($matches) use ($extensionPattern, &$fileLinksModified) {
                    $attribute = $matches[1]; // href or action
                    $quote = $matches[2]; // " or '
                    $url = $matches[3]; // the URL
                    
                    // Skip URLs that should not be modified
                    if (preg_match('/^(mailto:|tel:|javascript:|#|\/\/)/i', $url) || 
                        preg_match('/\.(' . $extensionPattern . ')(\?|#|$)/i', $url) ||
                        strpos($url, '?') !== false ||
                        strpos($url, '#') !== false ||
                        $url === '/' ||
                        strpos($url, '/index.html') !== false) {
                        return $matches[0]; // Return unchanged
                    }
                    
                    // For URLs with domain names
                    if (preg_match('/^https?:\/\//', $url)) {
                        $domain = parse_url($url, PHP_URL_HOST);
                        $path = parse_url($url, PHP_URL_PATH);
                        
                        // Skip if path already has index.html
                        if (strpos($path, '/index.html') !== false) {
                            return $matches[0]; // Return unchanged
                        }
                        
                        // Handle root domain URLs (empty path or just /)
                        if ($path === '/' || empty($path)) {
                            $newUrl = rtrim($url, '/') . '/index.html';
                            $fileLinksModified++;
                            return $attribute . '=' . $quote . $newUrl . $quote;
                        }
                        
                        // Prepare the new URL with /index.html
                        $path = rtrim($path, '/');
                        if (!empty($path)) {
                            $newPath = $path . '/index.html';
                            $newUrl = str_replace($path, $newPath, $url);
                            $fileLinksModified++;
                            return $attribute . '=' . $quote . $newUrl . $quote;
                        }
                    } else {
                        // Relative or absolute path without domain
                        $newUrl = rtrim($url, '/');
                        if (!empty($newUrl)) {
                            $newUrl .= '/index.html';
                            $fileLinksModified++;
                            return $attribute . '=' . $quote . $newUrl . $quote;
                        }
                    }
                    
                    return $matches[0]; // Return unchanged if we got here
                }, $content);
                
                // Only write to file if we made changes
                if ($content !== $originalContent) {
                    file_put_contents($filePath, $content);
                    $linksModified += $fileLinksModified;
                    
                    if ($fileLinksModified > 0) {
                        $this->line("Modified {$fileLinksModified} links in: " . $filePath);
                    }
                }
                
                $filesProcessed++;
            }
        }
        
        $this->info("Processed {$filesProcessed} HTML files");
        $this->info("Modified {$linksModified} links in total");
    }

    /**
     * Remove preload attributes from HTML files
     */
    protected function removePreloadAttributes()
    {
        $this->info('Removing preload attributes from HTML files...');
        
        $distPath = base_path('dist');
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($distPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        $filesProcessed = 0;
        $attributesRemoved = 0;
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'html') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);
                $originalContent = $content;
                $fileAttributesRemoved = 0;
                
                // Remove rel="preload" as="style"
                $pattern = '/\s+rel="preload"\s+as="style"/i';
                $newContent = preg_replace($pattern, '', $content);
                if ($newContent !== $content) {
                    $fileAttributesRemoved += substr_count($content, 'rel="preload" as="style"');
                    $content = $newContent;
                }
                
                // Remove data-navigate-track="reload"
                $pattern = '/\s+data-navigate-track="reload"/i';
                $newContent = preg_replace($pattern, '', $content);
                if ($newContent !== $content) {
                    $fileAttributesRemoved += substr_count($content, 'data-navigate-track="reload"');
                    $content = $newContent;
                }
                
                // Remove rel="modulepreload"
                $pattern = '/\s+rel="modulepreload"/i';
                $newContent = preg_replace($pattern, '', $content);
                if ($newContent !== $content) {
                    $fileAttributesRemoved += substr_count($content, 'rel="modulepreload"');
                    $content = $newContent;
                }
                
                // Remove <link href="https://pwa.arenenberg.ch.marceli.to/build/assets/app.js" />
                $pattern = '/<link\s+href="[^"]*\/build\/assets\/app\.js"[^>]*\/?>/i';
                $newContent = preg_replace($pattern, '', $content);
                if ($newContent !== $content) {
                    $fileAttributesRemoved += substr_count($content, '<link href="') - substr_count($newContent, '<link href="');
                    $content = $newContent;
                }
                
                // Also remove any empty link tags for app.css
                $pattern = '/<link\s+href="[^"]*\/build\/assets\/app\.css"[^>]*\/?>/i';
                $newContent = preg_replace($pattern, '', $content);
                if ($newContent !== $content) {
                    $fileAttributesRemoved += substr_count($content, '<link href="') - substr_count($newContent, '<link href="');
                    $content = $newContent;
                }
                
                // Only write to file if we made changes
                if ($content !== $originalContent) {
                    file_put_contents($filePath, $content);
                    $attributesRemoved += $fileAttributesRemoved;
                    
                    if ($fileAttributesRemoved > 0) {
                        $this->line("Removed {$fileAttributesRemoved} preload attributes/tags in: " . $filePath);
                    }
                }
                
                $filesProcessed++;
            }
        }
        
        $this->info("Processed {$filesProcessed} HTML files");
        $this->info("Removed {$attributesRemoved} preload attributes/tags in total");
    }

    protected function updateServiceWorker()
    {
        $this->info('Copying and updating service worker...');
    
        $source = public_path('sw.js');
        $target = base_path('dist/sw.js');
    
        if (!file_exists($source)) {
            $this->error("Source service worker not found at: {$source}");
            return;
        }
    
        // Copy sw.js from public to dist
        if (!copy($source, $target)) {
            $this->error("Failed to copy service worker from {$source} to {$target}");
            return;
        }
    
        // Replace placeholder with actual version
        $content = file_get_contents($target);
        $newContent = str_replace('__ASSET_VERSION__', $this->assetVersion, $content);
    
        if ($newContent !== $content) {
            file_put_contents($target, $newContent);
            $this->info("Service worker updated with version: {$this->assetVersion}");
        } else {
            $this->info("Service worker copied but no version replacement was needed");
        }
    }
    
    protected function copyValidationScript()
    {
        $this->info('Copying validate.php to dist...');

        $source = public_path('validate.php');
        $destination = base_path('dist/validate.php');

        if (!file_exists($source)) {
            $this->error("validate.php not found at: {$source}");
            return;
        }

        if (!copy($source, $destination)) {
            $this->error("Failed to copy validate.php to dist");
            return;
        }

        $this->info("validate.php successfully copied to dist");
    }

}
