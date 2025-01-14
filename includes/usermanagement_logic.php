<?php
session_start();

// Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

// Benutzerliste abrufen
$stmt = $conn->prepare("SELECT id, role, status, username, salutation, name, surname, email FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Benutzerstatus ändern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user_id'])) {
    $userId = $_POST['update_user_id'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $salutation = $_POST['salutation'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    $updateStmt = $conn->prepare("UPDATE users SET role = ?, status = ?, salutation = ?, name = ?, surname = ?, email = ?  WHERE id = ?");
    $updateStmt->bind_param("ssssssi", $role, $status, $salutation, $name, $surname, $email, $userId);
    if ($updateStmt->execute()) {
        $_SESSION['success'] = 'Benutzerdaten erfolgreich geändert.';
    } else {
        $_SESSION['error'] = 'Fehler beim Ändern der Benutzerdaten.';
    }
    $updateStmt->close();

    // Seite neu laden
    header("Location: usermanagement.php");
    exit;
}

// Passwort zurücksetzen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_user_id'])) {
    $resetUserId = $_POST['reset_user_id'];
    $newPassword = password_hash("default123", PASSWORD_BCRYPT);

    $resetStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $resetStmt->bind_param("si", $newPassword, $resetUserId);
    if ($resetStmt->execute()) {
        $_SESSION['success'] = 'Passwort erfolgreich zurückgesetzt (default123).';
    } else {
        $_SESSION['error'] = 'Fehler beim Zurücksetzen des Passworts.';
    }
    $resetStmt->close();
}
?>
