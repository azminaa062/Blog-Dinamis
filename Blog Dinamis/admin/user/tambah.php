<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Tambah User';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
?>

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar { background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content { padding:30px; }
.header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.page-title h4 { margin:0; }
.card { background:#0b0f14; border:1px solid rgba(255,255,255,0.08); border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.35); max-width:620px; }
.card-body { padding:28px; }
.form-label { color:#8b949e; font-size:13px; font-weight:500; margin-bottom:6px; }
.form-control, .form-select { background:#1c1f24; border:1px solid rgba(255,255,255,0.12); color:#e6edf3; border-radius:8px; padding:10px 14px; }
.form-control:focus, .form-select:focus { background:#1c1f24; border-color:#58a6ff; color:#e6edf3; box-shadow:0 0 0 3px rgba(88,166,255,0.1); }
.form-control::placeholder { color:#484f58; }
.input-group .btn { border:1px solid rgba(255,255,255,0.12) !important; background:#1c1f24 !important; color:#8b949e !important; border-radius:0 8px 8px 0 !important; }
.input-group .btn:hover { background:#30363d !important; color:#e6edf3 !important; }
.input-group .form-control { border-radius:8px 0 0 8px !important; }
.btn-primary { background:#238636; border:none; border-radius:8px; padding:10px 24px; font-weight:500; }
.btn-primary:hover { background:#2ea043; }
.btn-secondary { background:#30363d; border:1px solid rgba(255,255,255,0.1); color:#e6edf3; border-radius:8px; padding:10px 24px; }
.btn-secondary:hover { background:#3d444d; color:#e6edf3; }
</style>

<div class="main-content">

<div class="header-bar">
    <div class="page-title">
        <h4 class="fw-semibold">Tambah User</h4>
        <small style="color:#8b949e;">Daftarkan pengguna baru</small>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="simpan.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap..." required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username unik..." required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password..." required>
                        <button class="btn" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="iconPassword"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="author">Author</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="3" placeholder="Bio singkat pengguna..."></textarea>
                </div>
                <div class="col-12 d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Simpan</button>
                    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </form>
    </div>
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
