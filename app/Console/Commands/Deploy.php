<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Http;

class Deploy extends Command
{
  protected $signature = 'deploy';

  protected $description = 'Publish the application';

  public function handle()
  {
    // Call the artisan command "export"
    $this->call('export');
        
    // For some stupid reason, the pages "mentions-legales" and "politique-de-confidentialite" have set the 
    // wrong locale in the html tag. We need to fix this by copying the correct html from the live site.
    $this->fixMissingPages();

    // Search for all occurrences of the string "https://pwa.arenenberg.ch.test" and replace it with ENV('APP_URL_PROD') in the dist folder
    $this->replaceInDist('https://pwa.arenenberg.ch.test', env('APP_URL_PROD'));
  }

  protected function replaceInDist($search, $replace)
  {
    $distPath = base_path('dist');
    $iterator = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($distPath, RecursiveDirectoryIterator::SKIP_DOTS),
      RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $file)
    {
      if ($file->isFile() && $file->getExtension() === 'html')
      {
        $filePath = $file->getPathname();
        $content = file_get_contents($filePath);
        
        // Replace the search string with the replace string
        $newContent = str_replace($search, $replace, $content);
        
        if ($content !== $newContent)
        {
          file_put_contents($filePath, $newContent);
        }
        
        // Update all links in the HTML to add /index.html at the end if needed
        $this->addIndexHtmlToLinks($filePath);
      }
    }

    $this->info("Replaced '{$search}' with '{$replace}' in the dist folder");
  }
  
  protected function addIndexHtmlToLinks($filePath)
  {
    $htmlContent = file_get_contents($filePath);
    $originalContent = $htmlContent;
    $modified = false;
    
    // Find all a href links
    if (preg_match_all('/<a\s+[^>]*href=["\'](.*?)["\'][^>]*>/i', $htmlContent, $matches)) {
      foreach ($matches[1] as $link) {
        // Skip links that:
        // - are absolute URLs with protocol (http://, https://, etc.)
        // - are anchor links (#)
        // - are mailto: links
        // - are tel: links
        // - already end with .html
        // - have query parameters or fragments
        if (
          preg_match('/^(https?:|mailto:|tel:|#|javascript:)/i', $link) || 
          preg_match('/\.(html|php|pdf|jpg|jpeg|png|gif|svg|js|css)(\?|#|$)/i', $link) ||
          strpos($link, '?') !== false ||
          strpos($link, '#') !== false
        ) {
          continue;
        }
        
        // Prepare the new link
        $newLink = rtrim($link, '/');
        
        // Only add /index.html if it doesn't already have it
        if (!preg_match('/\/index\.html$/', $newLink)) {
          $newLink .= '/index.html';
          
          // Replace this specific link in the HTML content
          // Use word boundaries to ensure we're replacing the exact link
          $htmlContent = str_replace('href="' . $link . '"', 'href="' . $newLink . '"', $htmlContent);
          $htmlContent = str_replace("href='" . $link . "'", "href='" . $newLink . "'", $htmlContent);
          $modified = true;
        }
      }
    }
    
    // Only write the file if we made changes
    if ($modified && $originalContent !== $htmlContent) {
      file_put_contents($filePath, $htmlContent);
      $this->info("Updated links in file: " . $filePath);
    }
  }

  protected function fixMissingPages()
  {
    $this->info('Start fixing missing pages');

    $routes = [
      // de
      'zugang',
      'standorte',
      'standorte/liste',
      'standorte/karte',
      'standorte/arenenberger-vielfalt',
      'standorte/milch-mit-zukunft',
      'standorte/vom-acker-auf-den-tisch',
      'standorte/wundervolle-gartenwelt',
      'standorte/kaiserliches-leben',
      // fr
      'fr',
      'fr/acces',
      'fr/sites/liste',
      'fr/sites/carte',
      // @todo: add locations

      // en
      'en',
      'en/access',
      'en/locations/list',
      'en/locations/map',
      // @todo: add locations
    ];

    // Get the content for the entries in $routes
    foreach ($routes as $route)
    {
      $url = env('APP_URL') . '/' . $route;
      $content = Http::get($url)->body();
      
      // Save the content to the dist folder
      // $route is the folder, index.html is the file
      $filePath = base_path('dist/' . $route . '/index.html');
      file_put_contents($filePath, $content);
    }

    $this->info('Finished fixing missing pages');
  }
}