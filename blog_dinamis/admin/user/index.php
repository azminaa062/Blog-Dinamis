<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Data User';

$data = mysqli_query($conn, "
    SELECT users.*, COUNT(articles.id) as jumlah_artikel
    FROM users
    LEFT JOIN articles ON users.id = articles.user_id
    GROUP BY users.id
    ORDER BY users.id DESC
");

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <a href="tambah.php" class="btn btn-primary btn-sm mb-3">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>

        <table class="table table-bordered datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Jumlah Artikel</th>
                    <th>Bio</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['role']); ?></td>
                    <td><?= $row['jumlah_artikel']; ?></td>
                    <td><?= htmlspecialchars($row['bio']); ?></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>