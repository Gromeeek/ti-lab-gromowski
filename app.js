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

// ===== Kalkulator wyceny =====
const opcje = document.querySelectorAll('.wycena input[type="checkbox"]');
const suma = document.querySelector('.wycena__suma');
const info = document.querySelector('.wycena__info');

function przelicz() {
  let razem = 0;
  let ile = 0;

  opcje.forEach(function (opcja) {
    if (opcja.checked) {
      razem = razem + Number(opcja.value);
      ile = ile + 1;
    }
  });

  let rabat = 0;
  if (ile >= 3) {
    rabat = Math.round(razem * 0.1);
  }

  suma.textContent = (razem - rabat) + ' zł';

  if (ile === 0) {
    info.textContent = 'Wybierz usługi z listy';
  } else if (rabat > 0) {
    info.textContent = 'Usług: ' + ile + ', w tym rabat −' + rabat + ' zł';
  } else {
    info.textContent = 'Usług: ' + ile + '. Dobierz jeszcze ' + (3 - ile) + ', a dostaniesz rabat';
  }
}

opcje.forEach(function (opcja) {
  opcja.addEventListener('change', przelicz);
});