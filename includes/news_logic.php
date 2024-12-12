<?php
//Datenbankverbindung herstellen
require 'config/dbaccess.php';
$conn = getDatabaseConnection();

session_start();

// Pfad zum zum Bilder-Ordner
$imageDir = 'images/';

if (!is_dir($imageDir)) {
    mkdir($imageDir, 0777, true); // Bilder-Ordner erstellen
}

// Hochladen von Bildern und Hinzufügen von News (nur für eingeloggte Benutzer)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = $_POST['image'] ?? null; // Optionales Bild;

    // Bild-Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_type = mime_content_type($_FILES['image']['tmp_name']);

        // Zulässige MIME-Dateitypen für Bilder
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (in_array($file_type, $allowed_types)) {
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = $imageDir . $fileName;
    
            // Bild speichern
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath;
            }
        } else {
            $_SESSION['error'] = "Fehler: Nur JPG-, PNG- oder GIF-Dateien sind erlaubt.";
            header('Location: news.php');
            exit;
        }
    }

    $sql = "INSERT INTO news (title, description, image, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $title, $description, $imagePath);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Newsbeitrag erfolgreich hinzugefügt!";
    } else {
        $_SESSION['error'] = "Fehler: " . $stmt->error;
    }

    $stmt->close();
}

// Abrufen der News aus der Datenbank
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
$newsData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsData[] = $row;
    }
}

$conn->close();
?>