<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_author();

$pageTitle = 'Artikel Saya';
$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "
    SELECT articles.*, categories.nama_kategori
    FROM articles
    JOIN categories ON articles.category_id = categories.id
    WHERE articles.user_id='$user_id'
    ORDER BY articles.id DESC
");

include '../../templates/author_header.php';
include '../../templates/author_sidebar.php';
include '../../templates/author_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <a href="tambah.php" class="btn btn-primary btn-sm mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Artikel
        </a>

        <table class="table table-bordered datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td><?= htmlspecialchars($row['views']); ?></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus artikel?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../templates/author_footer.php'; ?>