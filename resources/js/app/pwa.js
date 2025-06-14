/**
 * Arenenberg PWA Application
 * Main JavaScript file for PWA functionality including authentication,
 * resource caching, and service worker management.
 */

// =======================================================
// Configuration Constants
// =======================================================
const ASSETS = [

  '/audio/de/kaiserliches-leben.mp3',
  '/audio/de/milch-mit-zukunft.mp3',
  '/audio/de/vom-acker-auf-den-tisch.mp3',
  '/audio/de/wundervolle-gartenwelt.mp3',
  '/audio/fr/kaiserliches-leben.mp3',
  '/audio/fr/milch-mit-zukunft.mp3',
  '/audio/fr/vom-acker-auf-den-tisch.mp3',
  '/audio/fr/wundervolle-gartenwelt.mp3',
  '/audio/en/kaiserliches-leben.mp3',
  '/audio/en/milch-mit-zukunft.mp3',
  '/audio/en/vom-acker-auf-den-tisch.mp3',
  '/audio/en/wundervolle-gartenwelt.mp3',

	'/apple-touch-icon.png',
	'/build/assets/GT-Alpina-Standard-Medium.woff',
	'/build/assets/GT-Alpina-Standard-Medium.woff2',
  '/build/assets/GT-Alpina-Standard-Bold.woff',
	'/build/assets/GT-Alpina-Standard-Bold.woff2',
	'/build/assets/app.css',
	'/build/assets/app.js',
	'/build/manifest.json',
	'/en/access/index.html',
	'/en/download/index.html',
	'/en/index.html',
	'/en/locations/list/index.html',
	'/en/locations/map/index.html',
	'/en/standorte/arenenberger-vielfalt/index.html',
	'/en/standorte/kaiserliches-leben/index.html',
	'/en/standorte/milch-mit-zukunft/index.html',
	'/en/standorte/vom-acker-auf-den-tisch/index.html',
	'/en/standorte/wundervolle-gartenwelt/index.html',
	'/favicon-96x96.png',
	'/favicon.ico',
	'/favicon.svg',
	'/fr/acces/index.html',
	'/fr/download/index.html',
	'/fr/index.html',
	'/fr/sites/carte/index.html',
	'/fr/sites/liste/index.html',
	'/fr/standorte/arenenberger-vielfalt/index.html',
	'/fr/standorte/kaiserliches-leben/index.html',
	'/fr/standorte/milch-mit-zukunft/index.html',
	'/fr/standorte/vom-acker-auf-den-tisch/index.html',
	'/fr/standorte/wundervolle-gartenwelt/index.html',
	'/img/map.png',
	'/img/visual-home.png',
  '/img/visual-arenenberger-vielfalt.png',
  '/img/visual-kaiserliches-leben.png',
  '/img/visual-milch-mit-zukunft.png',
  '/img/visual-vom-acker-auf-den-tisch.png',
  '/img/visual-wundervolle-gartenwelt.png',
	'/index.html',
	'/robots.txt',
	'/site.webmanifest',
	'/standorte/arenenberger-vielfalt/index.html',
	'/standorte/kaiserliches-leben/index.html',
	'/standorte/karte/index.html',
	'/standorte/liste/index.html',
	'/standorte/milch-mit-zukunft/index.html',
	'/standorte/vom-acker-auf-den-tisch/index.html',
	'/standorte/wundervolle-gartenwelt/index.html',
	'/web-app-manifest-192x192.png',
	'/web-app-manifest-512x512.png',
	'/zugang/index.html',
	'/download/index.html'
];

const AUDIO_FILES = {
  de: [
    '/audio/de/kaiserliches-leben.mp3',
    '/audio/de/milch-mit-zukunft.mp3',
    '/audio/de/vom-acker-auf-den-tisch.mp3',
    '/audio/de/wundervolle-gartenwelt.mp3'
  ],
  fr: [
    '/audio/fr/kaiserliches-leben.mp3',
    '/audio/fr/milch-mit-zukunft.mp3',
    '/audio/fr/vom-acker-auf-den-tisch.mp3',
    '/audio/fr/wundervolle-gartenwelt.mp3'
  ],
  en: [
    '/audio/en/kaiserliches-leben.mp3',
    '/audio/en/milch-mit-zukunft.mp3',
    '/audio/en/vom-acker-auf-den-tisch.mp3',
    '/audio/en/wundervolle-gartenwelt.mp3'
  ]
};

