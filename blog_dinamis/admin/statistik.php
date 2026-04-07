<?php
include '../helpers/auth.php';
include '../config/koneksi.php';
check_admin();

$pageTitle = 'Statistik Blog';

$views_data = mysqli_query($conn, "
    SELECT judul, views
    FROM articles
    WHERE status='publish'
    ORDER BY views DESC
    LIMIT 7
");

$kategori_data = mysqli_query($conn, "
    SELECT categories.nama_kategori, COUNT(articles.id) as total
    FROM categories
    LEFT JOIN articles ON categories.id = articles.category_id
    GROUP BY categories.id
    ORDER BY total DESC
");

$komentar_data = mysqli_query($conn, "
    SELECT DATE(created_at) as tanggal, COUNT(id) as total
    FROM comments
    GROUP BY DATE(created_at)
    ORDER BY tanggal ASC
    LIMIT 7
");

$views_labels = [];
$views_values = [];
while ($row = mysqli_fetch_assoc($views_data)) {
    $views_labels[] = $row['judul'];
    $views_values[] = (int)$row['views'];
}

$kategori_labels = [];
$kategori_values = [];
while ($row = mysqli_fetch_assoc($kategori_data)) {
    $kategori_labels[] = $row['nama_kategori'];
    $kategori_values[] = (int)$row['total'];
}

$komentar_labels = [];
$komentar_values = [];
while ($row = mysqli_fetch_assoc($komentar_data)) {
    $komentar_labels[] = $row['tanggal'];
    $komentar_values[] = (int)$row['total'];
}

include '../templates/admin_header.php';
include '../templates/admin_sidebar.php';
include '../templates/admin_topbar.php';
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">Artikel Terpopuler</div>
            <div class="card-body">
                <canvas id="chartViews"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">Jumlah Artikel per Kategori</div>
            <div class="card-body">
                <canvas id="chartKategori"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">Komentar per Hari</div>
            <div class="card-body">
                <canvas id="chartKomentar"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chartViews'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($views_labels); ?>,
        datasets: [{
            label: 'Views',
            data: <?= json_encode($views_values); ?>
        }]
    }
});

new Chart(document.getElementById('chartKategori'), {
    type: 'pie',
    data: {
        labels: <?= json_encode($kategori_labels); ?>,
        datasets: [{
            label: 'Jumlah Artikel',
            data: <?= json_encode($kategori_values); ?>
        }]
    }
});

new Chart(document.getElementById('chartKomentar'), {
    type: 'line',
    data: {
        labels: <?= json_encode($komentar_labels); ?>,
        datasets: [{
            label: 'Komentar',
            data: <?= json_encode($komentar_values); ?>
        }]
    }
});
</script>

<?php include '../templates/admin_footer.php'; ?>