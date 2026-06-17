# Projek Website Blog Dinamis

## 1. Deskripsi
Project ini adalah aplikasi blog dinamis berbasis web yang dibuat menggunakan PHP Native dan MySQL. Sistem ini digunakan untuk mengelola artikel, kategori, tag, dan komentar, dengan dua tingkat hak akses pengguna, yaitu admin dan author, serta tampilan publik untuk pengunjung yang ingin membaca konten.

## 2. Fitur

### Admin
- **Login admin dengan captcha**, halaman login dilengkapi kode captcha gambar acak untuk mencegah percobaan login otomatis (bot).
- **Dashboard admin**, menampilkan ringkasan statistik berupa total artikel, jumlah artikel publish dan draft, total kategori, total tag, total komentar, jumlah komentar yang masih pending, total user, beserta daftar artikel dan komentar terbaru.
- **Halaman statistik blog**, menyajikan visualisasi data dalam bentuk grafik, meliputi artikel dengan jumlah views terbanyak, jumlah artikel per kategori, dan tren jumlah komentar harian.
- **Mengelola semua artikel (CRUD)**, admin dapat menambah, mengedit, dan menghapus artikel milik siapa pun (tidak terbatas pada artikel buatan sendiri), termasuk mengatur status artikel sebagai draft atau publish.
- **Mengelola kategori (CRUD)**, admin dapat menambah, mengedit, dan menghapus kategori artikel yang digunakan untuk mengelompokkan konten.
- **Mengelola tag (CRUD)**, admin dapat menambah, mengedit, dan menghapus tag yang digunakan untuk memberi label topik pada artikel.
- **Moderasi komentar**, admin dapat melihat seluruh komentar dari pengunjung, lalu menyetujui (approve), menolak (reject), atau menghapus komentar tersebut sebelum tampil ke publik.
- **Mengelola data user**, admin dapat menambah, mengedit, dan menghapus akun pengguna (admin maupun author).

### Author
- **Login author dengan captcha**, menggunakan halaman login yang sama dengan admin namun diarahkan ke dashboard sesuai role.
- **Dashboard author**, menampilkan ringkasan statistik khusus milik author yang sedang login, seperti jumlah artikel sendiri (publish/draft) dan jumlah komentar pada artikelnya, termasuk yang masih pending.
- **Menambahkan artikel**, author dapat menulis artikel baru lengkap dengan judul, ringkasan, isi konten, kategori, tag, thumbnail, dan status (draft/publish).
- **Mengedit artikel milik sendiri**, author hanya dapat mengubah artikel yang ia buat sendiri, tidak bisa mengedit artikel milik author lain.
- **Menghapus artikel milik sendiri**, author hanya dapat menghapus artikelnya sendiri.
- **Melihat komentar pada artikel sendiri**, author dapat memantau komentar yang masuk khusus pada artikel-artikel yang ia tulis.

### User / Pengunjung
- **Melihat daftar artikel**, menampilkan seluruh artikel yang sudah berstatus publish di halaman utama.
- **Membaca detail artikel**, setiap artikel memiliki halaman detail yang menampilkan isi lengkap, thumbnail, kategori, tag, nama penulis, jumlah views (otomatis bertambah saat dibuka), serta kolom komentar.
- **Mencari artikel**, pengunjung dapat mencari artikel berdasarkan kata kunci pada judul atau isi melalui kolom pencarian.
- **Filter artikel berdasarkan kategori dan tag**, pengunjung dapat menjelajahi artikel yang dikelompokkan per kategori atau per tag tertentu.
- **Memberikan komentar pada artikel**, pengunjung dapat mengisi nama, email, dan isi komentar pada artikel yang dibaca, namun komentar baru akan tampil setelah disetujui (approve) oleh admin.

## 3. Teknologi yang Digunakan
- PHP Native
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- Bootstrap

## 4. Struktur Project

```
blog_dinamis/
│
├── admin/
│   ├── artikel/
│   │   ├── edit.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   ├── simpan.php
│   │   ├── tambah.php
│   │   └── update.php
│   ├── kategori/
│   │   ├── edit.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   ├── simpan.php
│   │   ├── tambah.php
│   │   └── update.php
│   ├── komentar/
│   │   ├── approve.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   └── reject.php
│   ├── tag/
│   │   ├── edit.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   ├── simpan.php
│   │   ├── tambah.php
│   │   └── update.php
│   ├── user/
│   │   ├── edit.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   ├── simpan.php
│   │   ├── tambah.php
│   │   └── update.php
│   ├── dashboard.php
│   └── statistik.php
│
├── author/
│   ├── artikel/
│   │   ├── edit.php
│   │   ├── hapus.php
│   │   ├── index.php
│   │   ├── simpan.php
│   │   ├── tambah.php
│   │   └── update.php
│   ├── komentar/
│   │   └── index.php
│   └── dashboard.php
│
├── auth/
│   ├── captcha.php
│   ├── login.php
│   ├── logout.php
│   └── proses_login.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── uploads/
│
├── config/
│   └── koneksi.php
│
├── database/
│   └── blog_dinamis.sql
│
├── helpers/
│   ├── auth.php
│   ├── function.php
│   └── thumbnail_map.php
│
├── templates/
│   ├── admin_header.php
│   ├── admin_sidebar.php
│   ├── admin_topbar.php
│   ├── admin_footer.php
│   ├── author_header.php
│   ├── author_sidebar.php
│   ├── author_topbar.php
│   ├── author_footer.php
│   ├── frontend_header.php
│   └── frontend_footer.php
│
├── index.php
├── artikel.php
├── kategori.php
├── tag.php
├── komentar.php
└── search.php
```

## 5. Cara Install
1. Clone repository:
   `git clone https://github.com/azminaa062/Blog-Dinamis.git`
2. Pindahkan folder project ke:
   `htdocs/`
3. Buat database di phpMyAdmin:
   `blog_dinamis`
4. Import file SQL dari folder `database`.
5. Jalankan project melalui browser:
   `http://localhost/blog_dinamis`

## 6. Tujuan Project
- Pembelajaran PHP Native
- Memahami konsep CRUD
- Implementasi relasi database
- Implementasi sistem role/hak akses (admin dan author)
- Implementasi moderasi konten (approval komentar)
- Pembuatan website dinamis
- Tugas kuliah dan latihan project web

## 7. Author
- Nama: Faija Kulla Azmina
- Github: https://github.com/azminaa062/Blog-Dinamis.git

## 8. Lisensi
Project ini bersifat open source dan dapat digunakan, dipelajari, serta dikembangkan kembali untuk kebutuhan pembelajaran, tugas kuliah, maupun pengembangan project pribadi.

## 9. Kesimpulan
Aplikasi Blog Dinamis berbasis web ini dibuat untuk mempermudah proses pengelolaan artikel dan publikasi konten secara online. Dengan menggunakan PHP Native dan MySQL, sistem mampu menjalankan fitur manajemen artikel, kategori, tag, komentar, statistik blog, serta hak akses admin dan author dengan baik. Project ini juga dapat menjadi sarana pembelajaran dalam memahami konsep CRUD, autentikasi, moderasi konten, dan pengembangan website dinamis.
