<?php
session_start();
require 'baza.php';

// Już zalogowany? Od razu do panelu.
if (!empty($_SESSION['uzytkownik'])) {
    header('Location: admin.php');
    exit;
}

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $z = $pdo->prepare('SELECT login, haslo_hash FROM uzytkownicy WHERE login = :login');
    $z->execute(['login' => trim($_POST['login'] ?? '')]);
    $u = $z->fetch();

    if ($u && password_verify($_POST['haslo'] ?? '', $u['haslo_hash'])) {
        session_regenerate_id(true);
        $_SESSION['uzytkownik'] = $u['login'];
        header('Location: admin.php');
        exit;
    }
    // Ten sam komunikat dla złego loginu i złego hasła
    $blad = 'Błędny login lub hasło.';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logowanie – Szprycha</title>
  <link rel="icon" href="favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
  <main class="container py-5" style="max-width: 420px">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 mb-3 text-center">Panel Szprychy</h1>

        <?php if ($blad): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($blad) ?></div>
        <?php endif; ?>

        <form method="post">
          <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input id="login" name="login" class="form-control" required autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="haslo" class="form-label">Hasło</label>
            <input id="haslo" name="haslo" type="password" class="form-control" required autocomplete="current-password">
          </div>
          <button class="btn btn-primary w-100">Zaloguj</button>
        </form>
      </div>
    </div>
    <p class="text-center mt-3"><a href="index.php">← Wróć na stronę</a></p>
  </main>
</body>
</html>
