<?php
include 'config/koneksi.php';
include 'helpers/thumbnail_map.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header('Location: /blog_dinamis/index.php');
    exit;
}

// Escape slug for safe query
$slug_safe = mysqli_real_escape_string($conn, $slug);

$kategori = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM categories WHERE slug='$slug_safe' LIMIT 1"
));

if (!$kategori) {
    $pageTitle = 'Kategori Tidak Ditemukan';
    include 'templates/frontend_header.php';
    echo '<div class="bd-layout"><main class="bd-feed"><div class="empty-state"><div class="emoji">🔍</div><p>Kategori tidak ditemukan.</p><a href="/blog_dinamis/index.php" style="color:#1a8917;font-family:sans-serif;">← Kembali ke Beranda</a></div></main></div>';
    include 'templates/frontend_footer.php';
    exit;
}

$pageTitle = 'Kategori: ' . $kategori['nama_kategori'];

$limit  = 8;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page   = ($page < 1) ? 1 : $page;
$offset = ($page - 1) * $limit;

$data = mysqli_query($conn, "
    SELECT a.*, u.nama AS author, c.nama_kategori, c.slug AS kategori_slug
    FROM articles a
    JOIN categories c ON a.category_id = c.id
    JOIN users u ON a.user_id = u.id
    WHERE c.slug = '$slug_safe' AND a.status = 'publish'
    ORDER BY a.id DESC
    LIMIT $limit OFFSET $offset
");

$total_row = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) AS total FROM articles a
     JOIN categories c ON a.category_id = c.id
     WHERE c.slug = '$slug_safe' AND a.status = 'publish'"
));
$total = $total_row ? (int)$total_row['total'] : 0;
$total_pages = ($limit > 0) ? ceil($total / $limit) : 1;

// Popular in this category
$populer_kat = mysqli_query($conn, "
    SELECT a.*, u.nama AS author
    FROM articles a
    JOIN categories c ON a.category_id = c.id
    JOIN users u ON a.user_id = u.id
    WHERE c.slug = '$slug_safe' AND a.status = 'publish'
    ORDER BY a.views DESC
    LIMIT 5
");

// All categories for sidebar
$kategori_sidebar = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");

include 'templates/frontend_header.php';
?>

<div class="bd-layout">

    <!-- FEED -->
    <main class="bd-feed">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-eyebrow">Topik</div>
            <h1 class="page-header-title"><?= htmlspecialchars($kategori['nama_kategori']); ?></h1>
            <p class="page-header-desc"><?= $total; ?> artikel dalam topik ini</p>
        </div>

        <?php if ($total === 0): ?>
        <div class="empty-state">
            <div class="emoji">📭</div>
            <p>Belum ada artikel di kategori ini.</p>
            <a href="/blog_dinamis/index.php" style="color:#1a8917;font-family:sans-serif;">← Kembali ke Beranda</a>
        </div>

        <?php else:
            $is_first = true;
            while ($row = mysqli_fetch_assoc($data)):
                $initial  = strtoupper(substr($row['author'], 0, 1));
                $thumb_src = !empty($row['thumbnail'])
                ? '/blog_dinamis/assets/uploads/thumbnail/' . htmlspecialchars($row['thumbnail'])
                : get_article_thumbnail((int)$row['id'], $row['judul'], (int)$row['category_id'], 'hero');
                $date_str  = !empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : '';
        ?>

        <?php if ($is_first && $page === 1): ?>
        <!-- Hero card for first article -->
        <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($row['slug']); ?>" class="hero-card">
            <img src="<?= $thumb_src; ?>" alt="<?= htmlspecialchars($row['judul']); ?>" class="hero-card-img">
            <div class="hero-card-meta">
                <div class="avatar-circle"><?= $initial; ?></div>
                <span><?= htmlspecialchars($row['author']); ?></span>
                <?php if ($date_str): ?><span style="color:#ccc">·</span><span><?= $date_str; ?></span><?php endif; ?>
            </div>
            <div class="hero-card-title"><?= htmlspecialchars($row['judul']); ?></div>
            <?php if (!empty($row['ringkasan'])): ?>
            <div class="hero-card-excerpt"><?= htmlspecialchars($row['ringkasan']); ?></div>
            <?php endif; ?>
            <div class="hero-card-footer">
                <span>👁 <?= (int)$row['views']; ?> views</span>
            </div>
        </a>

        <?php else: ?>
        <!-- Article row -->
        <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($row['slug']); ?>" class="article-row">
            <div class="article-row-body">
                <div class="article-row-meta">
                    <div class="avatar-circle"><?= $initial; ?></div>
                    <span><?= htmlspecialchars($row['author']); ?></span>
                    <?php if ($date_str): ?><span style="color:#ccc">·</span><span><?= $date_str; ?></span><?php endif; ?>
                </div>
                <div class="article-row-title"><?= htmlspecialchars($row['judul']); ?></div>
                <?php if (!empty($row['ringkasan'])): ?>
                <div class="article-row-excerpt"><?= htmlspecialchars($row['ringkasan']); ?></div>
                <?php endif; ?>
                <div class="article-row-footer">
                    <span>👁 <?= (int)$row['views']; ?> views</span>
                </div>
            </div>

            <img src="<?= $thumb_src; ?>" alt="<?= htmlspecialchars($row['judul']); ?>" class="article-row-thumb">
        </a>
        <?php endif; $is_first = false; endwhile; ?>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <nav class="bd-pagination">
            <?php if ($page > 1): ?><a href="?slug=<?= urlencode($slug); ?>&page=<?= $page - 1; ?>">← Prev</a><?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i === $page): ?><span class="active"><?= $i; ?></span>
                <?php else: ?><a href="?slug=<?= urlencode($slug); ?>&page=<?= $i; ?>"><?= $i; ?></a><?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?><a href="?slug=<?= urlencode($slug); ?>&page=<?= $page + 1; ?>">Next →</a><?php endif; ?>
        </nav>
        <?php endif; ?>

        <?php endif; ?>
    </main>

    <!-- RIGHT SIDEBAR -->
    <aside class="bd-right">
        <?php if (mysqli_num_rows($populer_kat) > 0): ?>
        <div class="right-block">
            <div class="right-block-title">🔥 Populer di Topik Ini</div>
            <?php $rank = 1; while ($p = mysqli_fetch_assoc($populer_kat)): ?>
            <div class="popular-item">
                <div class="popular-rank">0<?= $rank++; ?></div>
                <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($p['slug']); ?>"><?= htmlspecialchars($p['judul']); ?></a>
                <div style="margin-top:3px;font-size:12px;color:#999;font-family:sans-serif;">👁 <?= (int)$p['views']; ?> views</div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <div class="right-block">
            <div class="right-block-title">📚 Topik Lainnya</div>
            <div class="cat-pill-wrap">
                <?php while ($ks = mysqli_fetch_assoc($kategori_sidebar)):
                    $active_class = ($ks['slug'] === $slug) ? 'cat-pill' : 'cat-pill';
                ?>
                <a href="/blog_dinamis/kategori.php?slug=<?= urlencode($ks['slug']); ?>"
                   class="cat-pill" style="<?= ($ks['slug'] === $slug) ? 'background:#242424;color:#fff;' : ''; ?>">
                    <?= htmlspecialchars($ks['nama_kategori']); ?>
                </a>
                <?php endwhile; ?>
            </div>
        </div>
    </aside>

</div>

<?php include 'templates/frontend_footer.php'; ?>
