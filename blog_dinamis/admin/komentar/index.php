<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Data Komentar';

$data = mysqli_query($conn, "
    SELECT comments.*, articles.judul, users.nama as author
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    JOIN users ON articles.user_id = users.id
    ORDER BY comments.id DESC
");

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Komentar</th>
                    <th>Artikel</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['isi_komentar']); ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['author']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'approved') : ?>
                            <span class="badge bg-success">Approved</span>
                        <?php elseif ($row['status'] == 'pending') : ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="approve.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="reject.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Reject</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus komentar?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>