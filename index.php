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
        ['nazwa' => 'Regulacja hamulców', 'cena' => 60],
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Szprycha – serwis rowerowy</title>
  <meta name="description" content="Pracownia Rowerowa Szprycha w Bydgoszczy: przeglądy, serwis i naprawy rowerów. Sprawdź cennik i zadzwoń.">
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
  </svg>
  <span>Szprycha</span>
</a>
    <button class="menu-toggle" aria-expanded="false">Menu</button>
    <nav class="menu">
      <a href="#uslugi">Usługi</a>
      <a href="#cennik">Cennik</a>
      <a href="#kontakt">Kontakt</a>
    </nav>
  </header>

  <main>
    <h1>Pracownia Rowerowa Szprycha</h1>
<p>Cześć, <?= htmlspecialchars($imie) ?>!</p>
    <section id="uslugi">
      <h2>Usługi</h2>
      <div class="cards">
  <article class="card">
    <h3>Przegląd</h3>
    <p>Regulacja hamulców i przerzutek, kontrola napędu.</p>
    <p class="card__price">od 120 zł</p>
  </article>

  <article class="card card--highlight">
    <p class="card__badge">Najczęściej wybierane</p>
    <h3>Serwis kompleksowy</h3>
    <p>Pełny przegląd, czyszczenie napędu i centrowanie kół.</p>
    <p class="card__price">od 250 zł</p>
  </article>

  <article class="card">
    <h3>Wymiana dętki</h3>
    <p>Szybka naprawa przebitej dętki, także od ręki.</p>
    <p class="card__price">od 30 zł</p>
  </article>
</div>
    </section>

    <section id="cennik">
      <h2>Cennik</h2>
      <table class="price-table">
  <thead>
    <tr>
      <th>Usługa</th>
      <th class="num">Cena</th>
    </tr>
  </thead>
 <tbody>
<?php foreach ($cennik as $usluga): ?>
  <tr>
    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
    <td class="num"><?= $usluga['cena'] ?> zł</td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
    </section>
  </main>

  <footer id="kontakt">
    <h2>Kontakt</h2>
    <address>
  <p>ul. Rowerowa 12, 85-001 Bydgoszcz</p>
  <p>Telefon: <a href="tel:+48500100200">500 100 200</a></p>
  <p>E-mail: <a href="mailto:kontakt@szprycha.pl">kontakt@szprycha.pl</a></p>
</address>
<p>&copy; <?= $rok ?> <?= $firma ?></p>
  </footer>
</body>
</html>