const ASSETS = [
	'/apple-touch-icon.png',
	'/audio/arenenberger-vielfalt.mp3',
	// '/audio/kaiserliches-leben.mp3',
	// '/audio/milch-mit-zukunft.mp3',
	// '/audio/vom-acker-auf-den-tisch.mp3',
	// '/audio/wundervolle-gartenwelt.mp3',
	'/build/assets/GT-Alpina-Standard-Medium.woff',
	'/build/assets/GT-Alpina-Standard-Medium.woff2',
	'/build/assets/app.css',
	'/build/assets/app.js',
	'/build/assets/spa.css',
	'/build/assets/spa.js',
	'/build/manifest.json',
	'/en/access/index.html',
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
	'/img/visual-location.png',
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
];

const CACHE_NAME = 'arenenberg-assets-v13';

const COOKIE_NAME = 'arenenberg-auth';

const PASSWORD_PATH = '/password.txt';

const setCookie = (name, value, minutes) => {
	const date = new Date();
	date.setTime(date.getTime() + (minutes * 60 * 1000));
	const expires = `expires=${date.toUTCString()}`;
	document.cookie = `${name}=${value};${expires};path=/`;
};

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

const validatePassword = async (password) => {
	try {
		const response = await fetch(PASSWORD_PATH);
		const correctPassword = await response.text();
		return password === correctPassword.trim();
	} catch (error) {
		console.error('Failed to fetch password:', error);
		return false;
	}
};

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
    let cached = 0;
    const totalAssets = ASSETS.length;

    // Update progress text initially
    if (cacheProgress) {
      cacheProgress.textContent = `0%`;
    }

    for (const asset of ASSETS) {
      const response = await cache.match(asset);
      if (!response && navigator.onLine) {
        try {
          const networkResponse = await fetch(asset);
          await cache.put(asset, networkResponse.clone());
          cached++;
        } catch (error) {
          console.error(`Failed to cache ${asset}:`, error);
        }
      } else if (response) {
        cached++;
      }
      
      // Calculate percentage
      const progressPercentage = Math.round((cached / totalAssets) * 100);
      
      // Update custom progress bar
      if (cacheProgressBar) {
        cacheProgressBar.value = progressPercentage;
      }
      
      // Update progress text with percentage
      if (cacheProgress) {
        cacheProgress.textContent = `${progressPercentage}%`;
      }
    }

    // Final progress update
    if (cacheProgress) {
      cacheProgress.textContent = `100%`;

      resourceLoader.classList.remove('flex');
      resourceLoader.classList.add('hidden');

      if (successSection) {
        successSection.classList.remove('hidden');
        successSection.classList.add('flex');
      }
    }
  } catch (error) {
    console.error('Cache check failed:', error);
    if (cacheProgress) {
      cacheProgress.textContent = 'Cache check failed';
    }
  }
};

const checkAuth = () => {
	const authCookie = getCookie(COOKIE_NAME);
	if (!authCookie) {
		window.location.href = 'index.html'; // Redirect to index.html if not authenticated
	}
};

// Handle input fields for access code
document.addEventListener('DOMContentLoaded', function() {
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
				accessError.textContent = 'Incorrect passcode. Please try again.';
			}
		}
	});
});

// Register Service Worker
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
  navigator.serviceWorker.register('/sw.js')
    .then((registration) => {
      console.log('Service Worker registered with scope:', registration.scope);
    })
    .catch((error) => {
      console.error('Service Worker registration failed:', error);
    });
  });
}

// Check authentication on page load except for excluded paths
const excludedAuthPaths = [
  '/',
  '/index.html',
  '/zugang/',
  '/zugang/index.html',
  '/fr',
  '/fr/',
  '/fr/index.html',
  '/fr/acces/',
  '/fr/acces/index.html',
  '/en',
  '/en/',
  '/en/index.html',
  '/en/access/',
  '/en/access/index.html'
];

const currentPath = window.location.pathname;

// Only check authentication if not on an excluded path
if (!excludedAuthPaths.includes(currentPath)) {
  checkAuth();
}

// DEBUG METHODS
// Function to delete all caches
const deleteAllCaches = async () => {
	try {
		const cacheNames = await caches.keys();
		await Promise.all(cacheNames.map(name => caches.delete(name)));
		console.log('All caches deleted.');
	} catch (error) {
		console.error('Failed to delete caches:', error);
	}
};

// Function to unregister the service worker
const unregisterServiceWorker = async () => {
	try {
		const registrations = await navigator.serviceWorker.getRegistrations();
		await Promise.all(registrations.map(registration => registration.unregister()));
		console.log('Service Worker unregistered.');
	} catch (error) {
		console.error('Failed to unregister Service Worker:', error);
	}
};

// Function to restart the service worker
const restartServiceWorker = async () => {
	await unregisterServiceWorker();
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('sw.js')
			.then((registration) => {
				console.log('Service Worker restarted with scope:', registration.scope);
			})
			.catch((error) => {
				console.error('Service Worker restart failed:', error);
			});
	}
};

// Attach event listeners for development buttons
const deleteCachesButton = document.querySelector('[data-delete-caches]');
const restartSwButton = document.querySelector('[data-restart-sw]');

if (deleteCachesButton) {
	deleteCachesButton.addEventListener('click', deleteAllCaches);
}

if (restartSwButton) {
	restartSwButton.addEventListener('click', restartServiceWorker);
}