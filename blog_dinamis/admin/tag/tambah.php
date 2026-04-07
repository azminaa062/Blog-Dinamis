<?php
include '../../helpers/auth.php';
check_admin();

$pageTitle = 'Tambah Tag';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="simpan.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Tag</label>
                <input type="text" name="nama_tag" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include '../../templates/admin_footer.php'; ?>