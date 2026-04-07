<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_author();

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM articles WHERE id='$id' AND user_id='$user_id'");
$data = mysqli_fetch_assoc($query);

$kategori = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2>Edit Artikel Saya</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-control" required>
                <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
                    <option value="<?= $k['id']; ?>" <?= $k['id']==$data['category_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($k['nama_kategori']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3"><?= htmlspecialchars($data['ringkasan']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="8" required><?= htmlspecialchars($data['isi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="draft" <?= $data['status']=='draft' ? 'selected' : ''; ?>>Draft</option>
                <option value="publish" <?= $data['status']=='publish' ? 'selected' : ''; ?>>Publish</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>