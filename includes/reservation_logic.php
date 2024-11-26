<?php
session_start();

// Sollte man sich abmelden während man auf der Zimmerreservierungsseite ist, wird man zum Login weitergeleitet
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Pfad zur JSON-Datei
$reservationsFile = 'resources/reservations.json';

// Sicherstellen, dass der Ordner und die Datei existieren
if (!is_dir(dirname($reservationsFile))) {
    mkdir(dirname($reservationsFile), 0777, true);
}
if (!file_exists($reservationsFile)) {
    file_put_contents($reservationsFile, json_encode([])); // Leere JSON-Datei erstellen
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $currentDate = date('Y-m-d'); // Heutiges Datum im Format "YYYY-MM-DD"
    
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $breakfast = $_POST['breakfast'];
    $parking = $_POST['parking'];
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
            'checkin' => $checkin,
            'checkout' => $checkout,
            'breakfast' => isset($_POST['breakfast']) ? 'Ja' : 'Nein',
            'parking' => isset($_POST['parking']) ? 'Ja' : 'Nein',
            'pets' => htmlspecialchars($_POST['pets']),
            'status' => 'neu', // Standard-Status
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Bestehende Reservierungen laden
        $reservations = json_decode(file_get_contents($reservationsFile), true);

        // Neue Reservierung hinzufügen
        $reservations[] = $reservation;

        // Aktualisierte Reservierungen in der Datei speichern
        file_put_contents($reservationsFile, json_encode($reservations));

        $_SESSION['success'] = "Reservierung erfolgreich angelegt!";
    }
}
?>