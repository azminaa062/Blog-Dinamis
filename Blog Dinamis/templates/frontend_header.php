<?php
if (!isset($conn)) {
    include __DIR__ . '/../config/koneksi.php';
}
$kategori_menu = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Blog Dinamis' : 'Blog Dinamis'; ?></title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%231a8917'/><path d='M8 10h16M8 16h12M8 22h14' stroke='white' stroke-width='2.2' stroke-linecap='round'/></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/blog_dinamis/assets/css/medium.css" rel="stylesheet">
</head>
<body>

<!-- TOPBAR -->
<nav class="bd-topbar">
    <button class="bd-hamburger" onclick="bdToggleSidebar()" title="Menu">
        <svg width="22" height="22" fill="none" stroke="#242424" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="19" y2="6"/>
            <line x1="3" y1="12" x2="19" y2="12"/>
            <line x1="3" y1="18" x2="19" y2="18"/>
        </svg>
    </button>

    <a href="/blog_dinamis/index.php" class="brand">Blog Dinamis</a>

    <form class="search-wrap" action="/blog_dinamis/search.php" method="GET">
        <svg width="15" height="15" fill="none" stroke="#999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="6.5" cy="6.5" r="4.5"/><line x1="10" y1="10" x2="14" y2="14"/>
        </svg>
        <input type="search" name="q" placeholder="Cari artikel..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
    </form>

</nav>

<!-- LEFT SIDEBAR -->
<aside class="bd-sidebar" id="bdSidebar">
    <a href="/blog_dinamis/index.php" class="nav-item <?= ($current_page === 'index.php') ? 'active' : ''; ?>">
        <svg viewBox="0 0 24 24"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
        Beranda
    </a>
    <div class="sidebar-section-title">Topik</div>
    <?php if ($kategori_menu): mysqli_data_seek($kategori_menu, 0); while ($k = mysqli_fetch_assoc($kategori_menu)): $active = (isset($_GET['slug']) && $_GET['slug'] === $k['slug']) ? 'active' : ''; ?>
    <a href="/blog_dinamis/kategori.php?slug=<?= urlencode($k['slug']); ?>" class="nav-item <?= $active; ?>">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        <?= htmlspecialchars($k['nama_kategori']); ?>
    </a>
    <?php endwhile; endif; ?>
</aside>

<div class="bd-backdrop" id="bdBackdrop" onclick="bdCloseSidebar()"></div>
