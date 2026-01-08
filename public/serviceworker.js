const CACHE_NAME = 'securestep-cache-v1';
const STATIC_ASSETS = [
    '/',
    '/build/manifest.json',
    '/build/assets/app-DrECpjb5.js',
    '/build/assets/app-DHvv4cCV.css'
];

// Install: cache static assets
self.addEventListener('install', event => {
    console.log('[ServiceWorker] Install');
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(STATIC_ASSETS))
    );
});

// Activate: cleanup old caches
self.addEventListener('activate', event => {
    console.log('[ServiceWorker] Activate');
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(
                keys.map(key => {
                    if (key !== CACHE_NAME) {
                        console.log('[ServiceWorker] Removing old cache', key);
                        return caches.delete(key);
                    }
                })
            )
        )
    );
});

// Fetch: serve from cache first, then network; cache API responses dynamically
self.addEventListener('fetch', event => {
    const requestUrl = new URL(event.request.url);

    // Dynamic caching for Laravel API routes (Supabase data)
    if (requestUrl.pathname.startsWith('/api/')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Clone response and store in cache
                    const cloned = response.clone();
                    caches.open(CACHE_NAME).then(cache => cache.put(event.request, cloned));
                    return response;
                })
                .catch(() => caches.match(event.request)) // fallback to cache if offline
        );
        return;
    }

    // Static assets and other requests
    event.respondWith(
        caches.match(event.request).then(response => response || fetch(event.request))
    );
});
