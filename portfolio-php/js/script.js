// ── Theme Toggle ──
function toggleTheme() {
  const body = document.body;
  const icon = document.getElementById('themeIcon');
  if (body.classList.contains('dark')) {
    body.classList.remove('dark');
    icon.textContent = '🌙';
    localStorage.setItem('theme', 'light');
  } else {
    body.classList.add('dark');
    icon.textContent = '☀️';
    localStorage.setItem('theme', 'dark');
  }
}

// Apply saved theme on load
(function () {
  const saved = localStorage.getItem('theme');
  const icon  = document.getElementById('themeIcon');
  if (saved === 'dark') {
    document.body.classList.add('dark');
    if (icon) icon.textContent = '☀️';
  }
})();