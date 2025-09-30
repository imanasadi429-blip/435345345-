document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.getElementById('dark-mode-toggle');
  if (toggle) {
    toggle.addEventListener('click', function() {
      document.body.dataset.theme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
    });
  }
});