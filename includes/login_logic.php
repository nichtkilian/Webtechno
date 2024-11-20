<?php
session_start();

// Statische Nutzerdaten für Login
$users = [
    'testuser' => [
        'password' => '12345',
        'name' => 'Max Mustermann',
        'email' => 'max@beispiel.com',
    ],
];

// Login-Logik
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = $users[$username];
        $_SESSION['user']['username'] = $username;
        header('Location: profile.php');
        exit;
    } else {
        $error = "Ungültige Login-Daten.";
    }
}
?>