<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_author();

$pageTitle = 'Komentar Artikel Saya';
$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "
    SELECT comments.*, articles.judul
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
    ORDER BY comments.id DESC
");

include '../../templates/author_header.php';
include '../../templates/author_sidebar.php';
include '../../templates/author_topbar.php';
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
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['isi_komentar']); ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
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
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../templates/author_footer.php'; ?>