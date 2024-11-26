<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/login_logic.php"); ?>

    <title>Login</title>
</head>

<body>
    <header>
        <?php include("includes/nav.php"); ?>
    </header>

    <div class="container my-5">
        <h2 class="text-center mb-4">Login</h2>

        <!-- Erfolg- oder Fehlermeldungen anzeigen -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Login-Formular -->
        <form action="" method="post" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="username" class="form-label">Benutzername:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Passwort:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Anmelden</button>
        </form>

        <!-- Link zur Registrierungsseite -->
        <div class="text-center mt-3">
            <p>Noch keinen Account? <a href="registration.php">Jetzt registrieren</a></p>
        </div>
    </div>
</div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
