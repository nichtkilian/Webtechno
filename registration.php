<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php") ?>

    <title>Registrierungsformular</title>
</head>

<body>
    <header>
    <?php include("includes/nav.php") ?>
    </header>
    
    <form class="container my-5" action="/register" method="POST">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4 text-center">Registrieren</h2>
          <div class="form-group mb-3">
            <label for="salutation" class="form-label">Anrede:</label>
            <select id="salutation" class="form-select" required>
              <option></option>
              <option>Frau</option>
              <option>Herr</option>
              <option>Divers</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="name" class="form-label">Vorname:</label>
            <input id="name" type="text" class="form-control" required>    
          </div>
          <div class="form-group mb-3">
            <label for="surname" class="form-label">Nachname:</label>
            <input id="surname" type="text" class="form-control" required>    
          </div>
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="name" type="email" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="user" class="form-label">Username:</label>
            <input id="user" type="text" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Passwort:</label>
            <input id="password" type="password" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="password_check" class="form-label">Passwort wiederholen:</label>
            <input id="confirm_password" type="password" class="form-control" required>    
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success">Registrieren</button>
          </div>
        </div>
      </div>                     
    </form>
    <?php include("includes/footer.php") ?>
</body>
</html>