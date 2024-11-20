<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php") ?>
    <?php require_once('includes/profile_logic.php');?>

    <title>Profil</title>
</head>
<body class="bg-light">
    <header>
        <?php include("includes/nav.php") ?>
    </header>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1>Profil von <?php echo htmlspecialchars($user['name']); ?></h1>
                <p><strong>Benutzername:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>E-Mail:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

                <h2 class="mt-4">Benutzerdaten bearbeiten</h2>

                <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                <!-- Formular zum Ändern des Benutzernamens -->
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="new_username" class="form-label">Neuer Benutzername</label>
                        <input type="text" id="new_username" name="new_username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Benutzernamen ändern</button>
                </form>

                <!-- Passwort ändern -->
                <h2 class="mt-4">Passwort ändern</h2>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Aktuelles Passwort</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Neues Passwort</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Passwort ändern</button>
                </form>
                <p class="mt-4"><a href="logout.php" class="btn btn-danger w-100">Abmelden</a></p>
            </div>
        </div>
    </div>
</body>
</html>
