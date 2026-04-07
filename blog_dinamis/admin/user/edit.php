<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$pageTitle = 'Edit User';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="text" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" <?= $data['role']=='admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="author" <?= $data['role']=='author' ? 'selected' : ''; ?>>Author</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3"><?= htmlspecialchars($data['bio']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>