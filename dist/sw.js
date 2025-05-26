const CACHE_NAME = `arenenberg-assets-v0.0.4`;

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
						.catch(() => caches.match('/offline/index.html')); // Fallback to offline page
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