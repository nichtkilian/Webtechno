<?php
session_start();

$error_message = "";

// Der Speicherort der Benutzerdaten-Datei
$data_file = "users.txt";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzerdaten aus dem Formular abrufen und bereinigen
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Überprüfen, ob das Passwort zweimal gleich eingegeben wurde
    if ($password !== $confirm_password) {
        $error_message = "Die Passwörter stimmen nicht überein. Bitte versuchen Sie es erneut.";
    } else {
        // Überprüfen, ob der Benutzername bereits existiert
        $users = file($data_file, FILE_IGNORE_NEW_LINES);  // Alle Benutzerdaten aus der Datei lesen
        foreach ($users as $user) {
            list($existing_username, $existing_password) = explode(",", $user);
            if ($existing_username === $username) {
                $error_message = "Dieser Benutzername ist bereits vergeben.";
                break;
            }
        }

        // Wenn der Benutzername noch nicht existiert, speichern wir die neuen Daten
        if (empty($error_message)) {
            // Das Passwort in einem sicheren Hash speichern
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Benutzerdaten in die Datei schreiben
            file_put_contents($data_file, $username . "," . $hashed_password . PHP_EOL, FILE_APPEND);

            // Erfolgreiche Registrierung - Benutzername in Session speichern
            $_SESSION['username'] = $username;
            header("Location: profile.php");  // Weiter zur Profilseite
            exit();
        }
    }
}
?>