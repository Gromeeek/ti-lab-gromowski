<?php
require 'auth.php';   // 1. strażnik
require 'baza.php';

$blad = '';

// 2. Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';

    if ($akcja === 'dodaj') {
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int) ($_POST['cena'] ?? 0);

        // sprawdź: nazwa od 1 do 100 znaków, cena większa od zera
        if (preg_match('/^.{1,100}$/u', $nazwa) && $cena > 0) {
            $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
            $z->execute(['nazwa' => $nazwa, 'cena' => $cena]);   // zapisz
            header('Location: admin.php?ok=dodano');             // przekieruj
            exit;
        }
        $blad = 'Podaj nazwę (do 100 znaków) i cenę większą od zera.';
    }
}

// 3. Lista usług do tabeli
$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();
$dodano = ($_GET['ok'] ?? '') === 'dodano';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel – Szprycha</title>
</head>
<body>
  <h1>Panel Szprychy</h1>
  <p>Zalogowany: <?= htmlspecialchars($_SESSION['uzytkownik']) ?> · <a href="index.php">Zobacz stronę</a> · <a href="wyloguj.php">Wyloguj</a></p>

  <?php if ($dodano): ?><p><strong>Usługa dodana.</strong></p><?php endif; ?>
  <?php if ($blad): ?><p><strong><?= htmlspecialchars($blad) ?></strong></p><?php endif; ?>

  <h2>Usługi</h2>
  <table>
    <thead><tr><th>Usługa</th><th>Cena</th></tr></thead>
    <tbody>
    <?php foreach ($uslugi as $usluga): ?>
      <tr>
        <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
        <td><?= (int) $usluga['cena'] ?> zł</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <h2>Dodaj usługę</h2>
  <form method="post">
    <input type="hidden" name="akcja" value="dodaj">
    <p>
      <label for="nazwa">Nazwa</label><br>
      <input id="nazwa" name="nazwa" required maxlength="100">
    </p>
    <p>
      <label for="cena">Cena (zł)</label><br>
      <input id="cena" name="cena" type="number" min="1" required>
    </p>
    <button>Dodaj</button>
  </form>
</body>
</html>
