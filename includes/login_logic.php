<?php
session_start();

// Pfad zur JSON-Datei, in der die Benutzerdaten gespeichert werden
$usersFile = 'resources/users.json';

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Überprüfen, ob die Felder ausgefüllt sind
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Bitte Benutzername und Passwort ausfüllen.";
        header('Location: login.php');
        exit;
    }

    // Überprüfen, ob die JSON-Datei existiert und Benutzerdaten enthält
    if (!file_exists($usersFile)) {
        header('Location: login.php');
        exit;
    }

    // Benutzerdaten aus der JSON-Datei laden
    $users = json_decode(file_get_contents($usersFile), true);

    // Benutzer suchen und Passwort überprüfen
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            if (password_verify($password, $user['password'])) {
                // Login erfolgreich
                $_SESSION['user'] = $username;
                header('Location: profile.php'); // Weiterleitung zum Profil
                exit;
            } else {
                // Passwort fehlerhaft
                $_SESSION['error'] = "Benutzername oder Passwort fehlerhaft.";
                header('Location: login.php');
                exit;
            }
        }
    }

    // Wenn kein Benutzername übereinstimmt
    $_SESSION['error'] = "Benutzername oder Passwort fehlerhaft.";
    header('Location: login.php');
    exit;
}
?>
