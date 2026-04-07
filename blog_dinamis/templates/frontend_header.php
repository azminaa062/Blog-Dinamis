<?php
if (!isset($conn)) {
    include __DIR__ . '/../config/koneksi.php';
}

$kategori_menu = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Blog Dinamis'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/blog_dinamis/assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/blog_dinamis/index.php">Blog Dinamis</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFrontend">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarFrontend">
            <ul class="navbar-nav me-auto">
                <?php while($k = mysqli_fetch_assoc($kategori_menu)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog_dinamis/kategori.php?slug=<?= urlencode($k['slug']); ?>">
                            <?= htmlspecialchars($k['nama_kategori']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>

            <form class="d-flex" action="/blog_dinamis/search.php" method="GET">
                <input class="form-control me-2" type="search" name="q" placeholder="Cari artikel..." required>
                <button class="btn btn-outline-light" type="submit">Cari</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">