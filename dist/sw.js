const version = '0.0.1';

const ASSETS = [
	'/apple-touch-icon.png',
	'/audio/arenenberger-vielfalt.mp3',
	// '/audio/kaiserliches-leben.mp3',
	// '/audio/milch-mit-zukunft.mp3',
	// '/audio/vom-acker-auf-den-tisch.mp3',
	// '/audio/wundervolle-gartenwelt.mp3',
  `/build/assets/GT-Alpina-Standard-Medium-${version}.woff`,
  `/build/assets/GT-Alpina-Standard-Medium-${version}.woff2`,
  `/build/assets/GT-Alpina-Standard-Bold-${version}.woff`,
  `/build/assets/GT-Alpina-Standard-Bold-${version}.woff2`,
  `/build/assets/app-${version}.js`,
  `/build/assets/app-${version}.css`,
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
  '/download/index.html'
];

const CACHE_NAME = `arenenberg-assets-v1`;

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