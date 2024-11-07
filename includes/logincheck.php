<?php
session_start();

// Statische Login-Daten für die Überprüfung
$static_username = "demoUser";
$static_password = "securePassword123";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzerdaten aus dem Formular abrufen und bereinigen
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prüfen, ob die eingegebenen Daten mit den statischen Werten übereinstimmen
    if ($username === $static_username && $password === $static_password) {
        // Login erfolgreich: Benutzername in Session speichern
        $_SESSION['username'] = $username;
        header("Location: login.php"); // Zurück auf die Loginseite ohne Formular
        exit();
    } else {
        // Fehler: Benutzername oder Passwort falsch
        $error_message = "Ungültiger Benutzername oder Passwort.";
    }
}
?>