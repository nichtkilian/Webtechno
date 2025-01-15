<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/usermanagement_logic.php"); ?>

    <title>Benutzerverwaltung</title>
</head>
<body>
    <header>
        <?php include("includes/nav.php"); ?>
    </header>

    <div class="container my-5">
        <h2 class="text-center mb-4">Benutzerverwaltung</h2>

        <?php
        // Alert-Meldungen anzeigen
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- Benutzerliste anzeigen -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Benutzername</th>
                    <th>Anrede</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>E-Mail</th>
                    <th>Rolle</th>
                    <th>Status</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <form method="POST">
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td>
                                <select name="salutation" class="form-control">
                                    <option value="Frau" <?php echo ($user['salutation'] === 'Frau') ? 'selected' : ''; ?>>Frau</option>
                                    <option value="Herr" <?php echo ($user['salutation'] === 'Herr') ? 'selected' : ''; ?>>Herr</option>
                                    <option value="Divers" <?php echo ($user['salutation'] === 'Divers') ? 'selected' : ''; ?>>Divers</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="surname" value="<?php echo htmlspecialchars($user['surname']); ?>" class="form-control">
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control">
                            </td>
                            <td>
                                <select name="role" class="form-control">
                                    <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>Benutzer</option>
                                </select>
                            </td>
                            <td>
                                <select name="status" class="form-control">
                                    <option value="aktiv" <?php echo ($user['status'] === 'aktiv') ? 'selected'; ?>>Aktiv</option>
                                    <option value="inaktiv" <?php echo ($user['status'] === 'inaktiv') ? 'selected'; ?>>Inaktiv</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="update_user_id" value="<?php echo $user['id']; ?>" class="btn btn-success btn-sm">Speichern</button>
                                <button type="submit" name="reset_user_id" value="<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Passwort zurücksetzen</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
