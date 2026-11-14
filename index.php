<?php
$firma = 'Szprycha';
$rok = date('Y');
$imie = $_GET['imie'] ?? 'Gościu';

$cennik = [
    ['nazwa' => 'Przegląd podstawowy', 'cena' => 120],
    ['nazwa' => 'Serwis kompleksowy',  'cena' => 250],
    ['nazwa' => 'Wymiana dętki',       'cena' => 30],
    ['nazwa' => 'Centrowanie koła',    'cena' => 50],
    ['nazwa' => 'Wymiana łańcucha',    'cena' => 40],
    ['nazwa' => 'Regulacja hamulców',  'cena' => 60],
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Szprycha – serwis rowerowy</title>
  <link rel="icon" href="favicon.svg" type="image/svg+xml">
  <meta name="description" content="Pracownia Rowerowa Szprycha w Bydgoszczy: przeglądy, serwis i naprawy rowerów. Sprawdź cennik i zadzwoń.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&family=Barlow+Condensed:ital,wght@1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="app.js" defer></script>
</head>
<body>
  <header class="site-header">
    <a class="logo" href="#">
      <svg viewBox="0 0 120 64" width="72" height="38" role="img" aria-labelledby="logo-tytul">
        <title id="logo-tytul">Szprycha</title>
        <circle cx="28" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <circle cx="92" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <polyline points="28,42 48,14 80,14 92,42" fill="none" stroke="#4426FF" stroke-width="5" stroke-linejoin="round"/>
        <polyline points="48,14 60,42 80,14" fill="none" stroke="#4426FF" stroke-width="5" stroke-linejoin="round"/>
        <path d="M48 14 L45 6 M38 6 H52 M80 14 L83 5 H93" fill="none" stroke="#4426FF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span>Szprycha</span>
    </a>
    <button class="menu-toggle" aria-expanded="false">Menu</button>
    <nav class="menu">
      <a href="#uslugi">Usługi</a>
      <a href="#cennik">Cennik</a>
      <a href="#wycena">Wycena</a>
      <a href="#kontakt">Kontakt</a>
    </nav>
    <button class="theme-toggle" aria-label="Ciemny motyw" aria-pressed="false">🌙</button>
  </header>

  <main>
    <section class="hero">
      <div class="hero__text">
        <p class="hero__greeting">Cześć, <?= htmlspecialchars($imie) ?>!</p>
        <p class="hero__place">Bydgoszcz i okolice</p>
        <h1>Pracownia Rowerowa Szprycha</h1>
        <p class="hero__lead">Przeglądy, naprawy i serwis rowerów każdego typu. Większość napraw robimy od ręki, resztę w 24 godziny.</p>
        <div class="hero__buttons">
          <a class="btn" href="#cennik">Zobacz cennik</a>
          <a class="btn btn--outline" href="#kontakt">Zadzwoń do nas</a>
        </div>
        <ul class="hero__pills">
          <li>Przegląd od ręki</li>
          <li>Naprawa w 24 h</li>
          <li>Gwarancja 6 mies.</li>
        </ul>
      </div>

      <div class="hero__panel">
        <p class="panel__label"><span class="panel__dot"></span> warsztat LIVE</p>
        <svg class="panel__bike" viewBox="0 0 120 64" aria-hidden="true">
          <g class="kolo">
            <circle cx="28" cy="42" r="18"/>
            <path class="szprychy" d="M10 42H46 M28 24V60 M15.3 29.3L40.7 54.7 M15.3 54.7L40.7 29.3"/>
          </g>
          <g class="kolo">
            <circle cx="92" cy="42" r="18"/>
            <path class="szprychy" d="M74 42H110 M92 24V60 M79.3 29.3L104.7 54.7 M79.3 54.7L104.7 29.3"/>
          </g>
          <polyline points="28,42 48,14 80,14 92,42"/>
          <polyline points="48,14 60,42 80,14"/>
          <path d="M48 14 L45 6 M38 6 H52 M80 14 L83 5 H93"/>
        </svg>
        <div class="panel__stats">
          <div><strong class="licznik" data-cel="1200" data-koncowka="+">1200+</strong><span>naprawionych rowerów</span></div>
          <div><strong class="licznik" data-cel="24" data-koncowka=" h">24 h</strong><span>maks. czas naprawy</span></div>
          <div><strong class="licznik" data-cel="4.9" data-miejsca="1">4,9</strong><span>ocena klientów</span></div>
        </div>
        <p class="panel__status">Twój rower: gotowy do odbioru</p>
      </div>
    </section>

    <section id="uslugi">
      <h2>Usługi</h2>
      <div class="cards">
        <article class="card">
          <span class="card__icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.8-3.8a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9z"/></svg></span>
          <h3>Przegląd</h3>
          <p>Regulacja hamulców i przerzutek, kontrola napędu.</p>
          <p class="card__price">od 120 zł</p>
        </article>
        <article class="card card--highlight">
          <p class="card__badge">Najczęściej wybierane</p>
          <span class="card__icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></span>
          <h3>Serwis kompleksowy</h3>
          <p>Pełny przegląd, czyszczenie napędu i centrowanie kół.</p>
          <p class="card__price">od 250 zł</p>
        </article>
        <article class="card">
          <span class="card__icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v2"/></svg></span>
          <h3>Wymiana dętki</h3>
          <p>Szybka naprawa przebitej dętki, także od ręki.</p>
          <p class="card__price">od 30 zł</p>
        </article>
      </div>
    </section>

    <section id="jak">
      <h2>Jak to działa</h2>
      <ol class="kroki">
        <li class="krok">
          <span class="krok__nr">01</span>
          <h3>Zgłoszenie</h3>
          <p>Zadzwoń albo po prostu wpadnij z rowerem do warsztatu.</p>
          <small>ok. 5 minut</small>
        </li>
        <li class="krok">
          <span class="krok__nr">02</span>
          <h3>Diagnoza</h3>
          <p>Sprawdzamy rower i podajemy dokładną cenę. Bez niespodzianek.</p>
          <small>ok. 15 minut</small>
        </li>
        <li class="krok">
          <span class="krok__nr">03</span>
          <h3>Naprawa</h3>
          <p>Większość usług robimy od ręki, resztę najpóźniej następnego dnia.</p>
          <small>od ręki do 24 h</small>
        </li>
        <li class="krok">
          <span class="krok__nr">04</span>
          <h3>Odbiór</h3>
          <p>Wysyłamy SMS, gdy rower jest gotowy. Płacisz dopiero przy odbiorze.</p>
          <small>kiedy Ci pasuje</small>
        </li>
      </ol>
    </section>


    <section id="cennik">
      <h2>Cennik</h2>
      <div class="cennik-uklad">
      <table class="price-table">
        <thead><tr><th>Usługa</th><th class="num">Cena</th></tr></thead>
        <tbody>
        <?php foreach ($cennik as $usluga): ?>
          <tr>
            <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
            <td class="num"><?= $usluga['cena'] ?> zł</td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>

        <aside class="boczne">
          <div class="boks">
            <h3>Godziny otwarcia</h3>
            <p class="status">Sprawdzam…</p>
            <ul class="godziny">
              <li data-dni="1,2,3,4,5"><span>Poniedziałek – piątek</span><b>9:00 – 18:00</b></li>
              <li data-dni="6"><span>Sobota</span><b>9:00 – 14:00</b></li>
              <li data-dni="0"><span>Niedziela</span><b>zamknięte</b></li>
            </ul>
          </div>

          <div class="boks boks--promo">
            <p class="boks__tag">Promocja tygodnia</p>
            <h3>Łańcuch + czyszczenie napędu</h3>
            <p>Nowy łańcuch i napęd jak z fabryki. Rower od razu jedzie ciszej.</p>
            <p class="promo__cena"><s>80 zł</s> 59 zł</p>
          </div>
        </aside>
      </div>
    </section>

    <section id="wycena">
      <h2>Wycena</h2>
      <p>Zaznacz, czego potrzebuje Twój rower, a od razu zobaczysz koszt. Przy 3 usługach dostajesz 10% rabatu.</p>
      <div class="wycena">
        <div class="wycena__lista">
        <?php foreach ($cennik as $usluga): ?>
          <label class="opcja">
            <input type="checkbox" value="<?= $usluga['cena'] ?>">
            <span><?= htmlspecialchars($usluga['nazwa']) ?></span>
            <b><?= $usluga['cena'] ?> zł</b>
          </label>
        <?php endforeach; ?>
        </div>
        <div class="wycena__wynik">
          <p>Twój serwis</p>
          <output class="wycena__suma" aria-live="polite">0 zł</output>
          <p class="wycena__info">Wybierz usługi z listy</p>
          <a class="btn" href="#kontakt">Umów wizytę</a>
        </div>
      </div>
    </section>
    <section id="faq">
      <h2>Częste pytania</h2>
      <div class="faq-uklad">
      <div class="faq">
        <details>
          <summary>Ile trwa przegląd?</summary>
          <p>Przegląd podstawowy robimy zwykle od ręki, w 1–2 godziny. Po serwisie kompleksowym rower odbierasz następnego dnia.</p>
        </details>
        <details>
          <summary>Czy muszę się wcześniej umawiać?</summary>
          <p>Nie musisz. Telefon wcześniej skraca jednak czekanie, szczególnie wiosną, gdy wszyscy wyciągają rowery z piwnic.</p>
        </details>
        <details>
          <summary>Czy serwisujecie rowery elektryczne?</summary>
          <p>Tak. Hamulce, napęd i koła w rowerach elektrycznych serwisujemy tak samo jak w zwykłych.</p>
        </details>
        <details>
          <summary>Czy dajecie gwarancję?</summary>
          <p>Tak, 6 miesięcy na wykonane usługi i zamontowane części.</p>
        </details>
      </div>

        <aside class="faq-cta">
          <h3>Nie znalazłeś odpowiedzi?</h3>
          <p>Zadzwoń albo napisz. Odpowiemy na każde pytanie o Twój rower.</p>
          <a class="btn" href="tel:+48500100200">Zadzwoń: 500 100 200</a>
          <a class="faq-cta__mail" href="mailto:kontakt@szprycha.pl">kontakt@szprycha.pl</a>
        </aside>
      </div>
    </section>

  </main>

  <footer id="kontakt" class="site-footer">
    <h2>Kontakt</h2>
    <address class="contact">
      <div class="contact__item">
        <span class="contact__icon">
          <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </span>
        <p>ul. Rowerowa 12<br>85-001 Bydgoszcz</p>
      </div>
      <div class="contact__item">
        <span class="contact__icon">
          <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">
            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.8.7a2 2 0 0 1 1.7 2z"/>
          </svg>
        </span>
        <a href="tel:+48500100200">500 100 200</a>
      </div>
      <div class="contact__item">
        <span class="contact__icon">
          <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">
            <circle cx="12" cy="12" r="4"/>
            <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.9 7.9"/>
          </svg>
        </span>
        <a href="mailto:kontakt@szprycha.pl">kontakt@szprycha.pl</a>
      </div>
    </address>
    <p class="copy">&copy; <?= $rok ?> <?= $firma ?></p>
  </footer>
</body>
</html>