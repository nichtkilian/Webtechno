<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>
    <?php require_once("includes/news_logic.php"); ?>

    <title>News Verwaltung</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>News Verwaltung</h2>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>

        <!-- Formular nur für eingeloggte Admins anzeigen -->
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin'): ?>
            <form action="" method="post" enctype="multipart/form-data" class="mb-5">
                <div class="mb-3">
                    <label for="title" class="form-label">Titel:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Beschreibung:</label>
                    <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Bild:</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Hinzufügen</button>
            </form>
        <?php endif; ?>

        <!-- Alle News anzeigen -->
        <h2 class="mb-4">Alle News</h2>
        <div class="row">
            <?php if (!empty($newsData)): ?>
                <?php foreach ($newsData as $news): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <?php if (!empty($news['image'])): ?>
                                <img src="<?php echo htmlspecialchars($news['image']); ?>" class="card-img-top" alt="News Bild" style="max-height: 300px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($news['description'])); ?></p>
                                <p class="text-muted" style="font-size: 0.9rem;">Erstellt am: <?php echo htmlspecialchars($news['created_at']); ?></p>
                                <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin'): ?>
                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="delete_news_id" value="<?php echo $news['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Löschen</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Keine News vorhanden.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>