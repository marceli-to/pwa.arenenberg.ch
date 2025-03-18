// Function to delete all caches
const deleteAllCaches = async () => {
  try {
    const cacheNames = await caches.keys();
    
    await Promise.all(cacheNames.map(name => caches.delete(name)));
    console.log('All caches deleted.');
    alert('All caches deleted');

    await deleteAuthCookie();

    
  } catch (error) {
    console.error('Failed to delete caches:', error);
  }
};

const deleteAuthCookie = async () => {
	document.cookie = 'arenenberg-auth=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
	console.log('Cookie arenenberg-auth deleted.');
	alert('Cookie arenenberg-auth deleted.');

};

// Function to unregister the service worker
const unregisterServiceWorker = async () => {
  try {
    const registrations = await navigator.serviceWorker.getRegistrations();
    await Promise.all(registrations.map(registration => registration.unregister()));
    console.log('Service Worker unregistered.');
    alert('Service Worker unregistered.');
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
          alert('Service Worker restarted with scope:' + registration.scope);
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