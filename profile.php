<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/profile_logic.php"); ?>

    <title>Profil</title>
</head>
<body class="bg-light">
    <header>
        <?php include("includes/nav.php"); ?>
    </header>
    <div class="container my-5">
        <h2 class="text-center mb-4">Profil</h2>

        <!-- Fehler- und Erfolgsmeldungen -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <!-- Benutzerprofil anzeigen -->
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title">Benutzername:</h5>
                <p class="card-text"><?php echo htmlspecialchars($currentUser['username']); ?></p>
                <h5 class="card-title">Erstellt am:</h5>
                <p class="card-text"><?php echo date('d.m.Y H:i:s', strtotime($currentUser['created_at'])); ?></p>
            </div>
        </div>

        <!-- Passwort ändern Formular -->
        <h2 class="text-center mt-4">Passwort ändern</h2>
        <form action="profile.php" method="post" class="mx-auto" style="max-width: 400px;">
            <input type="hidden" name="action" value="change_password">
            <div class="mb-3">
                <label for="current_password" class="form-label">Aktuelles Passwort:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Neues Passwort:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_new_password" class="form-label">Neues Passwort bestätigen:</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Passwort ändern</button>
        </form>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>
