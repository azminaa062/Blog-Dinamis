<?php
include '../../helpers/auth.php';
check_admin();

$pageTitle = 'Tambah User';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="simpan.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="iconPassword"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');
const iconPassword = document.getElementById('iconPassword');

togglePassword.addEventListener('click', function () {
    const type = password.type === 'password' ? 'text' : 'password';
    password.type = type;
    iconPassword.classList.toggle('bi-eye');
    iconPassword.classList.toggle('bi-eye-slash');
});
</script>

<?php include '../../templates/admin_footer.php'; ?>