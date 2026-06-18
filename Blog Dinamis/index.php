<?php
include 'config/koneksi.php';
include 'helpers/thumbnail_map.php';

$pageTitle = 'Beranda';

$limit  = 6;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page   = ($page < 1) ? 1 : $page;
$offset = ($page - 1) * $limit;

// All published articles with pagination
$data = mysqli_query($conn, "
    SELECT a.*, u.nama AS author, c.nama_kategori, c.slug AS kategori_slug
    FROM articles a
    JOIN users u ON a.user_id = u.id
    LEFT JOIN categories c ON a.category_id = c.id
    WHERE a.status = 'publish'
    ORDER BY a.id DESC
    LIMIT $limit OFFSET $offset
");

// Total count for pagination
$total_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM articles WHERE status='publish'"));
$total = $total_row ? (int)$total_row['total'] : 0;
$total_pages = ($limit > 0) ? ceil($total / $limit) : 1;

// Popular articles
$populer = mysqli_query($conn, "
    SELECT a.*, c.nama_kategori, c.slug AS kategori_slug
    FROM articles a
    LEFT JOIN categories c ON a.category_id = c.id
    WHERE a.status = 'publish'
    ORDER BY a.views DESC
    LIMIT 5
");

// All categories for right sidebar
$kategori_sidebar = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");

include 'templates/frontend_header.php';
?>

<div class="bd-layout">

    <!-- ===== FEED ===== -->
    <main class="bd-feed">

        <!-- Featured Banner with Real Photo -->
        <div class="bd-featured-banner">
            <img
                src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=900&q=80&auto=format&fit=crop"
                alt="Selamat datang di Blog Dinamis"
                loading="eager"
            >
            <div class="bd-featured-banner-text">
                <div class="bd-featured-banner-eyebrow">✦ Blog Dinamis</div>
                <div class="bd-featured-banner-title">Ide, Cerita &amp; Inspirasi</div>
                <div class="bd-featured-banner-sub">Temukan artikel pilihan seputar teknologi, kuliner, traveling, dan kehidupan sehari-hari.</div>
            </div>
        </div>

        <span class="feed-heading">Untuk Anda</span>

        <?php
        $is_first = true;
        while ($row = mysqli_fetch_assoc($data)):
            $initial = strtoupper(substr($row['author'], 0, 1));
            $thumb_src = !empty($row['thumbnail'])
                ? '/blog_dinamis/assets/uploads/thumbnail/' . htmlspecialchars($row['thumbnail'])
                : get_article_thumbnail((int)$row['id'], $row['judul'], (int)$row['category_id'], 'hero');
            $date_str  = !empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : '';
        ?>

        <?php if ($is_first && $page === 1): // Hero card for first article on page 1 ?>
        <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($row['slug']); ?>" class="hero-card">
            <img src="<?= $thumb_src; ?>" alt="<?= htmlspecialchars($row['judul']); ?>" class="hero-card-img">

            <div class="hero-card-meta">
                <div class="avatar-circle"><?= $initial; ?></div>
                <span><?= htmlspecialchars($row['author']); ?></span>
                <span style="color:#ccc">·</span>
                <a class="badge-cat colored" href="/blog_dinamis/kategori.php?slug=<?= urlencode($row['kategori_slug']); ?>">
                    <?= htmlspecialchars($row['nama_kategori']); ?>
                </a>
            </div>

            <div class="hero-card-title"><?= htmlspecialchars($row['judul']); ?></div>

            <?php if (!empty($row['ringkasan'])): ?>
            <div class="hero-card-excerpt"><?= htmlspecialchars($row['ringkasan']); ?></div>
            <?php endif; ?>

            <div class="hero-card-footer">
                <?php if ($date_str): ?><span><?= $date_str; ?></span><span style="color:#ccc">·</span><?php endif; ?>
                <span>👁 <?= (int)$row['views']; ?> views</span>
            </div>
        </a>

        <?php else: // Regular article row ?>

        <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($row['slug']); ?>" class="article-row">
            <div class="article-row-body">
                <div class="article-row-meta">
                    <div class="avatar-circle"><?= $initial; ?></div>
                    <span><?= htmlspecialchars($row['author']); ?></span>
                    <span style="color:#ccc">·</span>
                    <a class="badge-cat" href="/blog_dinamis/kategori.php?slug=<?= urlencode($row['kategori_slug']); ?>"
                       onclick="event.stopPropagation()">
                        <?= htmlspecialchars($row['nama_kategori']); ?>
                    </a>
                </div>

                <div class="article-row-title"><?= htmlspecialchars($row['judul']); ?></div>

                <?php if (!empty($row['ringkasan'])): ?>
                <div class="article-row-excerpt"><?= htmlspecialchars($row['ringkasan']); ?></div>
                <?php endif; ?>

                <div class="article-row-footer">
                    <?php if ($date_str): ?><span><?= $date_str; ?></span><span style="color:#ccc">·</span><?php endif; ?>
                    <span>👁 <?= (int)$row['views']; ?> views</span>
                </div>
            </div>

            <img src="<?= $thumb_src; ?>" alt="<?= htmlspecialchars($row['judul']); ?>" class="article-row-thumb">
        </a>

        <?php endif; $is_first = false; endwhile; ?>

        <?php if ($total === 0): ?>
        <div class="empty-state">
            <div class="emoji">✍️</div>
            <p>Belum ada artikel yang dipublikasikan.</p>
        </div>
        <?php endif; ?>

        <!-- PAGINATION -->
        <?php if ($total_pages > 1): ?>
        <nav class="bd-pagination" aria-label="Navigasi halaman">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>">← Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i === $page): ?>
                    <span class="active"><?= $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1; ?>">Next →</a>
            <?php endif; ?>
        </nav>
        <?php endif; ?>
    </main>

    <!-- ===== RIGHT SIDEBAR ===== -->
    <aside class="bd-right">

        <!-- Featured Photo Block -->
        <div class="right-block">
            <img
                src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&q=80&auto=format&fit=crop"
                alt="Inspirasi Menulis"
                style="width:100%; height:150px; object-fit:cover; border-radius:8px; margin-bottom:12px;"
                loading="lazy"
            >
            <div style="font-size:13px; color:#6b6b6b; font-family:sans-serif; line-height:1.55;">
                Temukan inspirasi dari setiap cerita. Mulai membaca sekarang.
            </div>
        </div>

        <!-- Popular Articles -->
        <div class="right-block">
            <div class="right-block-title">🔥 Artikel Populer</div>
            <?php
            $rank = 1;
            while ($p = mysqli_fetch_assoc($populer)):
            ?>
            <div class="popular-item">
                <div class="popular-rank">0<?= $rank++; ?></div>
                <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($p['slug']); ?>">
                    <?= htmlspecialchars($p['judul']); ?>
                </a>
                <div style="margin-top:4px; font-size:12px; color:#999; font-family:sans-serif;">
                    <?= htmlspecialchars($p['nama_kategori']); ?> · 👁 <?= (int)$p['views']; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <!-- Browse Topics -->
        <div class="right-block">
            <div class="right-block-title">📚 Jelajahi Topik</div>
            <div class="cat-pill-wrap">
                <?php while ($ks = mysqli_fetch_assoc($kategori_sidebar)): ?>
                <a href="/blog_dinamis/kategori.php?slug=<?= urlencode($ks['slug']); ?>" class="cat-pill">
                    <?= htmlspecialchars($ks['nama_kategori']); ?>
                </a>
                <?php endwhile; ?>
            </div>
        </div>

    </aside>
</div>

<?php include 'templates/frontend_footer.php'; ?>
