<?php
session_start();

//Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT password, role FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password_hash, $role);
        $stmt->fetch();

        // Passwort überprüfen
        if (password_verify($password, $stored_password_hash)) {
            $_SESSION['success'] = "Login erfolgreich!";
            // Login erfolgreich
            $_SESSION['user'] = $username; // Username in der Session speichern
            $_SESSION['role'] = $role; // Rolle (admin oder user) in der Session speichern
            header('Location: profile.php'); // Weiterleitung zum Profil
        } else {
            $_SESSION['error'] = "Benutzername oder Passwort fehlerhaft.";    
        }
    } else {
        $_SESSION['error'] = "Benutzername oder Passwort fehlerhaft.";    
    }
    
    $stmt->close();
}

$conn->close();
?>
