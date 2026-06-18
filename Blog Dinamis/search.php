<?php
include 'config/koneksi.php';
include 'helpers/thumbnail_map.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$pageTitle = 'Pencarian: ' . ($q ?: 'Semua Artikel');

$data = null;
if ($q !== '') {
    $q_safe = mysqli_real_escape_string($conn, $q);
    $data = mysqli_query($conn, "
        SELECT a.*, u.nama AS author, c.nama_kategori, c.slug AS kategori_slug
        FROM articles a
        JOIN users u ON a.user_id = u.id
        JOIN categories c ON a.category_id = c.id
        WHERE a.status = 'publish'
          AND (a.judul LIKE '%$q_safe%' OR a.ringkasan LIKE '%$q_safe%' OR a.isi LIKE '%$q_safe%')
        ORDER BY a.id DESC
    ");
}

$kategori_sidebar = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");

include 'templates/frontend_header.php';
?>

<div class="bd-layout">
    <main class="bd-feed">

        <div class="search-hero">
            <div class="search-hero-label">Hasil Pencarian</div>
            <h1 class="search-hero-title">
                <?php if ($q): ?>
                    &ldquo;<?= htmlspecialchars($q); ?>&rdquo;
                <?php else: ?>
                    Masukkan kata kunci
                <?php endif; ?>
            </h1>
            <?php if ($data): ?>
                <p style="margin:8px 0 0;font-size:14px;color:#999;font-family:sans-serif;">
                    <?= mysqli_num_rows($data); ?> artikel ditemukan
                </p>
            <?php endif; ?>
        </div>

        <?php if (!$q): ?>
        <div class="empty-state">
            <div class="emoji">🔍</div>
            <p>Gunakan kotak pencarian di atas untuk mencari artikel.</p>
        </div>

        <?php elseif (!$data || mysqli_num_rows($data) === 0): ?>
        <div class="empty-state">
            <div class="emoji">😕</div>
            <p>Tidak ada artikel yang cocok dengan <strong><?= htmlspecialchars($q); ?></strong></p>
            <a href="/blog_dinamis/index.php" style="color:#1a8917;font-family:sans-serif;">← Lihat semua artikel</a>
        </div>

        <?php else:
            $is_first = true;
            while ($row = mysqli_fetch_assoc($data)):
                $initial   = strtoupper(substr($row['author'], 0, 1));
                $thumb_src = !empty($row['thumbnail'])
                ? '/blog_dinamis/assets/uploads/thumbnail/' . htmlspecialchars($row['thumbnail'])
                : get_article_thumbnail((int)$row['id'], $row['judul'], (int)$row['category_id'], 'hero');
                $date_str  = !empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : '';
        ?>

        <?php if ($is_first): ?>
        <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($row['slug']); ?>" class="hero-card">
            <img src="<?= $thumb_src; ?>" alt="" class="hero-card-img">
            <div class="hero-card-meta">
                <div class="avatar-circle"><?= $initial; ?></div>
                <span><?= htmlspecialchars($row['author']); ?></span>
                <span style="color:#ccc">·</span>
                <a class="badge-cat colored" href="/blog_dinamis/kategori.php?slug=<?= urlencode($row['kategori_slug']); ?>"
                   onclick="event.stopPropagation()">
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

        <?php else: ?>
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
            <img src="<?= $thumb_src; ?>" alt="" class="article-row-thumb">
        </a>
        <?php endif; $is_first = false; endwhile;
        endif; ?>

    </main>

    <!-- Right Sidebar -->
    <aside class="bd-right">
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
