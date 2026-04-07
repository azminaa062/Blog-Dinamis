<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tags WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$pageTitle = 'Edit Tag';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Nama Tag</label>
                <input type="text" name="nama_tag" class="form-control" value="<?= htmlspecialchars($data['nama_tag']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>