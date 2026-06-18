<?php
if (!isset($conn)) {
    include __DIR__ . '/../config/koneksi.php';
}
$footer_cats = mysqli_query($conn, "SELECT * FROM categories ORDER BY nama_kategori ASC");
?>

<footer class="bd-footer">
    <div class="bd-footer-inner">

        <div class="bd-footer-col bd-footer-brand-col">
            <div class="bd-footer-logo">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="28" height="28" rx="6" fill="#1a8917"/>
                    <path d="M7 9h14M7 14h10M7 19h12" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span class="bd-footer-brand">Blog Dinamis</span>
            </div>
            <p class="bd-footer-desc">Platform blog personal yang menyajikan konten berkualitas seputar teknologi, lifestyle, kuliner, traveling, dan UMKM.</p>
        </div>

        <div class="bd-footer-col">
            <h6>Topik</h6>
            <ul>
                <?php if ($footer_cats): while ($fc = mysqli_fetch_assoc($footer_cats)): ?>
                <li><a href="/blog_dinamis/kategori.php?slug=<?= urlencode($fc['slug']); ?>"><?= htmlspecialchars($fc['nama_kategori']); ?></a></li>
                <?php endwhile; endif; ?>
            </ul>
        </div>

        <div class="bd-footer-col">
            <h6>Navigasi</h6>
            <ul>
                <li><a href="/blog_dinamis/index.php">Beranda</a></li>
                <li><a href="/blog_dinamis/search.php">Pencarian</a></li>
            </ul>
        </div>

    </div>

    <div class="bd-footer-bottom">
        <span>&copy; <?= date('Y'); ?> Blog Dinamis. Seluruh hak cipta dilindungi.</span>
        <span class="bd-footer-tagline">Berbagi cerita, meluaskan wawasan</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const bdSidebar  = document.getElementById('bdSidebar');
const bdBackdrop = document.getElementById('bdBackdrop');
function bdToggleSidebar() {
    bdSidebar.classList.contains('open') ? bdCloseSidebar() : bdOpenSidebar();
}
function bdOpenSidebar()  { bdSidebar.classList.add('open');    bdBackdrop.classList.add('show'); }
function bdCloseSidebar() { bdSidebar.classList.remove('open'); bdBackdrop.classList.remove('show'); }
</script>
</body>
</html>
