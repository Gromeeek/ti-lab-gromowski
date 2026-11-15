<?php
// Strażnik panelu: pierwsza linijka każdej strony panelu to  require 'auth.php';
session_start();

if (empty($_SESSION['uzytkownik'])) {
    header('Location: login.php');
    exit;
}
