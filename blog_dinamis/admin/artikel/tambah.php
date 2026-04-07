<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$kategori = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body>
<div class="container py-4">
    <h2>Tambah Artikel</h2>
    <form action="simpan.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
                    <option value="<?= $k['id']; ?>"><?= htmlspecialchars($k['nama_kategori']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="isi" id="editor" class="form-control" rows="8" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" accept="image/*">
        </div>

        <?php
        $tags = mysqli_query($conn, "SELECT * FROM tags ORDER BY nama_tag ASC");
        ?>

        <div class="mb-3">
            <label class="form-label">Tag</label>
            <div>
                <?php while($t = mysqli_fetch_assoc($tags)) : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $t['id']; ?>">
                        <label class="form-check-label"><?= htmlspecialchars($t['nama_tag']); ?></label>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
CKEDITOR.replace('editor');
</script>
</body>
</html>