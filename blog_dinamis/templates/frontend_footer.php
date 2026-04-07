</div>

<!-- Footer -->
<footer class="bg-dark text-light mt-5 pt-4 pb-3">
  <div class="container">
    <div class="row">
      <!-- Deskripsi Blog -->
      <div class="col-md-4">
        <h5>Blog Dinamis</h5>
        <p>
          Platform blog personal yang menyajikan konten berkualitas seputar teknologi, lifestyle, kuliner, traveling, dan UMKM.
        </p>
      </div>

      <!-- Navigasi -->
      <div class="col-md-4">
        <h5>Navigasi</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="text-light">Beranda</a></li>
          <li><a href="kategori.php?slug=teknologi-digital" class="text-light">Teknologi & Digital</a></li>
          <li><a href="kategori.php?slug=lifestyle" class="text-light">Lifestyle</a></li>
          <li><a href="kategori.php?slug=traveling-adventure" class="text-light">Traveling Adventure</a></li>
          <li><a href="kategori.php?slug=foodies-kuliner" class="text-light">Foodies Kuliner</a></li>
          <li><a href="kategori.php?slug=umkm-entrepreneur" class="text-light">UMKM Entrepreneur</a></li>
        </ul>
      </div>

      <!-- Admin -->
      <div class="col-md-4">
        <h5>Admin</h5>
        <ul class="list-unstyled">
          <li><a href="login.php" class="text-light">Login Admin</a></li>
          <li><a href="admin/dashboard.php" class="text-light">Dashboard</a></li>
        </ul>
      </div>
    </div>

    <hr class="border-light">
    <div class="text-center">
      <small>&copy; <?= date('Y'); ?> Blog Dinamis dibuat dengan menggunakan PHP & MySQL.</small>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
