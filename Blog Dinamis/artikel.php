<?php
include 'config/koneksi.php';
include 'helpers/thumbnail_map.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header('Location: /blog_dinamis/index.php');
    exit;
}

$slug_safe = mysqli_real_escape_string($conn, $slug);

// Increment views
mysqli_query($conn, "UPDATE articles SET views = views + 1 WHERE slug='$slug_safe' AND status='publish'");

$query = mysqli_query($conn, "
    SELECT a.*, u.nama AS author, c.nama_kategori, c.slug AS kategori_slug
    FROM articles a
    JOIN users u ON a.user_id = u.id
    LEFT JOIN categories c ON a.category_id = c.id
    WHERE a.slug = '$slug_safe' AND a.status = 'publish'
    LIMIT 1
");

$artikel = mysqli_fetch_assoc($query);

if (!$artikel) {
    $pageTitle = 'Artikel Tidak Ditemukan';
    include 'templates/frontend_header.php';
    echo '<div style="max-width:720px;margin:80px auto;padding:0 24px;font-family:sans-serif;text-align:center;">
        <div style="font-size:48px;margin-bottom:16px;">😕</div>
        <h2 style="font-weight:700;">Artikel tidak ditemukan</h2>
        <p style="color:#6b6b6b;">Artikel mungkin telah dihapus atau URL salah.</p>
        <a href="/blog_dinamis/index.php" style="color:#1a8917;">← Kembali ke Beranda</a>
    </div>';
    include 'templates/frontend_footer.php';
    exit;
}

$pageTitle = $artikel['judul'];

// Tags
$tags = mysqli_query($conn, "
    SELECT t.*
    FROM tags t
    JOIN article_tags at2 ON t.id = at2.tag_id
    WHERE at2.article_id = " . (int)$artikel['id']
);

// Approved comments
$comments = mysqli_query($conn, "
    SELECT * FROM comments
    WHERE article_id = " . (int)$artikel['id'] . " AND status = 'approved'
    ORDER BY id DESC
");

// Related articles (same category, exclude current)
$related = mysqli_query($conn, "
    SELECT a.slug, a.judul, a.thumbnail, a.views, u.nama AS author
    FROM articles a
    JOIN users u ON a.user_id = u.id
    WHERE a.category_id = " . (int)$artikel['category_id'] . "
      AND a.status = 'publish'
      AND a.id != " . (int)$artikel['id'] . "
    ORDER BY a.views DESC
    LIMIT 3
");

include 'templates/frontend_header.php';

$thumb_src = !empty($artikel['thumbnail'])
    ? '/blog_dinamis/assets/uploads/thumbnail/' . htmlspecialchars($artikel['thumbnail'])
    : get_article_thumbnail((int)$artikel['id'], $artikel['judul'], (int)$artikel['category_id'], 'hero');
$date_str = !empty($artikel['created_at']) ? date('d M Y', strtotime($artikel['created_at'])) : '';
$initial  = strtoupper(substr($artikel['author'], 0, 1));
?>

<!-- Article Detail -->
<div style="padding-top:57px;">

    <div class="article-detail-wrap">

        <a href="/blog_dinamis/kategori.php?slug=<?= urlencode($artikel['kategori_slug']); ?>" class="btn-back">
            ← <?= htmlspecialchars($artikel['nama_kategori']); ?>
        </a>

        <div class="article-detail-category"><?= htmlspecialchars($artikel['nama_kategori']); ?></div>

        <h1 class="article-detail-title"><?= htmlspecialchars($artikel['judul']); ?></h1>

        <div class="article-detail-meta">
            <div class="avatar-circle lg"><?= $initial; ?></div>
            <div>
                <strong style="color:#242424"><?= htmlspecialchars($artikel['author']); ?></strong>
                <div style="font-size:12px; color:#999; margin-top:1px;">
                    <?= $date_str; ?> <span class="sep">·</span> 👁 <?= (int)$artikel['views']; ?> views
                </div>
            </div>
        </div>

        <img src="<?= $thumb_src; ?>" alt="<?= htmlspecialchars($artikel['judul']); ?>" class="article-detail-hero">

        <div class="article-detail-body">
            <?= nl2br($artikel['isi']); ?>
        </div>

        <!-- Tags -->
        <?php if (mysqli_num_rows($tags) > 0): ?>
        <div class="article-tags">
            <?php while ($t = mysqli_fetch_assoc($tags)): ?>
            <a href="/blog_dinamis/tag.php?slug=<?= urlencode($t['slug']); ?>" class="tag-pill">
                #<?= htmlspecialchars($t['nama_tag']); ?>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

    </div>

    <!-- Related Articles -->
    <?php if ($related && mysqli_num_rows($related) > 0): ?>
    <div style="max-width:720px;margin:0 auto;padding:0 24px 40px;">
        <div style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:#999;font-family:sans-serif;margin-bottom:20px;">Artikel Terkait</div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;">
            <?php while ($rel = mysqli_fetch_assoc($related)):
                $rel_thumb = !empty($rel['thumbnail'])
                    ? '/blog_dinamis/assets/uploads/thumbnail/' . htmlspecialchars($rel['thumbnail'])
                    : get_article_thumbnail((int)$rel['id'], $rel['judul'], 0, 'thumb');
            ?>
            <a href="/blog_dinamis/artikel.php?slug=<?= urlencode($rel['slug']); ?>"
               style="display:block;text-decoration:none;color:inherit;">
                <img src="<?= $rel_thumb; ?>" alt="" style="width:100%;height:120px;object-fit:cover;border-radius:4px;margin-bottom:10px;">
                <div style="font-size:15px;font-weight:700;font-family:sans-serif;line-height:1.3;color:#242424;"><?= htmlspecialchars($rel['judul']); ?></div>
                <div style="font-size:12px;color:#999;font-family:sans-serif;margin-top:4px;"><?= htmlspecialchars($rel['author']); ?> · 👁 <?= (int)$rel['views']; ?></div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Comments Section -->
    <div class="comments-section" id="komentar">
        <hr style="border-color:#e6e6e6; margin:0 0 28px;">

        <div class="comments-title">Komentar (<?= mysqli_num_rows($comments); ?>)</div>

        <?php if (mysqli_num_rows($comments) > 0):
            mysqli_data_seek($comments, 0);
            while ($komen = mysqli_fetch_assoc($comments)):
        ?>
        <div class="comment-item">
            <div class="comment-author"><?= htmlspecialchars($komen['nama']); ?></div>
            <div class="comment-body"><?= nl2br(htmlspecialchars($komen['isi_komentar'])); ?></div>
        </div>
        <?php endwhile; else: ?>
        <p style="font-family:sans-serif;color:#999;font-size:14px;">Belum ada komentar. Jadilah yang pertama!</p>
        <?php endif; ?>

        <!-- Comment Form -->
        <div class="comment-form">
            <div class="comment-form-title">Tulis Komentar</div>
            <form action="/blog_dinamis/komentar.php" method="POST">
                <input type="hidden" name="article_id" value="<?= (int)$artikel['id']; ?>">
                <div class="form-field">
                    <label for="nama">Nama *</label>
                    <input type="text" id="nama" name="nama" required placeholder="Nama Anda">
                </div>
                <div class="form-field">
                    <label for="email">Email (opsional)</label>
                    <input type="email" id="email" name="email" placeholder="email@contoh.com">
                </div>
                <div class="form-field">
                    <label for="isi_komentar">Komentar *</label>
                    <textarea id="isi_komentar" name="isi_komentar" rows="5" required placeholder="Tulis komentar Anda..."></textarea>
                </div>
                <button type="submit" class="btn-submit">Kirim Komentar</button>
            </form>
        </div>
    </div>

</div>

<?php include 'templates/frontend_footer.php'; ?>
