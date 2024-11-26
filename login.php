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

    <div class="bg-light">
      <div class="container mt-5">
          <div class="row justify-content-center">
              <div class="col-md-6">
                  <div class="card shadow-sm">
                      <div class="card-body">
                          <h1 class="text-center">Login</h1>
                          <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                          <form method="POST" action="">
                              <div class="mb-3">
                                  <label for="username" class="form-label">Benutzername</label>
                                  <input type="text" id="username" name="username" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                  <label for="password" class="form-label">Passwort</label>
                                  <input type="password" id="password" name="password" class="form-control" required>
                              </div>
                              <button type="submit" class="btn btn-primary w-100">Einloggen</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
