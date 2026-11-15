<?php
require 'auth.php';   // strażnik
require 'baza.php';

// Którą usługę edytujemy? id z adresu (GET) albo z formularza (POST)
$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);

$z = $pdo->prepare('SELECT id, nazwa, cena FROM uslugi WHERE id = :id');
$z->execute(['id' => $id]);
$usluga = $z->fetch();

if (!$usluga) {               // nie ma takiej usługi
    header('Location: admin.php');
    exit;
}

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sprawdz_csrf();

    $nazwa = trim($_POST['nazwa'] ?? '');
    $cena = (int) ($_POST['cena'] ?? 0);

    if (preg_match('/^.{1,100}$/u', $nazwa) && $cena > 0) {
        $z = $pdo->prepare('UPDATE uslugi SET nazwa = :nazwa, cena = :cena WHERE id = :id');
        $z->execute(['nazwa' => $nazwa, 'cena' => $cena, 'id' => $id]);
        header('Location: admin.php?ok=zmieniono');
        exit;
    }
    $blad = 'Podaj nazwę (do 100 znaków) i cenę większą od zera.';
    // zostaw w formularzu to, co wpisał użytkownik
    $usluga['nazwa'] = $nazwa;
    $usluga['cena'] = $cena;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edycja usługi – Szprycha</title>
  <link rel="icon" href="favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="admin.php">Szprycha · panel</a>
      <a class="btn btn-sm btn-warning" href="wyloguj.php">Wyloguj</a>
    </div>
  </nav>

  <main class="container" style="max-width: 560px">
    <div class="card">
      <div class="card-body">
        <h1 class="h4 card-title">Edycja usługi</h1>

        <?php if ($blad): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($blad) ?></div>
        <?php endif; ?>

        <form method="post">
          <?= csrf_pole() ?>
          <input type="hidden" name="id" value="<?= (int) $usluga['id'] ?>">
          <div class="mb-3">
            <label for="nazwa" class="form-label">Nazwa</label>
            <input id="nazwa" name="nazwa" class="form-control" required maxlength="100"
                   value="<?= htmlspecialchars($usluga['nazwa']) ?>">
          </div>
          <div class="mb-3">
            <label for="cena" class="form-label">Cena (zł)</label>
            <input id="cena" name="cena" type="number" min="1" class="form-control" required
                   value="<?= (int) $usluga['cena'] ?>">
          </div>
          <button class="btn btn-primary">Zapisz zmiany</button>
          <a class="btn btn-outline-secondary" href="admin.php">Anuluj</a>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
