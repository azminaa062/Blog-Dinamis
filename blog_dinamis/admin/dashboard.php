<?php
include '../helpers/auth.php';
include '../config/koneksi.php';
check_admin();

$pageTitle = 'Dashboard Admin';

$totalArtikel  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM articles"))['total'];
$totalPublish  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM articles WHERE status='publish'"))['total'];
$totalDraft    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM articles WHERE status='draft'"))['total'];
$totalKategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM categories"))['total'];
$totalTag      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tags"))['total'];
$totalKomentar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM comments"))['total'];
$totalPending  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM comments WHERE status='pending'"))['total'];
$totalUser     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];

$artikelTerbaru = mysqli_query($conn, "
    SELECT articles.*, users.nama as author
    FROM articles
    JOIN users ON articles.user_id = users.id
    ORDER BY articles.id DESC
    LIMIT 5
");

$komentarTerbaru = mysqli_query($conn, "
    SELECT comments.*, articles.judul
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    ORDER BY comments.id DESC
    LIMIT 5
");

include '../templates/admin_header.php';
include '../templates/admin_sidebar.php';
include '../templates/admin_topbar.php';
?>

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Total Artikel</h6><h3><?= $totalArtikel; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Publish</h6><h3><?= $totalPublish; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Draft</h6><h3><?= $totalDraft; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Kategori</h6><h3><?= $totalKategori; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Tag</h6><h3><?= $totalTag; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Komentar</h6><h3><?= $totalKomentar; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>Pending</h6><h3><?= $totalPending; ?></h3></div></div>
    <div class="col-md-3"><div class="card shadow-sm p-3"><h6>User</h6><h3><?= $totalUser; ?></h3></div></div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">5 Artikel Terbaru</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Author</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($artikelTerbaru)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['author']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">5 Komentar Terbaru</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Artikel</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($komentarTerbaru)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/admin_footer.php'; ?>