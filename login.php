<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php") ?>
    <?php include("includes/logincheck.php") ?>

    <title>Login Formular</title>
</head>

<body>
    <header>
    <?php include("includes/nav.php") ?>
    </header>

    <?php
    // Begrüßung, falls Benutzer eingeloggt ist
    if (isset($_SESSION['username'])) {
        echo "Willkommen, " . htmlspecialchars($_SESSION['username']) . "!";
        echo '<br><a href="logout.php">Abmelden</a>';
    } else {
        // Login-Formular anzeigen, falls der Benutzer nicht eingeloggt ist
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
    ?>
      <form class="container my-5" action="" method="POST">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <h2 class="mb-4 text-center">Login</h2>
            <div class="form-group mb-3">
              <label for="username" class="form-label">Benutzername</label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label for="password" class="form-label">Passwort</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-success">Login</button>
            </div>
          </div>
        </div>
      </form>
    <?php
    }
    ?>



    <?php include("includes/footer.php") ?>
</body>
</html>
