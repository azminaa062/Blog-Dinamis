<?php
include 'config/koneksi.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$pageTitle = 'Hasil Pencarian';

$data = mysqli_query($conn, "
    SELECT articles.*, users.nama as author, categories.nama_kategori
    FROM articles
    JOIN users ON articles.user_id = users.id
    JOIN categories ON articles.category_id = categories.id
    WHERE articles.status='publish'
    AND (articles.judul LIKE '%$q%' OR articles.isi LIKE '%$q%' OR articles.ringkasan LIKE '%$q%')
    ORDER BY articles.id DESC
");

include 'templates/frontend_header.php';
?>

<h2>Hasil pencarian: <?= htmlspecialchars($q); ?></h2>

<?php if (mysqli_num_rows($data) > 0) : ?>
    <?php while($row = mysqli_fetch_assoc($data)) : ?>
        <div class="card mb-3">
            <div class="card-body">
                <?php if (!empty($row['thumbnail'])) : ?>
                    <img src="assets/uploads/thumbnail/<?= htmlspecialchars($row['thumbnail']); ?>" class="img-fluid mb-3" style="max-height: 200px;">
                <?php endif; ?>

                <h4><?= htmlspecialchars($row['judul']); ?></h4>
                <p class="text-muted">
                    Oleh <?= htmlspecialchars($row['author']); ?> |
                    Kategori: <?= htmlspecialchars($row['nama_kategori']); ?>
                </p>
                <p><?= htmlspecialchars($row['ringkasan']); ?></p>
                <a href="artikel.php?slug=<?= urlencode($row['slug']); ?>" class="btn btn-primary btn-sm">Baca</a>
            </div>
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <div class="alert alert-warning">Artikel tidak ditemukan.</div>
<?php endif; ?>

<?php include 'templates/frontend_footer.php'; ?>