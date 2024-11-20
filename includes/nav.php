<?php
// Get the current filename without the query string
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand">WEB Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php">Startseite</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage == 'registration.php') ? 'active' : ''; ?>" href="registration.php">Registrierung</a>
            </li>
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage == 'reservation.php') ? 'active' : ''; ?>" href="reservation.php">Zimmerreservierung</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage == 'help.php') ? 'active' : ''; ?>" href="help.php">Hilfe/FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage == 'impressum.php') ? 'active' : ''; ?>" href="impressum.php">Impressum</a>
            </li>
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage == 'profile.php') ? 'active' : ''; ?>" href="profile.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage == 'logout.php') ? 'active' : ''; ?>" href="logout.php">Abmelden</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage == 'login.php') ? 'active' : ''; ?>" href="login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
</nav>