const CACHE_NAME = `arenenberg-assets-v1.0.0`;
const COOKIE_NAME = 'arenenberg-auth';

// Paths excluded from service worker registration
const EXCLUDED_SW_PATHS = [
	'/', 
	'/index.html', 
	'/fr/index.html', 
	'/en/index.html',
	'/zugang/index.html',
	'/en/access/index.html',
	'/fr/acces/index.html'
];

// Paths excluded from authentication check
const EXCLUDED_AUTH_PATHS = [
	'/',
	'/index.html',
	'/zugang/',
	'/zugang/index.html',
	'/fr/index.html',
	'/fr/acces/',
	'/fr/acces/index.html',
	'/en/index.html',
	'/en/access/',
	'/en/access/index.html'
];

// Download page paths
const DOWNLOAD_PATHS = [
	'/download/index.html',
	'/fr/download/index.html',
	'/en/download/index.html'
];

// =======================================================
// Cookie & Authentication Functions
// =======================================================

/**
 * Sets a cookie with a specified expiration time
 */
const setCookie = (name, value, minutes) => {
	const date = new Date();
	date.setTime(date.getTime() + (minutes * 60 * 1000));
	const expires = `expires=${date.toUTCString()}`;
	document.cookie = `${name}=${value};${expires};path=/`;
};

/**
 * Gets a cookie value by name
 */
const getCookie = (name) => {
	const cookieName = `${name}=`;
	const cookies = document.cookie.split(';');
	for (let cookie of cookies) {
		cookie = cookie.trim();
		if (cookie.startsWith(cookieName)) {
			return cookie.substring(cookieName.length, cookie.length);
		}
	}
	return '';
};

/**
 * Validates password against stored password
 */
const validatePassword = async (password) => {
	try {
		const response = await fetch('/validate.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ password })
		});
		if (!response.ok) {
			console.error('Server error:', response.status);
			return false;
		}
		const result = await response.json();
		return result.valid === true;
	} 
  catch (error) {
		console.error('Password validation failed:', error);
		return false;
	}
};

/**
 * Checks if user is authenticated, redirects if not
 */
const checkAuth = () => {
	const authCookie = getCookie(COOKIE_NAME);
	if (!authCookie) {
		window.location.href = '/index.html'; // Redirect to index.html if not authenticated
	}
};

/**
 * Returns the language code based on the current path
 * @returns {string} 'de', 'fr', or 'en'
 */
const getLanguageFromPath = () => {
  const path = window.location.pathname;
  if (path.startsWith('/fr/')) return 'fr';
  if (path.startsWith('/en/')) return 'en';
  return 'de'; // default/fallback
};

// =======================================================
// Caching Functions
// =======================================================

/**
 * Caches all assets defined in ASSETS array
 */
