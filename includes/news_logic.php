<?php
session_start();

// Pfad zur JSON-Datei und zum Bilder-Ordner
$newsFile = 'resources/news.json';
$imageDir = 'images/';

// Sicherstellen, dass der Ordner und die JSON-Datei existieren
if (!is_dir(dirname($newsFile))) {
    mkdir(dirname($newsFile), 0777, true); // Ordner erstellen
}
if (!file_exists($newsFile)) {
    file_put_contents($newsFile, json_encode([])); // Leere JSON-Datei erstellen
}
if (!is_dir($imageDir)) {
    mkdir($imageDir, 0777, true); // Bilder-Ordner erstellen
}

// Hochladen von Bildern und Hinzufügen von News (nur für eingeloggte Benutzer)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = '';

    // Bild-Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $imageDir . $fileName;

        // Bild speichern
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    // News-Daten lesen
    $newsData = json_decode(file_get_contents($newsFile), true);

    // Neue News hinzufügen
    $newsData[] = [
        'title' => $title,
        'description' => $description,
        'image' => $imagePath,
        'created_at' => date('Y-m-d H:i:s')
    ];

    // News-Daten speichern
    file_put_contents($newsFile, json_encode($newsData));
}

// News abrufen
$newsData = json_decode(file_get_contents($newsFile), true);
?>