<?php
session_start();

//Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Bitte loggen Sie sich ein, um auf Ihr Profil zuzugreifen.";
    header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $_SESSION['user']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Erfolgreich angemeldet
    $currentUser = $result->fetch_assoc();
} else {
    // Fehler: Ausloggen und zurück zur Loginseite
    session_destroy();
    header('Location: login.php');
}
$stmt->close();

// Verarbeitung der Stammdatenänderung
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Daten aus dem Formular abrufen
    $salutation = $_POST['salutation'] ?? '';
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';

    // Datenbank-Update durchführen
    $stmt = $conn->prepare("UPDATE users SET salutation = ?, name = ?, surname = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $salutation, $name, $surname, $email, $currentUser['id']);
    $result = $stmt->execute();

    if ($result) {
        $success = "Profil erfolgreich aktualisiert.";

        // Benutzerinformationen nach dem Update neu laden
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $currentUser['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $currentUser = $result->fetch_assoc();
    } else {
        $error = "Beim Aktualisieren des Profils ist ein Fehler aufgetreten.";
    }

    $stmt->close();
}

// Verarbeitung der Passwortänderung
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
        if ($currentUser['username'] === $_SESSION['user']) {
            // Überprüfen, ob das aktuelle Passwort korrekt ist
            if (!password_verify($currentPassword, $currentUser['password'])) {
                $error = "Das aktuelle Passwort ist falsch.";
            } else {
                // Neues Passwort hashen und speichern
                $currentUser['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                // Passwort in der Datenbank updaten
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('si', $currentUser['password'], $currentUser['id']);
            
                if ($stmt->execute()) {
                    $success = "Passwort erfolgreich geändert.";
                } else {
                    $error = "Fehler: " . $stmt->error;
                }            
                $stmt->close();
            }
        }
    }
}

$conn->close();
?>