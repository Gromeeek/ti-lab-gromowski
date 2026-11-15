<?php
// Uruchamiasz RAZ, w terminalu:  php setup.php TwojeHaslo
// Hasło podajesz w terminalu, więc nie trafia do kodu ani na GitHuba.

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Ten plik uruchamia się w terminalu: php setup.php TwojeHaslo');
}

require __DIR__ . '/baza.php';

// 1. Tabele
$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL,
    popularnosc INTEGER NOT NULL DEFAULT 0
)');

$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');

// 2. Usługi startowe, tylko gdy tabela jest pusta
$ileUslug = $pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn();

if ($ileUslug == 0) {
    $start = [
        ['Przegląd podstawowy', 120, 45],
        ['Serwis kompleksowy',  250, 10],
        ['Wymiana dętki',        30, 30],
        ['Centrowanie koła',     50, 15],
        ['Wymiana łańcucha',     40, 20],
        ['Regulacja hamulców',   60, 25],
    ];
    $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena, popularnosc) VALUES (:nazwa, :cena, :pop)');
    foreach ($start as [$nazwa, $cena, $pop]) {
        $z->execute(['nazwa' => $nazwa, 'cena' => $cena, 'pop' => $pop]);
    }
    echo "Dodano usługi startowe.\n";
}

// 3. Konto admina, tylko gdy nie ma jeszcze żadnego użytkownika
$ileKont = $pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn();

if ($ileKont == 0) {
    $haslo = $argv[1] ?? '';
    if (strlen($haslo) < 8) {
        echo "Podaj hasło admina (min. 8 znaków):  php setup.php TwojeHaslo\n";
        exit(1);
    }
    $z = $pdo->prepare('INSERT INTO uzytkownicy (login, haslo_hash) VALUES (:login, :hash)');
    $z->execute(['login' => 'admin', 'hash' => password_hash($haslo, PASSWORD_DEFAULT)]);
    echo "Utworzono konto: admin\n";
}

echo "Baza gotowa.\n";
