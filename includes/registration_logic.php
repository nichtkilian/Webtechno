<?php
session_start();

//Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "Bitte alle Felder ausfüllen.";
        header('Location: registration.php');
        exit;
    }

    // Überprüfen, ob das Passwort mit der Bestätigung übereinstimmt
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwörter stimmen nicht überein.";
        header('Location: registration.php');
        exit;
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirmPassword = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

    // Überprüfen, ob der Benutzername bereits existiert
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('s', $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $_SESSION['error'] = "Fehler: Der Benutzername '$username' ist bereits vergeben.";
    } else {
        // Neuen Benutzer registrieren
        $sql_insert = "INSERT INTO users (username, password, created_at) VALUES (?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('ss', $username, $password);

        if ($stmt_insert->execute()) {
            $_SESSION['success'] = "Registrierung erfolgreich!";
            header('Location: login.php'); // Weiterleitung zur Login-Seite
            exit;
        } else {
            $_SESSION['error'] = "Fehler beim Registrieren des Benutzers: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }
    $stmt_check->close();
}

$conn->close();

?>