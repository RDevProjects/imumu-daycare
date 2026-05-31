import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Dark mode initialization
(function initDarkMode() {
  const stored = localStorage.getItem('imumu-dark-mode');
  if (stored === 'true') {
    document.documentElement.classList.add('dark');
    document.body.classList.add('dark');
  } else if (stored === null) {
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.classList.add('dark');
      document.body.classList.add('dark');
    }
  }
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (localStorage.getItem('imumu-dark-mode') === null) {
      if (e.matches) {
        document.documentElement.classList.add('dark');
        document.body.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
        document.body.classList.remove('dark');
      }
    }
  });
})();

window.toggleDarkMode = function() {
  const isDark = document.body.classList.toggle('dark');
  document.documentElement.classList.toggle('dark', isDark);
  localStorage.setItem('imumu-dark-mode', isDark ? 'true' : 'false');
};

window.isDarkMode = function() {
  return document.body.classList.contains('dark');
};

Alpine.start();
