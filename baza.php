<?php
// Połączenie z bazą. Dołączasz ten plik przez: require 'baza.php';
$pdo = new PDO('sqlite:' . __DIR__ . '/szprycha.sqlite');
// MySQL na hostingu: zmienia się tylko linijka wyżej, np.
// $pdo = new PDO('mysql:host=localhost;dbname=szprycha', 'login', 'haslo');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
