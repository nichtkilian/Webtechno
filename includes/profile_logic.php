<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Bitte loggen Sie sich ein, um auf Ihr Profil zuzugreifen.";
    header('Location: login.php');
    exit;
}

// Pfad zur JSON-Datei
$usersFile = 'resources/users.json';

// Benutzer aus der JSON-Datei laden
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];
$currentUser = null;

// Aktuellen Benutzer finden
foreach ($users as $user) {
    if ($user['username'] === $_SESSION['user']) {
        $currentUser = $user;
        break;
    }
}

// Wenn der Benutzer nicht gefunden wurde
if (!$currentUser) {
    die("Benutzer nicht gefunden.");
}

// Verarbeitung der Passwortänderung
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    // Überprüfen, ob die Felder ausgefüllt sind
    if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        $error = "Bitte alle Felder ausfüllen.";
    } elseif ($newPassword !== $confirmNewPassword) {
        $error = "Die neuen Passwörter stimmen nicht überein.";
    } else {
        // Überprüfen, ob das aktuelle Passwort korrekt ist
        $found = false;
        foreach ($users as &$user) {
            if ($user['username'] === $_SESSION['user']) {
                $found = true;
                if (!password_verify($currentPassword, $user['password'])) {
                    $error = "Das aktuelle Passwort ist falsch.";
                } else {
                    // Neues Passwort hashen und speichern
                    $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                    file_put_contents($usersFile, json_encode($users));
                    $success = "Passwort erfolgreich geändert.";
                }
                break;
            }
        }

        if (!$found) {
            $error = "Benutzer nicht gefunden.";
        }
    }
}
?>