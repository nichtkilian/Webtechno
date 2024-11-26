<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/registration_logic.php"); ?>

    <title>Registrierungsformular</title>
</head>

<body>
    <header>
    <?php include("includes/nav.php"); ?>
    </header>

    <div class="container my-5">

        <!-- Erfolg- oder Fehlermeldungen anzeigen -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form class="container my-5 was-validated" action="" method="POST">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <h2 class="mb-4 text-center">Registrierung</h2>
              <div class="form-group mb-3">
                <label for="salutation" class="form-label">Anrede:</label>
                <select name="salutation" id="salutation" class="form-select" required>
                  <option></option>
                  <option>Frau</option>
                  <option>Herr</option>
                  <option>Divers</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label for="name" class="form-label">Vorname:</label>
                <input type="text" name="name" id="name" class="form-control" required>  
                <div class="invalid-feedback">
                  Bitte Vorname eingeben
                </div>  
              </div>
              <div class="form-group mb-3">
                <label for="surname" class="form-label">Nachname:</label>
                <input type="text" name="surname" id="surname" class="form-control" required>  
                <div class="invalid-feedback">
                  Bitte Nachname eingeben
                </div>    
              </div>
              <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="invalid-feedback">
                  Bitte E-Mail-Adresse eingeben
                </div>  
              </div>
              <div class="form-group mb-3">
                <label for="username" class="form-label">Benutzername:</label>
                <input type="text" id="username" name="username" class="form-control" required>
                <div class="invalid-feedback">
                  Bitte Benutzername eingeben
                </div>  
              </div>
              <div class="form-group mb-3">
                <label for="password" class="form-label">Passwort:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="invalid-feedback">
                  Bitte Passwort eingeben
                </div>  
              </div>
              <div class="form-group mb-3">
                <label for="confirm_password" class="form-label">Passwort bestätigen:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                <div class="invalid-feedback">
                  Bitte das Passwort wiederholen
                </div>  
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-success">Registrieren</button>
              </div>
            </div>
          </div>                     
        </form>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>