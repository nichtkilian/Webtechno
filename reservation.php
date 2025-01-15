<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/reservation_logic.php"); ?>

    <title>Zimmerreservierung</title>
</head>
<body>
    <header>
        <?php include("includes/nav.php"); ?>
    </header>

    <!-- Reservierungsformular -->
    <div class="container my-5">
        <!-- Erfolg- oder Fehlermeldungen anzeigen -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Formular nur für normale Benutzer anzeigen (nicht für Admins) -->
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'user'): ?>
            <form action="" method="POST" class="mb-5">
                <h2 class="mb-4 text-center">Zimmerreservierung</h2>
                <div class="mb-3">
                    <label for="checkin">Anreisedatum:</label>
                    <input type="date" id="checkin" name="checkin" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="checkout">Abreisedatum:</label>
                    <input type="date" id="checkout" name="checkout" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="breakfast">Frühstück:</label>
                    <select id="breakfast" name="breakfast" class="form-control">
                        <option value="yes">Ja</option>
                        <option value="no">Nein</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="parking">Parkplatz:</label>
                    <select id="parking" name="parking" class="form-control">
                        <option value="yes">Ja</option>
                        <option value="no">Nein</option>
                    </select>
                </div>
                <div class="mb-3">
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
        <?php endif; ?>

        <!-- Reservierungen des Benutzers anzeigen -->
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'user'): ?>
            <h2>Gespeicherte Reservierungen für Benutzer <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
            <?php if (!empty($userReservations)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Anreisedatum</th>
                            <th>Abreisedatum</th>
                            <th>Frühstück</th>
                            <th>Parkplatz</th>
                            <th>Haustiere</th>
                            <th>Status</th>
                            <th>Erstellt am</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userReservations as $reservation): ?>
                            <tr>
                                <td><?php echo date('d.m.Y', strtotime($reservation['checkin'])); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($reservation['checkout'])); ?></td>
                                <td><?php echo htmlspecialchars($reservation['breakfast'] ? 'Ja' : 'Nein'); ?></td>
                                <td><?php echo htmlspecialchars($reservation['parking'] ? 'Ja' : 'Nein'); ?></td>
                                <td><?php echo htmlspecialchars($reservation['pets']); ?></td>
                                <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                                <td><?php echo date('d.m.Y H:i:s', strtotime($reservation['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Es sind keine Reservierungen vorhanden.</p>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Alle Reservierungen anzeigen (Admin) -->
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin'): ?>
            <h2>Alle gespeicherten Reservierungen</h2>
            <!-- Filterformular nach Status -->
            <form method="GET" action="reservation.php" class="mb-4">
                <div class="form-group">
                    <label for="statusFilter">Filtern nach Status:</label>
                    <select name="status" id="statusFilter" class="form-control">
                        <option value="">Alle</option>
                        <option value="neu" <?php echo (isset($_GET['status']) && $_GET['status'] === 'neu') ? 'selected' : ''; ?>>Neu</option>
                        <option value="bestätigt" <?php echo (isset($_GET['status']) && $_GET['status'] === 'bestätigt') ? 'selected' : ''; ?>>Bestätigt</option>
                        <option value="storniert" <?php echo (isset($_GET['status']) && $_GET['status'] === 'storniert') ? 'selected' : ''; ?>>Storniert</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtern</button>
            </form>
            <?php if (!empty($allReservations)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Benutzer</th>
                            <th>Anreisedatum</th>
                            <th>Abreisedatum</th>
                            <th>Frühstück</th>
                            <th>Parkplatz</th>
                            <th>Haustiere</th>
                            <th>Status</th>
                            <th>Erstellt am</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
                        if ($statusFilter == '') {
                            $reservations = getAllReservations($conn);
                        } else {
                        $reservations = getReservations($conn, $statusFilter);
                        }

                        foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reservation['username']); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($reservation['checkin'])); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($reservation['checkout'])); ?></td>
                                <td><?php echo htmlspecialchars($reservation['breakfast'] ? 'Ja' : 'Nein'); ?></td>
                                <td><?php echo htmlspecialchars($reservation['parking'] ? 'Ja' : 'Nein'); ?></td>
                                <td><?php echo htmlspecialchars($reservation['pets']); ?></td>                                
                                <td>
                                    <form method="POST" action="reservation.php">
                                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                        <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="neu" <?php echo ($reservation['status'] === 'neu') ? 'selected' : ''; ?>>Neu</option>
                                            <option value="bestätigt" <?php echo ($reservation['status'] === 'bestätigt') ? 'selected' : ''; ?>>Bestätigt</option>
                                            <option value="storniert" <?php echo ($reservation['status'] === 'storniert') ? 'selected' : ''; ?>>Storniert</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?php echo date('d.m.Y H:i:s', strtotime($reservation['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Es sind keine Reservierungen vorhanden.</p>
            <?php endif; ?>

            
        <?php endif; ?>

    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>