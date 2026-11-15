<?php
require 'auth.php';   // 1. strażnik
require 'baza.php';

$blad = '';

// 2. Obsługa formularzy (oba wysyłają POST, pole "akcja" mówi który)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';

    if ($akcja === 'dodaj') {
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int) ($_POST['cena'] ?? 0);

        // sprawdź: nazwa od 1 do 100 znaków, cena większa od zera
        if (preg_match('/^.{1,100}$/u', $nazwa) && $cena > 0) {
            $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
            $z->execute(['nazwa' => $nazwa, 'cena' => $cena]);   // zapisz
            header('Location: admin.php?ok=dodano');              // przekieruj
            exit;
        }
        $blad = 'Podaj nazwę (do 100 znaków) i cenę większą od zera.';
    }

    if ($akcja === 'usun') {
        $z = $pdo->prepare('DELETE FROM uslugi WHERE id = :id');   // WHERE, żeby nie wyczyścić tabeli!
        $z->execute(['id' => (int) ($_POST['id'] ?? 0)]);
        header('Location: admin.php?ok=usunieto');
        exit;
    }
}

// 3. Lista usług i komunikat
$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();

$komunikaty = [
    'dodano'   => 'Usługa dodana.',
    'usunieto' => 'Usługa usunięta.',
];
$ok = $komunikaty[$_GET['ok'] ?? ''] ?? '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel – Szprycha</title>
  <link rel="icon" href="favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <span class="navbar-brand">Szprycha · panel</span>
      <div class="d-flex align-items-center gap-2">
        <span class="navbar-text d-none d-sm-inline">Zalogowany: <?= htmlspecialchars($_SESSION['uzytkownik']) ?></span>
        <a class="btn btn-sm btn-outline-light" href="index.php">Zobacz stronę</a>
        <a class="btn btn-sm btn-warning" href="wyloguj.php">Wyloguj</a>
      </div>
    </div>
  </nav>

  <main class="container">
    <?php if ($ok): ?>
      <div class="alert alert-success"><?= htmlspecialchars($ok) ?></div>
    <?php endif; ?>
    <?php if ($blad): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($blad) ?></div>
    <?php endif; ?>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h1 class="h4 card-title">Usługi (<?= count($uslugi) ?>)</h1>
            <table class="table table-striped align-middle mb-0">
              <thead><tr><th>Usługa</th><th class="text-end">Cena</th><th></th></tr></thead>
              <tbody>
              <?php foreach ($uslugi as $usluga): ?>
                <tr>
                  <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                  <td class="text-end"><?= (int) $usluga['cena'] ?> zł</td>
                  <td class="text-end">
                    <form method="post" class="d-inline" onsubmit="return confirm('Usunąć tę usługę?')">
                      <input type="hidden" name="akcja" value="usun">
                      <input type="hidden" name="id" value="<?= (int) $usluga['id'] ?>">
                      <button class="btn btn-sm btn-outline-danger">Usuń</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h2 class="h4 card-title">Dodaj usługę</h2>
            <form method="post">
              <input type="hidden" name="akcja" value="dodaj">
              <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa</label>
                <input id="nazwa" name="nazwa" class="form-control" required maxlength="100">
              </div>
              <div class="mb-3">
                <label for="cena" class="form-label">Cena (zł)</label>
                <input id="cena" name="cena" type="number" min="1" class="form-control" required>
              </div>
              <button class="btn btn-primary w-100">Dodaj</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
