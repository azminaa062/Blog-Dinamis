<?php
include 'config/koneksi.php';

$pageTitle = 'Beranda Blog';

$limit  = 5;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page   = ($page < 1) ? 1 : $page;
$offset = ($page - 1) * $limit;

$data = mysqli_query($conn, "
    SELECT articles.*, users.nama as author, categories.nama_kategori
    FROM articles
    JOIN users ON articles.user_id = users.id
    JOIN categories ON articles.category_id = categories.id
    WHERE articles.status='publish'
    ORDER BY articles.id DESC
    LIMIT $limit OFFSET $offset
");

$total = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE status='publish'
"))['total'];

$total_pages = ceil($total / $limit);

$populer = mysqli_query($conn, "
    SELECT * FROM articles
    WHERE status='publish'
    ORDER BY views DESC
    LIMIT 5
");

include 'templates/frontend_header.php';
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4">Artikel Terbaru</h1>

        <?php while($row = mysqli_fetch_assoc($data)) : ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <?php if (!empty($row['thumbnail'])) : ?>
                        <img src="assets/uploads/thumbnail/<?= htmlspecialchars($row['thumbnail']); ?>" class="img-fluid mb-3" style="max-height: 200px;">
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($row['judul']); ?></h3>
                    <p class="text-muted">
                        Oleh <?= htmlspecialchars($row['author']); ?> |
                        Kategori:
                        <a href="kategori.php?slug=<?= urlencode($row['nama_kategori'] ? strtolower(str_replace(' ', '-', $row['nama_kategori'])) : ''); ?>">
                            <?= htmlspecialchars($row['nama_kategori']); ?>
                        </a>
                    </p>

                    <p><?= nl2br(htmlspecialchars(substr($row['ringkasan'], 0, 150))); ?>...</p>

                    <a href="artikel.php?slug=<?= urlencode($row['slug']); ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
        <?php endwhile; ?>

        <nav>
            <ul class="pagination">
                <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <div class="col-md-4">
        <h5>Artikel Populer</h5>
        <ul class="list-group mb-4">
            <?php while($p = mysqli_fetch_assoc($populer)) : ?>
                <li class="list-group-item">
                    <a href="artikel.php?slug=<?= urlencode($p['slug']); ?>">
                        <?= htmlspecialchars($p['judul']); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<?php include 'templates/frontend_footer.php'; ?>