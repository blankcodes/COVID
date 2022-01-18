const covid_updates = "covid_updates-ken-karlo-v1"
const assets = [
  "/",
  "assets/css/icons.min.css",
  "assets/css/app-dark.min.css",
  "assets/css/default.css",
  "assets/css/app.min.css",
  "assets/css/aos.css",
  "assets/js/aos.js",
  "assets/js/jquery.min.js",
  "assets/js/auth/_app.js",
  "assets/js/auth/_app.js",
]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(covid_updates).then(cache => {
      cache.addAll(assets)
    })
  )
})

self.addEventListener("fetch", fetchEvent => {
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request)
    })
  )
})