const cacheAllAssets = async () => {
  const cacheProgress = document.querySelector('[data-cache-progress]');
  const cacheProgressBar = document.querySelector('[data-cache-progress-bar]');
  const resourceLoader = document.querySelector('[data-resources-loader]');
  const successSection = document.querySelector('[data-success-section]');

  if (resourceLoader) {
    resourceLoader.classList.remove('hidden');
    resourceLoader.classList.add('flex');
  }

  try {
    const cache = await caches.open(CACHE_NAME);
    // temp: removed separated audio caching

    // const lang = getLanguageFromPath();
    // const audioAssets = AUDIO_FILES[lang] || [];
    // markLanguageAsCached(lang);
    // const finalAssetsToCache = [...ASSETS, ...audioAssets];
    // const totalAssets = finalAssetsToCache.length;

    // -- temp: removed separated audio caching

    // temp: caching all assets
    const finalAssetsToCache = ASSETS;
    const totalAssets = finalAssetsToCache.length;
    let cached = 0;

    if (cacheProgress) {
      cacheProgress.textContent = `0%`;
    }

    for (const asset of finalAssetsToCache) {
      const response = await cache.match(asset);
      if (!response && navigator.onLine) {
        try {
          const networkResponse = await fetch(asset);
          if (networkResponse.ok) {
            await cache.put(asset, networkResponse.clone());
          }
          cached++;
        } catch (error) {
          console.error(`Failed to cache ${asset}:`, error);
        }
      } else if (response) {
        cached++;
      }

      const progressPercentage = Math.round((cached / totalAssets) * 100);
      if (cacheProgressBar) {
        cacheProgressBar.value = progressPercentage;
      }
      if (cacheProgress) {
        cacheProgress.textContent = `${progressPercentage}%`;
      }
    }

    if (cacheProgress) {
      cacheProgress.textContent = `100%`;
    }

    if (resourceLoader) {
      resourceLoader.classList.remove('flex');
      resourceLoader.classList.add('hidden');
    }

    if (successSection) {
      successSection.classList.remove('hidden');
      successSection.classList.add('flex');
    }
  } catch (error) {
    console.error('Cache check failed:', error);
    if (cacheProgress) {
      cacheProgress.textContent = 'Cache check failed';
    }
  }
};

/**
 * Marks a language as cached in localStorage
 * @param {*} lang 
 */
const markLanguageAsCached = (lang) => {
  const cached = JSON.parse(localStorage.getItem('cachedLanguages') || '[]');
  if (!cached.includes(lang)) {
    cached.push(lang);
    localStorage.setItem('cachedLanguages', JSON.stringify(cached));
  }
};

/**
 * Gets the list of cached languages from localStorage
 * @returns {Array} Array of cached languages
 */
const getCachedLanguages = () => {
  return JSON.parse(localStorage.getItem('cachedLanguages') || '[]');
};

/**
 * Sets up language switching functionality
 * Disables language links that are not cached when offline
 */
const setupLanguageSwitching = () => {
  const links = document.querySelectorAll('[data-language]');
  const isOffline = !navigator.onLine;
  const cachedLangs = getCachedLanguages();

  links.forEach(link => {
    const lang = link.getAttribute('data-language');

    // If offline and language not cached, disable the link
    if (isOffline && !cachedLangs.includes(lang)) {
      link.classList.add('!opacity-50', '!pointer-events-none');
      link.setAttribute('title', 'Language not available offline');
    } else {
      // Optional: remove restrictions if reloading while online
      link.classList.remove('opacity-50', 'pointer-events-none');
      link.removeAttribute('title');
    }
  });
};

// const cacheAllAssets = async () => {
// 	const cacheProgress = document.querySelector('[data-cache-progress]');
// 	const cacheProgressBar = document.querySelector('[data-cache-progress-bar]');
// 	const resourceLoader = document.querySelector('[data-resources-loader]');
// 	const successSection = document.querySelector('[data-success-section]');

// 	if (resourceLoader) {
// 		resourceLoader.classList.remove('hidden');
// 		resourceLoader.classList.add('flex');
// 	}

// 	try {
// 		const cache = await caches.open(CACHE_NAME);
// 		let cached = 0;
// 		const totalAssets = ASSETS.length;

// 		// Update progress text initially
// 		if (cacheProgress) {
// 			cacheProgress.textContent = `0%`;
// 		}

// 		for (const asset of ASSETS) {
// 			const response = await cache.match(asset);
// 			if (!response && navigator.onLine) {
// 				try {
// 					const networkResponse = await fetch(asset);
// 					await cache.put(asset, networkResponse.clone());
// 					cached++;
// 				} catch (error) {
// 					console.error(`Failed to cache ${asset}:`, error);
// 				}
// 			} else if (response) {
// 				cached++;
// 			}
			
// 			// Calculate percentage
// 			const progressPercentage = Math.round((cached / totalAssets) * 100);
			
