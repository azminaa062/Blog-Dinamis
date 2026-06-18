<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tags WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$pageTitle = 'Edit Tag';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
?>

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar { background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content { padding:30px; }
.header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.page-title h4 { margin:0; }
.card { background:#0b0f14; border:1px solid rgba(255,255,255,0.08); border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.35); max-width:560px; }
.card-body { padding:28px; }
.form-label { color:#8b949e; font-size:13px; font-weight:500; margin-bottom:6px; }
.form-control { background:#1c1f24; border:1px solid rgba(255,255,255,0.12); color:#e6edf3; border-radius:8px; padding:10px 14px; }
.form-control:focus { background:#1c1f24; border-color:#58a6ff; color:#e6edf3; box-shadow:0 0 0 3px rgba(88,166,255,0.1); }
.btn-primary { background:#238636; border:none; border-radius:8px; padding:10px 24px; font-weight:500; }
.btn-primary:hover { background:#2ea043; }
.btn-secondary { background:#30363d; border:1px solid rgba(255,255,255,0.1); color:#e6edf3; border-radius:8px; padding:10px 24px; }
.btn-secondary:hover { background:#3d444d; color:#e6edf3; }
</style>

<div class="main-content">

<div class="header-bar">
    <div class="page-title">
        <h4 class="fw-semibold">Edit Tag</h4>
        <small style="color:#8b949e;">Ubah data tag</small>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="mb-4">
                <label class="form-label">Nama Tag</label>
                <input type="text" name="nama_tag" class="form-control" value="<?= htmlspecialchars($data['nama_tag']); ?>" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Update</button>
                <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>

</div>

<?php include '../../templates/admin_footer.php'; ?>
