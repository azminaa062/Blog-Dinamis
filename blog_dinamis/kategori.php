<?php
include 'config/koneksi.php';

$slug = $_GET['slug'];

$kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE slug='$slug'"));

$pageTitle = 'Kategori: ' . $kategori['nama_kategori'];

$data = mysqli_query($conn, "
    SELECT articles.*, users.nama as author
    FROM articles
    JOIN categories ON articles.category_id = categories.id
    JOIN users ON articles.user_id = users.id
    WHERE categories.slug='$slug' AND articles.status='publish'
");

include 'templates/frontend_header.php';
?>

<h2>Kategori: <?= htmlspecialchars($kategori['nama_kategori']); ?></h2>

<?php while($row = mysqli_fetch_assoc($data)) : ?>
<div class="card mb-3">
    <div class="card-body">
        <?php if (!empty($row['thumbnail'])) : ?>
            <img src="assets/uploads/thumbnail/<?= htmlspecialchars($row['thumbnail']); ?>" class="img-fluid mb-3" style="max-height: 200px;">
        <?php endif; ?>

        <h4><?= htmlspecialchars($row['judul']); ?></h4>
        <p class="text-muted">Oleh <?= htmlspecialchars($row['author']); ?></p>
        <p><?= htmlspecialchars($row['ringkasan']); ?></p>
        <a href="artikel.php?slug=<?= urlencode($row['slug']); ?>" class="btn btn-primary btn-sm">Baca</a>
    </div>
</div>
<?php endwhile; ?>

<?php include 'templates/frontend_footer.php'; ?>