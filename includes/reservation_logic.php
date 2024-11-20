<?php
session_start();

// Sollte man sich abmelden während man auf der Zimmerreservierungsseite ist, wird man zum Login weitergeleitet
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$error_message = "";
$confirmation_message = "";

// Simulierte Reservierungsliste für den angemeldeten Benutzer
$reservations = [
    [
        "checkin" => "2024-11-25",
        "checkout" => "2024-11-30",
        "breakfast" => "Ja",
        "parking" => "Nein",
        "pets" => "Keine",
        "status" => "neu"
    ],
    [
        "checkin" => "2024-12-01",
        "checkout" => "2024-12-05",
        "breakfast" => "Nein",
        "parking" => "Ja",
        "pets" => "Katze",
        "status" => "bestätigt"
    ],
    [
        "checkin" => "2024-10-15",
        "checkout" => "2024-10-20",
        "breakfast" => "Ja",
        "parking" => "Ja",
        "pets" => "Hund",
        "status" => "storniert"
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $breakfast = $_POST['breakfast'];
    $parking = $_POST['parking'];
    $pets = $_POST['pets'];

    // An- und Abreisedatum validieren
    if (empty($checkin) || empty($checkout)) {
        $error_message = "Bitte geben Sie sowohl Anreise- als auch Abreisedatum ein.";
    } elseif (strtotime($checkout) <= strtotime($checkin)) {
        $error_message = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
    } else {
    // Reservierungsdaten (vorerst nur anzeigen)
    // Dieser Teil kann später erweitert werden, um ihn in einer Datenbank zu speichern
    $confirmation_message = "
    <div style='margin-top: 20px; padding: 15px; border: 1px solid green; background-color: #f9fff9;'>
        <h3>Reservierung erfolgreich!</h3>
        <p><strong>Anreisedatum:</strong> $checkin</p>
        <p><strong>Abreisedatum:</strong> $checkout</p>
        <p><strong>Frühstück:</strong> " . ($breakfast == 'yes' ? 'Ja' : 'Nein') . "</p>
        <p><strong>Parkplatz:</strong> " . ($parking == 'yes' ? 'Ja' : 'Nein') . "</p>
        <p><strong>Haustiere:</strong> " . (!empty($pets) ? $pets : 'Keine') . "</p>
    </div>";
    }
}
?>