<?php
include 'config/koneksi.php';

$slug = $_GET['slug'];

mysqli_query($conn, "UPDATE articles SET views = views + 1 WHERE slug='$slug' AND status='publish'");

$query = mysqli_query($conn, "
    SELECT articles.*, users.nama as author, categories.nama_kategori, categories.slug as kategori_slug
    FROM articles
    JOIN users ON articles.user_id = users.id
    JOIN categories ON articles.category_id = categories.id
    WHERE articles.slug='$slug' AND articles.status='publish'
    LIMIT 1
");

$artikel = mysqli_fetch_assoc($query);

$tags = mysqli_query($conn, "
    SELECT tags.*
    FROM tags
    JOIN article_tags ON tags.id = article_tags.tag_id
    WHERE article_tags.article_id='{$artikel['id']}'
");

$comments = mysqli_query($conn, "
    SELECT * FROM comments
    WHERE article_id='{$artikel['id']}' AND status='approved'
    ORDER BY id DESC
");

$pageTitle = $artikel['judul'];

include 'templates/frontend_header.php';
?>

<a href="index.php" class="btn btn-secondary btn-sm mb-3">← Kembali</a>

<h1><?= htmlspecialchars($artikel['judul']); ?></h1>

<p class="text-muted">
    Oleh <?= htmlspecialchars($artikel['author']); ?> |
    Kategori:
    <a href="kategori.php?slug=<?= urlencode($artikel['kategori_slug']); ?>">
        <?= htmlspecialchars($artikel['nama_kategori']); ?>
    </a> |
    Views: <?= htmlspecialchars($artikel['views']); ?>
</p>

<div class="mb-3">
    <?php while($t = mysqli_fetch_assoc($tags)) : ?>
        <a href="tag.php?slug=<?= urlencode($t['slug']); ?>" class="badge bg-primary text-decoration-none">
            #<?= htmlspecialchars($t['nama_tag']); ?>
        </a>
    <?php endwhile; ?>
</div>

<?php if (!empty($artikel['thumbnail'])) : ?>
    <img src="assets/uploads/thumbnail/<?= htmlspecialchars($artikel['thumbnail']); ?>" class="img-fluid mb-3" style="max-height: 300px;">
<?php endif; ?>

<div class="mb-4">
    <?= nl2br($artikel['isi']); ?>
</div>

<hr>
<h4>Komentar</h4>

<?php while($komen = mysqli_fetch_assoc($comments)) : ?>
    <div class="card mb-2">
        <div class="card-body">
            <b><?= htmlspecialchars($komen['nama']); ?></b>
            <p class="mb-0"><?= nl2br(htmlspecialchars($komen['isi_komentar'])); ?></p>
        </div>
    </div>
<?php endwhile; ?>

<hr>
<h4>Tulis Komentar</h4>
<form action="komentar.php" method="POST">
    <input type="hidden" name="article_id" value="<?= $artikel['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Komentar</label>
        <textarea name="isi_komentar" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
</form>

<?php include 'templates/frontend_footer.php'; ?>