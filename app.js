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

// ===== Godziny otwarcia: czy teraz otwarte? =====
const godzinyOtwarcia = {
  0: null,      // niedziela: zamknięte
  1: [9, 18],   // poniedziałek
  2: [9, 18],
  3: [9, 18],
  4: [9, 18],
  5: [9, 18],   // piątek
  6: [9, 14]    // sobota
};

const status = document.querySelector('.status');
const teraz = new Date();
const dzien = teraz.getDay();                               // 0 = niedziela, 6 = sobota
const godzina = teraz.getHours() + teraz.getMinutes() / 60; // np. 14:30 → 14.5
const dzisiaj = godzinyOtwarcia[dzien];

if (dzisiaj && godzina >= dzisiaj[0] && godzina < dzisiaj[1]) {
  status.textContent = '🟢 Teraz otwarte, do ' + dzisiaj[1] + ':00';
  status.classList.add('status--otwarte');
} else {
  status.textContent = '🔴 Teraz zamknięte';
  status.classList.add('status--zamkniete');
}

// Podświetl wiersz z dzisiejszym dniem
document.querySelectorAll('.godziny li').forEach(function (wiersz) {
  const dni = wiersz.dataset.dni.split(',');
  if (dni.includes(String(dzien))) {
    wiersz.classList.add('dzis');
  }
});