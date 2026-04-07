<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Data Tag';

$data = mysqli_query($conn, "
    SELECT tags.*, COUNT(article_tags.tag_id) as jumlah_artikel
    FROM tags
    LEFT JOIN article_tags ON tags.id = article_tags.tag_id
    GROUP BY tags.id
    ORDER BY tags.id DESC
");

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <a href="tambah.php" class="btn btn-primary btn-sm mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Tag
        </a>

        <table class="table table-bordered datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tag</th>
                    <th>Slug</th>
                    <th>Jumlah Artikel</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_tag']); ?></td>
                    <td><?= htmlspecialchars($row['slug']); ?></td>
                    <td><?= $row['jumlah_artikel']; ?></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus tag?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>