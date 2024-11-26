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

    <?php
    // Fehlermeldung anzeigen, falls vorhanden
    if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
    
    <form class="container my-5 was-validated" action="" method="POST">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4 text-center">Registrieren</h2>
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
            <input name="name" id="name" type="text" class="form-control" required>  
            <div class="invalid-feedback">
              Bitte Vorname eingeben
            </div>  
          </div>
          <div class="form-group mb-3">
            <label for="surname" class="form-label">Nachname:</label>
            <input name="surname" id="surname" type="text" class="form-control" required>  
            <div class="invalid-feedback">
              Bitte Nachname eingeben
            </div>    
          </div>
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input name="email" id="email" type="email" class="form-control" required>
            <div class="invalid-feedback">
              Bitte E-Mail-Adresse eingeben
            </div>  
          </div>
          <div class="form-group mb-3">
            <label for="username" class="form-label">Username:</label>
            <input name="username" id="username" type="text" class="form-control" required>
            <div class="invalid-feedback">
              Bitte Benutzername eingeben
            </div>  
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Passwort:</label>
            <input name="password" id="password" type="password" class="form-control" required>
            <div class="invalid-feedback">
              Bitte Passwort eingeben
            </div>  
          </div>
          <div class="form-group mb-3">
            <label for="confirm_password" class="form-label">Passwort wiederholen:</label>
            <input name="confirm_password" id="confirm_password" type="password" class="form-control" required>
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
    <?php include("includes/footer.php"); ?>
</body>
</html>