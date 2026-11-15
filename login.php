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
</head>
<body>
  <h1>Logowanie do panelu</h1>

  <?php if ($blad): ?>
    <p><strong><?= htmlspecialchars($blad) ?></strong></p>
  <?php endif; ?>

  <form method="post">
    <p>
      <label for="login">Login</label><br>
      <input id="login" name="login" required autocomplete="username">
    </p>
    <p>
      <label for="haslo">Hasło</label><br>
      <input id="haslo" name="haslo" type="password" required autocomplete="current-password">
    </p>
    <button>Zaloguj</button>
  </form>

  <p><a href="index.php">← Wróć na stronę</a></p>
</body>
</html>
