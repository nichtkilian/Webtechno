<?php
session_start();

//Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

// Sollte man sich abmelden während man auf der Zimmerreservierungsseite ist, wird man zum Login weitergeleitet
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Funktionen zum Abrufen der Reservierungen aus der Datenbank
function getAllReservations($conn) {
    $stmt = $conn->prepare("SELECT * FROM reservations");
    $stmt->execute();
    return $stmt->get_result();
}

function getUserReservations($conn, $user) {
    $stmt = $conn->prepare("SELECT * FROM reservations where username = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    return $stmt->get_result();
}

function getReservations($conn, $statusFilter) {
    $stmt = $conn->prepare("SELECT * FROM reservations where status = ?");
    $stmt->bind_param('s', $statusFilter);
    $stmt->execute();
    return $stmt->get_result();
}

// Reservierung abschicken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']) && $_SESSION['role'] === 'user') {

    $currentDate = date('Y-m-d'); // Heutiges Datum im Format "YYYY-MM-DD"
    
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    // In True/False konvertieren zur Speicherung in der Datenbank
    if ($_POST['breakfast'] == 'yes') {
        $breakfast = true;
    } else {
        $breakfast = false;
    }
    if ($_POST['parking'] == 'yes') {
        $parking = true;
    } else {
        $parking = false;
    }
    $pets = $_POST['pets'];

    // An- und Abreisedatum validieren
    if (strtotime($checkout) <= strtotime($checkin)) {
        $_SESSION['error'] = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
        header('Location: reservation.php'); // Zurück zum Formular
        exit;
    } elseif (strtotime($checkin) < strtotime($currentDate)) {  
        $_SESSION['error'] = "Reservierungen können nicht vor dem heutigen Datum gemacht werden.";
        header('Location: reservation.php'); // Zurück zum Formular
        exit;
    }
    else {
        // Reservierungsbestätigung anzeigen
        $confirmation_message = "
        <div style='margin-top: 20px; padding: 15px; border: 1px solid green; background-color: #f9fff9;'>
            <h4>Danke für Ihre Reservierung, folgende Daten wurden übermittelt:</h4>
            <p><strong>Anreisedatum:</strong> " . (date('d.m.Y', strtotime($checkin))) . "</p>
            <p><strong>Abreisedatum:</strong> " . (date('d.m.Y', strtotime($checkout))) . "</p>
            <p><strong>Frühstück:</strong> " . ($breakfast == 'yes' ? 'Ja' : 'Nein') . "</p>
            <p><strong>Parkplatz:</strong> " . ($parking == 'yes' ? 'Ja' : 'Nein') . "</p>
            <p><strong>Haustiere:</strong> " . (!empty($pets) ? $pets : 'Keine') . "</p>
        </div>";

        // Reservierungsdaten sammeln
        $reservation = [
            'username' => $_SESSION['user'],
            'checkin' => $checkin,
            'checkout' => $checkout,
            'breakfast' => $breakfast,
            'parking' => $parking,
            'pets' => htmlspecialchars($_POST['pets']),
            'status' => 'neu', // Standard-Status
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Bestehende Reservierungen laden
        $userReservations = getUserReservations($conn, $_SESSION['user']);

        // Neue Reservierung hinzufügen
        $sql_insert = "INSERT INTO reservations (username, checkin, checkout, breakfast, parking, pets, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('sssiiss', $reservation['username'], $reservation['checkin'], $reservation['checkout'], $reservation['breakfast'], $reservation['parking'], $reservation['pets'], $reservation['status']);

        if ($stmt_insert->execute()) {
            $_SESSION['success'] = "Reservierung erfolgreich angelegt!";
        } else {
            $_SESSION['error'] = "Fehler beim Anlegen der Reservierung: " . $stmt_insert->error;
        }

        $stmt_insert->close();       
    }
}

// Benutzer-Reservierungen laden
$userReservations = getUserReservations($conn, $_SESSION['user']);
// Alle Reservierungen laden
$allReservations = getAllReservations($conn);
?>