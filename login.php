<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php") ?>

    <title>Login Formular</title>
</head>

<body>
    <header>
    <?php include("includes/nav.php") ?>
    </header>

    <form class="container my-5" action="/login" method="POST">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4 text-center">Login</h2>
          <div class="form-group mb-3">
            <label for="username" class="form-label">Benutzername</label>
            <input type="email" class="form-control" id="username" required>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="password" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success">Login</button>
          </div>
        </div>
      </div>
    </form>
    <?php include("includes/footer.php") ?>
</body>
</html>
