<?php

// Datenbankzugangsdaten
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'webhoteldb';

// Funktion, um die Verbindung zur Datenbank herzustellen
function getDatabaseConnection() {
    global $host, $username, $password, $database;

    // Verbindung erstellen
    $connection = new mysqli($host, $username, $password, $database);
    $connection->set_charset("utf8");

    // Überprüfen, ob die Verbindung erfolgreich war
    if ($connection->connect_error) {
        die('Verbindung fehlgeschlagen: ' . $connection->connect_error);
    }

    return $connection;
}

?>