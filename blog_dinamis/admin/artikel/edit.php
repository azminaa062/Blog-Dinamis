<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM articles WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$kategori = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
$tags = mysqli_query($conn, "SELECT * FROM tags ORDER BY nama_tag ASC");

$selected_tags = [];
$tag_query = mysqli_query($conn, "SELECT tag_id FROM article_tags WHERE article_id='$id'");
while ($row = mysqli_fetch_assoc($tag_query)) {
    $selected_tags[] = $row['tag_id'];
}

$pageTitle = 'Edit Artikel';

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
include '../../templates/admin_topbar.php';
?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
                        <option value="<?= $k['id']; ?>" <?= ($k['id'] == $data['category_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($k['nama_kategori']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tag</label>
                <div>
                    <?php while($t = mysqli_fetch_assoc($tags)) : ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $t['id']; ?>"
                            <?= in_array($t['id'], $selected_tags) ? 'checked' : ''; ?>>
                            <label class="form-check-label"><?= htmlspecialchars($t['nama_tag']); ?></label>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Thumbnail Baru</label>
                <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">
                <?php if (!empty($data['thumbnail'])) : ?>
                    <div class="mt-2">
                        <img src="../../assets/uploads/thumbnail/<?= htmlspecialchars($data['thumbnail']); ?>" style="max-height:100px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Ringkasan</label>
                <textarea name="ringkasan" class="form-control" rows="3"><?= htmlspecialchars($data['ringkasan']); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea name="isi" id="editor" class="form-control" rows="8" required><?= htmlspecialchars($data['isi']); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" <?= ($data['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                    <option value="publish" <?= ($data['status'] == 'publish') ? 'selected' : ''; ?>>Publish</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor');
</script>

<?php include '../../templates/admin_footer.php'; ?>