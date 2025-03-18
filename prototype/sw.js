// importScripts('https://storage.googleapis.com/workbox-cdn/releases/7.0.0/workbox-sw.js');

// workbox.setConfig({
//     debug: false
// });

const CACHE_VERSION = 'v1';
const CACHE_NAME = `site-assets-${CACHE_VERSION}`;
const ASSETS = [
    'index.html',
    'gallery.html',
    'audio.html',
    'sample.mp3',
    'image-1.png',
    'image-2.png',
    'app.css',
    'app.js'
];

// Pre-cache all assets during installation
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(ASSETS))
            .then(() => self.skipWaiting())
    );
});

// Clean up old caches during activation
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Serve cached assets for all navigation requests
self.addEventListener('fetch', (event) => {
    if (event.request.mode === 'navigate') {
        event.respondWith(
            caches.match(event.request)
                .then((cachedResponse) => {
                    return cachedResponse || fetch(event.request)
                        .catch(() => caches.match('/offline.html')); // Fallback to offline page
                })
        );
    } else {
        event.respondWith(
            caches.match(event.request)
                .then((cachedResponse) => {
                    return cachedResponse || fetch(event.request);
                })
        );
    }
});