// 			// Update custom progress bar
// 			if (cacheProgressBar) {
// 				cacheProgressBar.value = progressPercentage;
// 			}
			
// 			// Update progress text with percentage
// 			if (cacheProgress) {
// 				cacheProgress.textContent = `${progressPercentage}%`;
// 			}
// 		}

// 		// Final progress update
// 		if (cacheProgress) {
// 			cacheProgress.textContent = `100%`;

// 			// Hide resources loader and show success section
// 			if (resourceLoader) {
// 				resourceLoader.classList.remove('flex');
// 				resourceLoader.classList.add('hidden');
// 			}

// 			if (successSection) {
// 				successSection.classList.remove('hidden');
// 				successSection.classList.add('flex');
// 			}
// 		}
// 	} catch (error) {
// 		console.error('Cache check failed:', error);
// 		if (cacheProgress) {
// 			cacheProgress.textContent = 'Cache check failed';
// 		}
// 	}
// };

// =======================================================
// Service Worker Management
// =======================================================

/**
 * Registers service worker if not on excluded paths
 */
const registerServiceWorker = () => {
	if (!('serviceWorker' in navigator)) return;

	window.addEventListener('load', () => {
		// Get the current path
		const currentPath = window.location.pathname;
		
		// Check if the current path is in our excluded list
		if (EXCLUDED_SW_PATHS.includes(currentPath)) {
			console.log('Service Worker registration skipped for excluded path:', currentPath);
			return; // Skip registration
		}
		
		// Register the service worker for all other paths
		navigator.serviceWorker.register('/sw.js')
			.then((registration) => {
				console.log('Service Worker registered with scope:', registration.scope);
			})
			.catch((error) => {
				console.error('Service Worker registration failed:', error);
			});
	});
};

/**
 * Unregisters all service workers and clears all caches
 */
const cleanupServiceWorkerAndCaches = async () => {
	// Unregister all service workers
	if ('serviceWorker' in navigator) {
		const registrations = await navigator.serviceWorker.getRegistrations();
		for (const registration of registrations) {
			await registration.unregister();
			console.log('Service Worker unregistered');
		}
	}
	
	// Clear all caches
	if ('caches' in window) {
		const cacheNames = await caches.keys();
		for (const cacheName of cacheNames) {
			await caches.delete(cacheName);
			console.log(`Cache '${cacheName}' deleted`);
		}
	}
	
	console.log('Service workers and caches cleaned up');
};

// =======================================================
// UI Event Handlers
// =======================================================

/**
 * Initializes access code input fields and form handling
 */
const initAccessForm = () => {
	const inputs = document.querySelectorAll('[data-access-input]');
	const form = document.querySelector('[data-access-form]');
	
	// Return if no inputs or form
	if (!inputs || !form) {
		return;
	}
	
	// Focus first input on page load
	inputs[0].focus();
	
	// Handle input events
	inputs.forEach((input, index) => {
		// Only allow single digit
		input.addEventListener('input', function() {
			if (this.value.length > 1) {
				this.value = this.value.slice(0, 1);
			}
			
			// Auto-move to next input
			if (this.value.length === 1 && index < inputs.length - 1) {
				inputs[index + 1].focus();
			}
		});
		
		// Handle backspace
		input.addEventListener('keydown', function(e) {
			if (e.key === 'Backspace' && this.value === '' && index > 0) {
				inputs[index - 1].focus();
			}
		});
	});
	
	// Handle form submission
	form.addEventListener('submit', async function(e) {
		e.preventDefault();
		
		// Combine all input values to form the passcode
		const passcode = Array.from(inputs).map(input => input.value).join('');
		const accessError = document.querySelector('[data-access-error]');
		
		// Validate the passcode
		if (await validatePassword(passcode)) {
			// Set cookie for authentication
			setCookie(COOKIE_NAME, 'true', 60); // Set cookie for 60 minutes
			
			// Hide access form and show resources loader
			form.classList.remove('flex');
			form.classList.add('hidden');
			const resourcesLoader = document.querySelector('[data-resources-loader]');
			if (resourcesLoader) {
				resourcesLoader.classList.remove('hidden');
				resourcesLoader.classList.add('flex');
			}
			
			// Start caching assets
			cacheAllAssets();
		} else {
			// Show error message
			if (accessError) {
				accessError.classList.remove('hidden');
				
				// Clear input fields
				inputs.forEach(input => {
					input.value = '';
				});
				
				// Focus first input for easier retry
				inputs[0].focus();
			}
		}
	});
};

