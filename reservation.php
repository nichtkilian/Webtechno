<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/reservation_logic.php"); ?>

    <title>Zimmerreservierung</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <?php
        // Fehlermeldung anzeigen, falls vorhanden
        if (!empty($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
    ?>

    <div class="container">
        <form action="" method="POST">
            <h2 class="mb-4 text-center">Zimmerreservierung</h2>
            <div class="form-group">
                <label for="checkin">Anreisedatum:</label>
                <input type="date" id="checkin" name="checkin" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="checkout">Abreisedatum:</label>
                <input type="date" id="checkout" name="checkout" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="breakfast">Frühstück:</label>
                <select id="breakfast" name="breakfast" class="form-control">
                    <option value="yes">Ja</option>
                    <option value="no">Nein</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parking">Parkplatz:</label>
                <select id="parking" name="parking" class="form-control">
                    <option value="yes">Ja</option>
                    <option value="no">Nein</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pets">Haustiere:</label>
                <input type="text" id="pets" name="pets" class="form-control" placeholder="Details zu Haustieren (falls vorhanden)">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Reservieren</button>
            </div>
        </form>

        <!-- Bestätigungsmeldung anzeigen, falls verfügbar -->
        <?php if (!empty($confirmation_message)): ?>
            <?php echo $confirmation_message; ?>
        <?php endif; ?>

        <!-- Liste der Reservierungen anzeigen -->
        <h2>Ihre Reservierungen</h2>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th>Anreisedatum</th>
                <th>Abreisedatum</th>
                <th>Frühstück</th>
                <th>Parkplatz</th>
                <th>Haustiere</th>
                <th>Status</th>
            </tr>
            <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?php echo $reservation['checkin']; ?></td>
                <td><?php echo $reservation['checkout']; ?></td>
                <td><?php echo $reservation['breakfast']; ?></td>
                <td><?php echo $reservation['parking']; ?></td>
                <td><?php echo $reservation['pets']; ?></td>
                <td><?php echo ucfirst($reservation['status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>