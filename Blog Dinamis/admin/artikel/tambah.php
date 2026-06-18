<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Tambah Artikel';
$kategori = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
$tags = mysqli_query($conn, "SELECT * FROM tags ORDER BY nama_tag ASC");

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar { background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content { padding:30px; }

.header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.page-title h4 { margin:0; }

.card { background:#0b0f14; border:1px solid rgba(255,255,255,0.08); border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.35); }
.card-body { padding:28px; }

.form-label { color:#8b949e; font-size:13px; font-weight:500; margin-bottom:6px; }
.form-control, .form-select {
    background:#1c1f24;
    border:1px solid rgba(255,255,255,0.12);
    color:#e6edf3;
    border-radius:8px;
    padding:10px 14px;
}
.form-control:focus, .form-select:focus {
    background:#1c1f24;
    border-color:#58a6ff;
    color:#e6edf3;
    box-shadow:0 0 0 3px rgba(88,166,255,0.1);
}
.form-control::placeholder { color:#484f58; }

.form-check-input { background-color:#1c1f24; border-color:rgba(255,255,255,0.2); }
.form-check-input:checked { background-color:#238636; border-color:#238636; }
.form-check-label { color:#c9d1d9; font-size:13px; }

.btn-primary { background:#238636; border:none; border-radius:8px; padding:10px 24px; font-weight:500; }
.btn-primary:hover { background:#2ea043; }
.btn-secondary { background:#30363d; border:1px solid rgba(255,255,255,0.1); color:#e6edf3; border-radius:8px; padding:10px 24px; }
.btn-secondary:hover { background:#3d444d; color:#e6edf3; }

/* CKEditor dark wrapper */
.cke { border:1px solid rgba(255,255,255,0.12) !important; border-radius:8px !important; overflow:hidden; }
.cke_top { background:#1c1f24 !important; border-bottom:1px solid rgba(255,255,255,0.08) !important; }
.cke_bottom { background:#1c1f24 !important; border-top:1px solid rgba(255,255,255,0.08) !important; }

.section-divider { border-top:1px solid rgba(255,255,255,0.06); margin:20px 0; }
</style>

<div class="main-content">

<div class="header-bar">
    <div class="page-title">
        <h4 class="fw-semibold">Tambah Artikel</h4>
        <small style="color:#8b949e;">Buat artikel baru</small>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="simpan.php" method="POST" enctype="multipart/form-data">

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul artikel..." required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
                            <option value="<?= $k['id']; ?>"><?= htmlspecialchars($k['nama_kategori']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="3" placeholder="Ringkasan singkat artikel..."></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Isi Artikel</label>
                    <textarea name="isi" id="editor" class="form-control" rows="10" required></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    <small style="color:#484f58; font-size:11px;">Format: JPG, PNG, GIF, WEBP</small>
                </div>

                <div class="col-12">
                    <div class="section-divider"></div>
                    <label class="form-label">Tag</label>
                    <div class="d-flex flex-wrap gap-2">
                        <?php while($t = mysqli_fetch_assoc($tags)) : ?>
                            <div class="form-check" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:6px; padding:8px 14px; margin:0;">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $t['id']; ?>" id="tag<?= $t['id']; ?>">
                                <label class="form-check-label" for="tag<?= $t['id']; ?>"><?= htmlspecialchars($t['nama_tag']); ?></label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="col-12 d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Simpan Artikel</button>
                    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>

        </form>
    </div>
</div>

</div>

<script>
CKEDITOR.replace('editor', {
    toolbar: [
        { name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','RemoveFormat'] },
        { name: 'paragraph', items: ['NumberedList','BulletedList','Blockquote'] },
        { name: 'links', items: ['Link','Unlink'] },
        { name: 'insert', items: ['Image','Table','HorizontalRule'] },
        { name: 'styles', items: ['Format'] },
        { name: 'tools', items: ['Source'] }
    ]
});
</script>

<?php include '../../templates/admin_footer.php'; ?>