/**
 * Initializes access button for direct download page navigation
 */
const initAccessButton = () => {
	const accessButton = document.querySelector('[data-access-button]');
	const inputs = document.querySelectorAll('[data-access-input]');
	const accessError = document.querySelector('[data-access-error]');
	
	// Return if no button or inputs
	if (!accessButton || !inputs || inputs.length === 0) {
		return;
	}
	
	// Handle button click
	accessButton.addEventListener('click', async function(e) {
		e.preventDefault();
		
		// Get the redirect URL from the button
		const redirectUrl = this.getAttribute('href');
		if (!redirectUrl) {
			console.error('No redirect URL specified on access button');
			return;
		}
		
		// Combine all input values to form the passcode
		const passcode = Array.from(inputs).map(input => input.value).join('');
		
		// Validate the passcode
		if (await validatePassword(passcode)) {
      
			// Set cookie for 4320 minutes (3 days)
			setCookie(COOKIE_NAME, 'true', 4320);
			
			// Redirect to the download page
			window.location.href = redirectUrl;
		} 
    else {
			// Show error message
			if (accessError) {
				accessError.classList.remove('hidden');
				
				// Clear input fields
				inputs.forEach(input => {
					input.value = '';
				});
				
				// Focus first input for easier retry
				inputs[0].focus();
			}
		}
	});
};

/**
 * Initializes download page functionality
 */
const initDownloadPage = () => {
	const currentPath = window.location.pathname;
	
	// Check if we're on a download page
	if (DOWNLOAD_PATHS.includes(currentPath)) {
		// Start caching assets immediately
		cacheAllAssets();
	}
};

// =======================================================
// Access Page Handling
// =======================================================

/**
 * Redirects authenticated users from access pages to download pages
 */
const handleAccessPageRedirect = () => {
	const currentPath = window.location.pathname;
	const authCookie = getCookie(COOKIE_NAME);
	
	// Define access pages and their corresponding download pages
	const accessToDownloadMap = {
		'/zugang/index.html': '/download/index.html',
		'/en/access/index.html': '/en/download/index.html',
		'/fr/acces/index.html': '/fr/download/index.html'
	};
	
	// If user is authenticated and on an access page, redirect to download page
	if (authCookie && accessToDownloadMap[currentPath]) {
		window.location.href = accessToDownloadMap[currentPath];
	}
};

// =======================================================
// Application Initialization
// =======================================================

/**
 * Main initialization function
 */
const initApp = () => {
	const currentPath = window.location.pathname;
	const authCookie = getCookie(COOKIE_NAME);
	
	// Define homepage paths
	const homepagePaths = ['/', '/index.html', '/fr/index.html', '/en/index.html'];
	
	// If on homepage and not authenticated, clean up service workers and caches
	if (homepagePaths.includes(currentPath) && !authCookie) {
		cleanupServiceWorkerAndCaches();
	} else {
		// Register service worker for non-homepage or authenticated users
		registerServiceWorker();
	}
	
	// Check for authenticated users on access pages
	handleAccessPageRedirect();
	
	// Check authentication if not on excluded path
	if (!EXCLUDED_AUTH_PATHS.includes(currentPath)) {
		checkAuth();
	}
	
	// Initialize UI components
	document.addEventListener('DOMContentLoaded', () => {
		initAccessForm();
		initAccessButton();
		initDownloadPage();

    // Language switching, disabled for now
    // setupLanguageSwitching();
    // window.addEventListener('online', setupLanguageSwitching);
    // window.addEventListener('offline', setupLanguageSwitching);

	});
};

// Start the application
initApp();