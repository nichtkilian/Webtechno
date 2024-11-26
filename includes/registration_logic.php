<?php
session_start();

// Pfad zur JSON-Datei, in der die Benutzerdaten gespeichert werden
$usersFile = 'resources/users.json';

// Sicherstellen, dass der Ordner und die Datei existieren
if (!is_dir(dirname($usersFile))) {
    mkdir(dirname($usersFile), 0777, true);
}
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([])); // Leere JSON-Datei erstellen
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
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

    // Bestehende Benutzer aus der JSON-Datei laden
    $users = json_decode(file_get_contents($usersFile), true);

    // Überprüfen, ob der Benutzername bereits existiert
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $_SESSION['error'] = "Benutzername ist bereits vergeben.";
            header('Location: registration.php');
            exit;
        }
    }

    // Neuen Benutzer hinzufügen
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Passwort sicher hashen
    $users[] = [
        'username' => $username,
        'password' => $hashedPassword,
        'created_at' => date('Y-m-d H:i:s')
    ];

    // Benutzer in der JSON-Datei speichern
    file_put_contents($usersFile, json_encode($users));

    $_SESSION['success'] = "Registrierung erfolgreich!";
    header('Location: login.php'); // Weiterleitung zur Login-Seite
    exit;
}
?>