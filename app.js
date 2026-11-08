// ===== Menu na telefonie =====
const przycisk = document.querySelector('.menu-toggle');
const menu = document.querySelector('.menu');

przycisk.addEventListener('click', function () {
  const otwarte = menu.classList.toggle('menu--open');
  przycisk.setAttribute('aria-expanded', otwarte);
});

// ===== Ciemny motyw =====
const motyw = document.querySelector('.theme-toggle');

function ustawMotyw(ciemny) {
  document.body.classList.toggle('dark', ciemny);
  motyw.setAttribute('aria-pressed', ciemny);
  motyw.textContent = ciemny ? '☀️' : '🌙';
}

// Po wejściu na stronę: przywróć zapamiętany wybór
let zapisany = null;
try {
  zapisany = localStorage.getItem('motyw');
} catch (e) {}
ustawMotyw(zapisany === 'ciemny');

motyw.addEventListener('click', function () {
  const ciemny = !document.body.classList.contains('dark');
  ustawMotyw(ciemny);
  try {
    localStorage.setItem('motyw', ciemny ? 'ciemny' : 'jasny');
  } catch (e) {}
});