<?php
include '../helpers/auth.php';
include '../config/koneksi.php';
check_author();

$pageTitle = 'Dashboard Author';
$user_id = $_SESSION['user_id'];

$totalArtikel = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id'
"))['total'];

$totalPublish = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id' AND status='publish'
"))['total'];

$totalDraft = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id' AND status='draft'
"))['total'];

$totalKomentar = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(comments.id) as total
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
"))['total'];

$totalPending = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(comments.id) as total
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id' AND comments.status='pending'
"))['total'];

$totalViews = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COALESCE(SUM(views),0) as total FROM articles WHERE user_id='$user_id'
"))['total'];

$artikelSaya = mysqli_query($conn, "
    SELECT * FROM articles
    WHERE user_id='$user_id'
    ORDER BY id DESC
    LIMIT 5
");

$komentarSaya = mysqli_query($conn, "
    SELECT comments.*, articles.judul
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
    ORDER BY comments.id DESC
    LIMIT 5
");

include '../templates/author_header.php';
include '../templates/author_sidebar.php';
include '../templates/author_topbar.php';
?>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Artikel Saya</h6><h3><?= $totalArtikel; ?></h3></div></div>
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Publish</h6><h3><?= $totalPublish; ?></h3></div></div>
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Draft</h6><h3><?= $totalDraft; ?></h3></div></div>
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Komentar</h6><h3><?= $totalKomentar; ?></h3></div></div>
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Pending</h6><h3><?= $totalPending; ?></h3></div></div>
    <div class="col-md-4"><div class="card shadow-sm p-3"><h6>Total Views</h6><h3><?= $totalViews; ?></h3></div></div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">5 Artikel Terbaru Saya</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($artikelSaya)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td><?= $row['views']; ?></td>
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
                        <?php while($row = mysqli_fetch_assoc($komentarSaya)) : ?>
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

<?php include '../templates/author_footer.php'; ?>