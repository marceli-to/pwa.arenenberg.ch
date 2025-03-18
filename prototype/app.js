const ASSETS = [
  'index.html',
  'gallery.html',
  'audio.html',
  'sample.mp3',
  'sample2.mp3',
  'sample3.mp3',
  'image-1.png',
  'image-2.png',
  'app.css',
  'app.js'
];

const CACHE_NAME = 'arenenberg-assets-v4';

const COOKIE_NAME = 'arenenberg-auth';

const PASSWORD_PATH = 'password.txt';

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
    const cacheStatus = document.querySelector('[data-cache-progress]');
    const progressBar = document.querySelector('[data-progress-bar]');

    try {
        const cache = await caches.open(CACHE_NAME);
        let cached = 0;

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
            progressBar.value = (cached / ASSETS.length) * 100;
        }

        cacheStatus.textContent = cached === ASSETS.length ?
            'All assets cached' :
            `Cached ${cached}/${ASSETS.length} assets`;
    } catch (error) {
        console.error('Cache check failed:', error);
        cacheStatus.textContent = 'Cache check failed';
    }
};

const handlePasswordSubmit = async (event) => {
    event.preventDefault(); // Prevent the form from submitting

    const passwordInput = document.querySelector('[data-password-input]').value;
    const passwordError = document.querySelector('[data-password-error]');

    if (await validatePassword(passwordInput)) {
        setCookie(COOKIE_NAME, 'true', 60); // Set cookie for 60 minutes
        document.querySelector('[data-password-prompt]').style.display = 'none';
        cacheAllAssets();
    } else {
        passwordError.textContent = 'Incorrect password. Please try again.';
    }
};

const checkAuth = () => {
    const authCookie = getCookie(COOKIE_NAME);
    if (!authCookie) {
        window.location.href = 'index.html'; // Redirect to index.html if not authenticated
    }
};

// Attach the form submit event listener
const passwordForm = document.querySelector('[data-password-form]');
if (passwordForm) {
    passwordForm.addEventListener('submit', handlePasswordSubmit);
}

// Register Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('sw.js')
            .then((registration) => {
                console.log('Service Worker registered with scope:', registration.scope);
            })
            .catch((error) => {
                console.error('Service Worker registration failed:', error);
            });
    });
}

// Check authentication on page load
if (window.location.pathname !== '/index.html') {
    checkAuth();
}

// Arrow function to update online/offline status
const updateOnlineStatus = () => {
    const status = document.querySelector('[data-status]');
    const isOnline = navigator.onLine;
    console.log(isOnline);
    status.textContent = isOnline ? 'You are online' : 'You are offline';
    status.className = `status ${isOnline ? 'online' : 'offline'}`;
    if (isOnline) cacheAllAssets();
};

window.addEventListener('online', updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);


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