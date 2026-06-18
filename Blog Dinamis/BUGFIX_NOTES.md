# Bug Fix Notes — Blog Dinamis

## Daftar Perbaikan

### 1. Keamanan — Missing Authentication Check
- `admin/artikel/simpan.php`: Tidak ada pengecekan sesi/login → Ditambahkan `check_admin()`
- `author/artikel/simpan.php` & `update.php`: Tidak ada pengecekan `check_author()` → Ditambahkan
- Semua file `hapus.php`, `approve.php`, `reject.php`: `session_start()` tanpa cek role → Diganti dengan `check_admin()`/`check_author()`

### 2. SQL Injection — Input Tidak Di-escape
- Semua variabel dari `$_POST` dan `$_GET` pada `simpan.php` dan `update.php` kini di-escape dengan `mysqli_real_escape_string()`
- ID dari GET/POST kini di-cast ke `(int)` untuk mencegah SQL injection

### 3. Double `session_start()`
- `admin/dashboard.php`: Memanggil `session_start()` secara langsung DAN include `auth.php` (yang sudah ada `session_start()`) → Dihapus yang duplikat

### 4. Logic Error — `check_admin()`/`check_author()` Pakai `die()`
- `helpers/auth.php`: Fungsi `check_admin()` dan `check_author()` sebelumnya menggunakan `die("Akses ditolak...")` yang menghasilkan halaman error kosong → Diganti dengan `header("Location: ...")` dan `exit`

### 5. HTML Structure — Div Tidak Tertutup
- `templates/admin_footer.php`: Kelebihan `</div>` yang tidak sesuai dengan struktur HTML → Diperbaiki menjadi satu `</div>` penutup `#wrapper`
- `templates/author_footer.php`: Kelebihan satu `</div>` → Diperbaiki

### 6. INNER JOIN — Artikel Tidak Muncul Jika Kategori NULL
- `admin/artikel/index.php`: `JOIN categories` → diubah ke `LEFT JOIN categories` agar artikel dengan `category_id = NULL` tetap tampil
- `author/artikel/index.php`: Sama seperti di atas

### 7. Missing Upload Directory
- `assets/uploads/thumbnail/`: Folder dibuat agar upload thumbnail tidak gagal

### 8. User Management
- `admin/user/simpan.php`: Ditambahkan pengecekan username duplikat dan validasi role
- `admin/user/hapus.php`: Ditambahkan guard agar admin tidak bisa hapus akunnya sendiri

### 9. Tag & Kategori — Cascade Delete
- `admin/artikel/hapus.php`: Kini menghapus juga `article_tags` dan `comments` yang berelasi
- `admin/tag/hapus.php`: Kini menghapus juga `article_tags` yang berelasi

