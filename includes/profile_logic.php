<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$success = '';
$error = '';

// Benutzerdaten ändern (Name und Passwort)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $newUsername = $_POST['new_username'] ?? '';

    // Passwort ändern
    if (!empty($newPassword)) {
        if ($currentPassword === $user['password']) {
            $_SESSION['user']['password'] = $newPassword;
            $success = "Passwort wurde erfolgreich geändert.";
        } else {
            $error = "Das aktuelle Passwort ist falsch.";
        }
    }

    // Benutzername ändern
    if (!empty($newUsername)) {
        $_SESSION['user']['username'] = $newUsername;
        $_SESSION['user']['name'] = $newUsername;  // Benutzernamen auch in Name aktualisieren
        $success = "Benutzername wurde erfolgreich geändert.";

        // Seite neu laden, damit die Änderungen übernommen werden
        header('Location: profile.php');
        exit;
    }
}
?>
