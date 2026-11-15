<?php
// Strażnik panelu: pierwsza linijka każdej strony panelu to  require 'auth.php';
session_start();

if (empty($_SESSION['uzytkownik'])) {
    header('Location: login.php');
    exit;
}

// ===== Token CSRF =====
// Losowy, tajny ciąg zapisany w sesji. Każdy formularz panelu musi go odesłać.
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// Ukryte pole z tokenem. W formularzu wstawiasz je przez echo csrf_pole()
function csrf_pole(): string
{
    return '<input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '">';
}

// Wywołaj na początku obsługi każdego POST
function sprawdz_csrf(): void
{
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('Nieprawidłowy token formularza. Wróć, odśwież stronę i spróbuj ponownie.');
    }
}
