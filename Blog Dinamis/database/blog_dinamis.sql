-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 03:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_dinamis`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `ringkasan` text DEFAULT NULL,
  `isi` longtext DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `status` enum('draft','publish') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `category_id`, `judul`, `slug`, `ringkasan`, `isi`, `thumbnail`, `views`, `status`, `published_at`, `created_at`) VALUES
(9, 1, NULL, 'Belajar PHP Dasar', 'belajar-php-dasar', 'Panduan dasar belajar PHP untuk pemula', 'Isi lengkap belajar PHP dasar...', NULL, 4, 'publish', '2026-04-07 03:47:10', '2026-04-06 20:47:10'),
(15, 1, 7, 'AI dan Masa Depan UMKM: Bagaimana Teknologi Membantu Membangun Bisnis Kecil', 'ai-dan-masa-depan-umkm-bagaimana-teknologi-membantu-membangun-bisnis-kecil', 'UMKM adalah tulang punggung ekonomi Indonesia, namun sering terkendala modal, pemasaran, dan efisiensi. AI hadir sebagai solusi untuk otomatisasi, analisis data, dan pemasaran digital yang lebih cerdas.', '<h1><strong>AI dan Masa Depan UMKM: Bagaimana Kecerdasan Buatan Membantu Bisnis Kecil</strong></h1>\r\n\r\n<p>UMKM di Indonesia memegang peranan penting dalam perekonomian nasional. Mereka menyumbang lebih dari separuh Produk Domestik Bruto dan menjadi penyerap tenaga kerja terbesar. Namun, di tengah perkembangan teknologi yang begitu pesat, UMKM sering kali tertinggal karena keterbatasan modal, akses informasi, dan kemampuan mengelola bisnis secara efisien. Kehadiran kecerdasan buatan atau Artificial Intelligence (AI) membuka peluang besar bagi UMKM untuk bertransformasi dan bersaing di era digital.</p>\r\n\r\n<p>AI dapat membantu UMKM dalam berbagai aspek operasional. Misalnya, penggunaan chatbot untuk melayani pelanggan secara otomatis selama 24 jam penuh, sehingga pemilik usaha tidak perlu selalu standby menjawab pertanyaan. Sistem kasir digital yang terintegrasi dengan AI juga mampu mencatat transaksi sekaligus memprediksi kebutuhan stok barang. Dengan begitu, UMKM bisa mengurangi risiko kehabisan barang atau justru menumpuk stok yang tidak laku.</p>\r\n\r\n<p>Selain itu, AI sangat bermanfaat dalam analisis data. UMKM yang sebelumnya hanya mengandalkan intuisi kini bisa membaca pola penjualan, memahami produk yang paling diminati, dan memprediksi tren musiman. Dengan insight ini, pelaku usaha dapat mengambil keputusan lebih tepat, misalnya menambah produksi menjelang musim tertentu atau meluncurkan produk baru sesuai kebutuhan pasar.</p>\r\n\r\n<p>Di bidang pemasaran, AI membantu UMKM menargetkan iklan secara lebih efektif. Algoritma cerdas mampu mengenali perilaku konsumen dan menampilkan promosi kepada orang yang paling berpotensi membeli. Hal ini membuat biaya iklan lebih efisien dan hasilnya lebih maksimal. Bahkan, toko online kecil bisa memanfaatkan AI untuk memberikan rekomendasi produk personalisasi kepada pelanggan, sehingga pengalaman belanja terasa lebih eksklusif.</p>\r\n\r\n<p>Tentu saja, penerapan AI bukan tanpa tantangan. Biaya implementasi bisa menjadi kendala, namun solusi cloud AI yang lebih murah kini tersedia. Kurangnya pengetahuan juga bisa diatasi dengan pelatihan digital literacy bagi pelaku UMKM. Sementara itu, isu keamanan data harus dijawab dengan sistem proteksi privasi yang memadai.</p>\r\n\r\n<p>Masa depan UMKM akan semakin cerah jika berani beradaptasi dengan teknologi. AI bukan lagi milik perusahaan besar, melainkan alat yang bisa diakses oleh siapa saja. Dengan memanfaatkannya, UMKM dapat meningkatkan daya saing, memperluas pasar, dan bertahan menghadapi perubahan zaman.</p>', NULL, 1, 'publish', '2026-04-07 01:23:00', '2026-04-06 23:23:00'),
(16, 1, 6, 'Fashion Trends 2026: Gaya Hidup Modern yang Elegan', 'fashion-trends-2026-gaya-hidup-modern-yang-elegan', 'Tahun 2026 tren fashion berfokus pada keberlanjutan dan kenyamanan. Sustainable fashion dengan bahan ramah lingkungan semakin populer, gaya minimalis kembali digemari, dan inovasi fashion tech mulai masuk pasar. Fashion bukan sekadar penampilan, tetapi juga nilai dan fungsi yang mendukung gaya hidup modern.', '<p>Dunia fashion selalu bergerak dinamis, mengikuti perkembangan zaman dan kebutuhan masyarakat. Tahun 2026 menghadirkan tren yang lebih berfokus pada keberlanjutan, kenyamanan, dan ekspresi diri. Konsumen kini tidak hanya mencari pakaian yang indah, tetapi juga yang ramah lingkungan dan mencerminkan identitas personal.</p>\r\n\r\n<p>Salah satu tren besar adalah <strong>sustainable fashion</strong>. Brand besar maupun lokal mulai menggunakan bahan daur ulang, serat organik, dan proses produksi yang minim limbah. Hal ini sejalan dengan meningkatnya kesadaran masyarakat terhadap isu lingkungan. Pakaian berbahan ramah lingkungan kini tidak lagi dianggap eksklusif, melainkan menjadi bagian dari gaya hidup sehari‑hari.</p>\r\n\r\n<p>Selain itu, <strong>minimalist style</strong> kembali populer. Orang lebih memilih pakaian dengan desain sederhana, warna netral, dan potongan klasik yang bisa dipadupadankan untuk berbagai kesempatan. Tren ini muncul sebagai respons terhadap gaya hidup modern yang menuntut efisiensi dan kesederhanaan.</p>\r\n\r\n<p>Di sisi lain, <strong>fashion tech</strong> juga berkembang pesat. Pakaian dengan teknologi wearable, seperti jaket yang bisa mengatur suhu tubuh atau sepatu dengan sensor kesehatan, mulai masuk ke pasar. Hal ini menunjukkan bahwa fashion bukan hanya soal estetika, tetapi juga fungsi dan inovasi.</p>\r\n\r\n<p>Tren fashion 2026 menekankan bahwa gaya bukan sekadar penampilan, melainkan juga nilai yang kita bawa. Dengan memilih fashion yang berkelanjutan, nyaman, dan inovatif, kita ikut berkontribusi pada masa depan yang lebih baik.</p>', NULL, 0, 'publish', '2026-04-07 01:30:10', '2026-04-06 23:30:10'),
(17, 1, 6, 'Self Improvement: Membangun Diri di Era Digital', 'self-improvement-membangun-diri-di-era-digital', 'Self improvement kini menekankan literasi digital, kesehatan mental, dan soft skills seperti komunikasi dan empati. Prinsip lifelong learning menjadi kunci agar tetap relevan di dunia yang cepat berubah. Pengembangan diri bukan hanya soal kerja keras, tapi juga menjaga keseimbangan hidup.', '<h1><strong>Self Improvement: Membangun Diri di Era Digital</strong></h1>\r\n\r\n<p>Perkembangan teknologi dan informasi membuat dunia bergerak cepat. Di tengah arus perubahan ini, self improvement atau pengembangan diri menjadi kebutuhan penting agar seseorang tetap relevan dan produktif. Tahun 2026, fokus self improvement tidak hanya pada keterampilan teknis, tetapi juga keseimbangan mental, emosional, dan sosial.</p>\r\n\r\n<p>Salah satu aspek utama adalah <strong>digital literacy</strong>. Kemampuan memahami teknologi, menggunakan aplikasi produktivitas, dan mengelola informasi digital menjadi keterampilan dasar yang wajib dimiliki. Tanpa literasi digital, seseorang akan kesulitan bersaing di dunia kerja maupun bisnis.</p>\r\n\r\n<p>Selain itu, <strong>mental health awareness</strong> semakin mendapat perhatian. Banyak orang mulai menyadari pentingnya menjaga kesehatan mental melalui mindfulness, meditasi, dan olahraga rutin. Self improvement bukan hanya tentang bekerja lebih keras, tetapi juga tentang menjaga keseimbangan hidup agar tetap sehat dan bahagia.</p>\r\n\r\n<p><strong>Soft skills</strong> seperti komunikasi, kepemimpinan, dan empati juga menjadi fokus. Di era kolaborasi global, kemampuan berinteraksi dengan berbagai latar belakang budaya sangat penting. Self improvement berarti belajar mendengarkan, memahami, dan bekerja sama dengan orang lain.</p>\r\n\r\n<p>Terakhir, <strong>lifelong learning</strong> menjadi prinsip utama. Dunia berubah cepat, sehingga belajar tidak bisa berhenti di bangku sekolah. Kursus online, webinar, dan komunitas belajar menjadi sarana untuk terus menambah pengetahuan. Dengan komitmen belajar sepanjang hayat, seseorang bisa terus berkembang dan beradaptasi dengan perubahan.</p>\r\n\r\n<p>Self improvement di era digital adalah perjalanan panjang. Dengan fokus pada literasi digital, kesehatan mental, soft skills, dan pembelajaran berkelanjutan, kita bisa membangun diri yang lebih kuat dan siap menghadapi masa depan.</p>\r\n\r\n<h1>&nbsp;</h1>', NULL, 0, 'publish', '2026-04-07 01:32:28', '2026-04-06 23:32:28'),
(18, 1, 6, 'Financial Tips: Strategi Keuangan Pribadi di Tahun 2026', 'financial-tips-strategi-keuangan-pribadi-di-tahun-2026', 'Strategi keuangan pribadi di 2026 menekankan budgeting, saving & emergency fund, serta investasi cerdas dengan diversifikasi. Penting juga meningkatkan literasi finansial agar terhindar dari utang konsumtif, serta merencanakan dana pensiun sejak dini. Dengan disiplin, stabilitas finansial bisa tercapai.', '<h1><strong>Financial Tips: Strategi Keuangan Pribadi di Tahun 2026</strong></h1>\r\n\r\n<p>Mengelola keuangan pribadi adalah keterampilan penting yang menentukan kualitas hidup seseorang. Tahun 2026, dengan kondisi ekonomi global yang fluktuatif, memiliki strategi keuangan yang tepat menjadi semakin krusial.</p>\r\n\r\n<p>Langkah pertama adalah <strong>budgeting</strong>. Membuat anggaran bulanan yang jelas membantu mengontrol pengeluaran dan memastikan kebutuhan utama terpenuhi. Dengan aplikasi keuangan digital, proses budgeting kini lebih mudah dan transparan.</p>\r\n\r\n<p>Kedua, <strong>saving &amp; emergency fund</strong>. Menyisihkan sebagian pendapatan untuk tabungan dan dana darurat adalah hal wajib. Dana darurat idealnya mencakup biaya hidup 3&ndash;6 bulan, sehingga kita siap menghadapi situasi tak terduga seperti kehilangan pekerjaan atau kebutuhan medis mendesak.</p>\r\n\r\n<p>Ketiga, <strong>investasi cerdas</strong>. Tahun 2026, investasi tidak hanya terbatas pada saham dan properti, tetapi juga aset digital seperti cryptocurrency dan NFT. Namun, penting untuk memahami risiko dan memilih instrumen sesuai profil keuangan. Diversifikasi tetap menjadi kunci agar portofolio lebih aman.</p>\r\n\r\n<p>Selain itu, <strong>financial literacy</strong> harus terus ditingkatkan. Banyak orang terjebak utang konsumtif karena kurang memahami cara kerja bunga dan cicilan. Dengan pengetahuan keuangan yang baik, kita bisa menghindari jebakan utang dan membuat keputusan finansial yang lebih bijak.</p>\r\n\r\n<p>Terakhir, <strong>pensiun dan masa depan</strong>. Merencanakan dana pensiun sejak dini adalah langkah strategis. Dengan menabung di instrumen pensiun atau investasi jangka panjang, kita bisa memastikan kehidupan yang nyaman di masa tua.</p>\r\n\r\n<p>Financial tips di tahun 2026 menekankan pentingnya disiplin, literasi, dan strategi jangka panjang. Dengan budgeting, saving, investasi, dan perencanaan pensiun, kita bisa mencapai stabilitas finansial dan kebebasan ekonomi.</p>', NULL, 0, 'publish', '2026-04-07 01:34:38', '2026-04-06 23:34:38'),
(19, 7, 4, 'Backpacking: Seni Menjelajah dengan Budget Terbatas', 'backpacking-seni-menjelajah-dengan-budget-terbatas', 'Backpacking adalah gaya hidup menjelajah dengan budget terbatas, mengutamakan kebebasan, pengalaman otentik, dan interaksi budaya lokal.', 'Backpacking: Seni Menjelajah dengan Budget Terbatas\r\nBackpacking bukan sekadar cara berwisata murah, melainkan sebuah gaya hidup yang menekankan kebebasan, pengalaman otentik, dan interaksi langsung dengan budaya lokal. Tahun 2026, tren backpacking semakin digemari generasi muda yang ingin menjelajah dunia tanpa harus menguras tabungan.\r\n\r\nBackpacker biasanya hanya membawa tas ransel dengan perlengkapan esensial, menginap di hostel atau homestay, dan menggunakan transportasi umum. Hal ini membuat perjalanan terasa lebih fleksibel dan penuh kejutan. Selain hemat biaya, backpacking juga membuka peluang bertemu sesama traveler dari berbagai negara, sehingga memperluas jaringan pertemanan global.\r\n\r\nNamun, backpacking juga menuntut perencanaan matang. Riset destinasi, budgeting, dan pemilihan perlengkapan yang tepat menjadi kunci agar perjalanan tetap nyaman. Dengan persiapan yang baik, backpacking bisa menjadi pengalaman berharga yang membentuk karakter, melatih kemandirian, dan memperkaya wawasan budaya.', NULL, 1, 'publish', '2026-04-07 01:41:25', '2026-04-06 23:41:25'),
(20, 7, 4, 'Hidden Gems Indonesia: Destinasi Tersembunyi yang Wajib Dikunjungi', 'hidden-gems-indonesia-destinasi-tersembunyi-yang-wajib-dikunjungi', 'Selain destinasi populer, Indonesia punya hidden gems seperti Pantai Ora, Wae Rebo, dan Danau Labuan Cermin yang menawarkan keindahan alami dan budaya autentik.', 'Indonesia dikenal dengan Bali, Yogyakarta, dan Lombok, tetapi di luar destinasi populer itu terdapat banyak hidden gems yang belum banyak dijamah wisatawan. Hidden gems menawarkan keindahan alam yang masih alami, budaya lokal yang autentik, dan pengalaman unik yang jarang ditemukan di tempat wisata mainstream.\r\n\r\nContohnya, Pantai Ora di Maluku dengan air laut sebening kaca, Desa Wae Rebo di Flores dengan rumah adat berbentuk kerucut, dan Danau Labuan Cermin di Kalimantan Timur yang memiliki dua lapisan air berbeda. Tempat-tempat ini memberikan sensasi petualangan sekaligus ketenangan, jauh dari keramaian turis.\r\n\r\nMengunjungi hidden gems juga berarti mendukung pariwisata lokal. Traveler bisa berkontribusi langsung pada ekonomi masyarakat setempat, sekaligus menjaga kelestarian budaya dan lingkungan. Dengan sikap bertanggung jawab, hidden gems Indonesia bisa tetap lestari dan menjadi kebanggaan generasi mendatang.', NULL, 0, 'publish', '2026-04-07 01:43:46', '2026-04-06 23:43:46'),
(21, 7, 4, 'Travel Tips: Panduan Perjalanan Aman dan Nyaman', 'travel-tips-panduan-perjalanan-aman-dan-nyaman', 'Perjalanan aman dan nyaman butuh itinerary fleksibel, packing cerdas, menjaga keamanan, hemat biaya, dan menghargai budaya setempat.', 'Travel Tips: Panduan Perjalanan Aman dan Nyaman\r\nPerjalanan yang menyenangkan tidak hanya bergantung pada destinasi, tetapi juga pada persiapan dan strategi traveler. Travel tips menjadi bekal penting agar perjalanan berjalan lancar, aman, dan penuh kenangan indah.\r\n\r\nPertama, buat itinerary fleksibel. Rencana perjalanan yang terlalu kaku bisa membuat stres, sementara itinerary fleksibel memberi ruang untuk spontanitas. Kedua, packing cerdas dengan membawa barang esensial saja, menggunakan pakaian multifungsi, dan memanfaatkan teknologi seperti aplikasi travel organizer.\r\n\r\nKetiga, jaga keamanan pribadi. Simpan dokumen penting di tempat aman, gunakan dompet anti‑theft, dan selalu waspada di keramaian. Keempat, hemat biaya dengan memanfaatkan promo tiket, menginap di akomodasi budget, dan mencoba kuliner lokal.\r\n\r\nTerakhir, hargai budaya setempat. Belajar sedikit bahasa lokal, menghormati adat, dan menjaga kebersihan lingkungan adalah bentuk tanggung jawab traveler. Dengan tips ini, perjalanan akan lebih bermakna dan meninggalkan kesan positif.', NULL, 0, 'publish', '2026-04-07 01:45:29', '2026-04-06 23:45:29'),
(22, 7, 5, 'Resep Nusantara: Warisan Rasa dari Sabang sampai Merauke', 'resep-nusantara-warisan-rasa-dari-sabang-sampai-merauke', 'Rendang, Gudeg, dan Rawon adalah ikon kuliner tradisional yang menjadi warisan budaya Indonesia.', 'Resep Nusantara: Warisan Rasa dari Sabang sampai Merauke\r\nIndonesia adalah negeri dengan ribuan pulau, budaya, dan tradisi. Setiap daerah memiliki resep khas yang menjadi identitas kuliner sekaligus simbol kebanggaan. Resep Nusantara bukan sekadar makanan, melainkan warisan turun‑temurun yang menyimpan filosofi hidup, nilai sosial, dan sejarah panjang bangsa.\r\n\r\nAmbil contoh Rendang dari Minangkabau. Hidangan ini dimasak berjam‑jam dengan santan dan rempah hingga menghasilkan rasa gurih pedas yang mendalam. Filosofinya adalah kesabaran dan ketekunan, karena proses panjang itu mencerminkan perjuangan hidup. Di Yogyakarta, ada Gudeg yang manis legit, dimasak dari nangka muda dengan gula jawa dan santan. Gudeg bukan hanya makanan, tetapi juga simbol kelembutan budaya Jawa. Sementara di Jawa Timur, Rawon dengan kuah hitam dari kluwek menghadirkan cita rasa unik yang tidak ditemukan di tempat lain.\r\n\r\nSelain tiga ikon tersebut, Nusantara masih menyimpan ribuan resep lain: Papeda dari Papua dengan kuah ikan kuning, Ayam Betutu dari Bali yang kaya rempah, hingga Coto Makassar yang gurih berlemak. Setiap hidangan lahir dari kearifan lokal, menggunakan bahan yang tersedia di alam sekitar, dan disajikan dalam konteks sosial tertentu.\r\n\r\nResep Nusantara juga berperan sebagai perekat sosial. Hidangan disajikan dalam acara keluarga, perayaan adat, hingga ritual keagamaan. Makan bersama bukan sekadar aktivitas fisik, tetapi juga simbol kebersamaan. Di era modern, resep Nusantara semakin populer karena diangkat ke panggung internasional. Rendang, misalnya, pernah dinobatkan sebagai makanan terenak di dunia. Hal ini membuktikan bahwa kuliner Indonesia memiliki daya tarik global.', NULL, 0, 'publish', '2026-04-07 01:49:22', '2026-04-06 23:49:22'),
(23, 7, 5, 'Street Food: Sensasi Kuliner Jalanan Indonesia', 'street-food-sensasi-kuliner-jalanan-indonesia', 'Sate Taichan, Seblak, dan Tahu Tek mencerminkan kreativitas kuliner jalanan yang otentik, murah, dan populer.', 'Street Food: Sensasi Kuliner Jalanan Indonesia\r\nKuliner jalanan atau street food adalah denyut nadi kehidupan kota. Dari pagi hingga malam, pedagang kaki lima menyajikan makanan otentik dengan harga terjangkau. Street food bukan hanya soal rasa, tetapi juga pengalaman sosial: duduk di pinggir jalan, bercengkerama dengan teman, sambil menikmati suasana kota.\r\n\r\nDi Jakarta, Sate Taichan menjadi fenomena. Sate ayam tanpa bumbu kacang, hanya dibakar polos lalu disajikan dengan sambal pedas segar. Rasanya sederhana tapi menggoda, dan kini menjadi tren nasional. Di Bandung, ada Seblak, makanan berbahan kerupuk basah yang dimasak dengan bumbu pedas gurih. Seblak lahir dari kreativitas masyarakat yang memanfaatkan bahan sederhana menjadi hidangan populer. Di Surabaya, Tahu Tek dengan bumbu petis khas selalu jadi favorit, disajikan dengan lontong, kentang, dan telur.\r\n\r\nStreet food juga mencerminkan kreativitas masyarakat. Dengan bahan sederhana, lahirlah inovasi kuliner unik. Misalnya, martabak manis dengan topping modern seperti keju, cokelat, hingga matcha. Atau es kopi susu kekinian yang kini menjamur di berbagai kota. Street food Indonesia bahkan mulai dikenal dunia, dengan festival kuliner yang memperkenalkan sate, bakso, dan nasi goreng ke mancanegara.\r\n\r\nStreet food adalah bukti bahwa kuliner bukan hanya milik restoran mewah, tetapi juga lahir dari jalanan, dari tangan masyarakat biasa, dan menjadi bagian dari identitas bangsa.', NULL, 0, 'publish', '2026-04-07 01:50:19', '2026-04-06 23:50:19'),
(24, 7, 7, 'Web Development: Fondasi Dunia Digital Modern', 'web-development-fondasi-dunia-digital-modern', 'Web development 2026 menekankan responsivitas, keamanan, dan pengalaman pengguna premium dengan dukungan cloud dan PWA.', 'Web Development: Fondasi Dunia Digital Modern\r\nWeb development adalah tulang punggung dunia digital. Hampir semua aktivitas online, mulai dari e‑commerce, media sosial, hingga portal berita, bergantung pada website yang dibangun dengan teknologi web. Tahun 2026, web development berkembang pesat dengan tren baru yang menekankan responsivitas, keamanan, dan pengalaman pengguna premium.\r\n\r\nFramework modern seperti React, Vue, dan Angular masih menjadi pilihan utama, sementara teknologi backend seperti Node.js, Django, dan Laravel terus berinovasi. Developer kini dituntut tidak hanya membangun website yang berfungsi, tetapi juga yang SEO‑friendly, scalable, dan memiliki UI elegan.\r\n\r\nSelain itu, konsep progressive web apps (PWA) semakin populer. PWA memungkinkan website berfungsi layaknya aplikasi mobile, dengan fitur offline, notifikasi push, dan performa cepat. Hal ini menjembatani kebutuhan pengguna yang ingin pengalaman seamless tanpa harus mengunduh aplikasi.\r\n\r\nWeb development juga semakin erat dengan cloud computing. Website modern tidak lagi bergantung pada server fisik, melainkan memanfaatkan layanan cloud seperti AWS, Azure, atau Google Cloud. Dengan ini, skala bisnis bisa diperbesar dengan mudah sesuai kebutuhan.', NULL, 0, 'publish', '2026-04-07 01:51:52', '2026-04-06 23:51:52'),
(25, 7, 3, 'Digital Marketing untuk UMKM: Strategi Menembus Pasar Modern', 'digital-marketing-untuk-umkm-strategi-menembus-pasar-modern', 'UMKM perlu memanfaatkan media sosial, SEO, dan iklan online untuk memperluas pasar dengan biaya efisien.', 'Digital Marketing untuk UMKM: Strategi Menembus Pasar Modern\r\nUMKM di era digital tidak bisa lagi hanya mengandalkan promosi tradisional. Digital marketing menjadi senjata utama untuk memperluas jangkauan pasar dengan biaya yang relatif terjangkau. Melalui media sosial, website, dan marketplace, UMKM dapat menjangkau konsumen yang sebelumnya sulit dicapai.\r\n\r\nStrategi digital marketing yang efektif dimulai dari membangun identitas online. Website sederhana dengan tampilan profesional, akun media sosial aktif, dan konten yang konsisten akan meningkatkan kepercayaan konsumen. Selanjutnya, SEO (Search Engine Optimization) membantu produk UMKM muncul di hasil pencarian Google, sehingga lebih mudah ditemukan.\r\n\r\nSelain itu, iklan berbayar di platform seperti Facebook Ads atau Google Ads memungkinkan UMKM menargetkan audiens spesifik berdasarkan usia, lokasi, dan minat. Dengan analisis data, UMKM bisa mengetahui kampanye mana yang paling efektif. Digital marketing juga membuka peluang kolaborasi dengan influencer lokal, yang dapat meningkatkan brand awareness secara signifikan.\r\n\r\nDigital marketing bukan sekadar tren, melainkan kebutuhan. UMKM yang mampu memanfaatkannya akan lebih siap bersaing di pasar modern.', NULL, 0, 'publish', '2026-04-07 01:54:02', '2026-04-06 23:54:02'),
(26, 7, 3, 'Branding UMKM: Membangun Identitas yang Kuat', 'branding-umkm-membangun-identitas-yang-kuat', 'Logo, desain visual, dan cerita brand yang konsisten membangun identitas kuat dan loyalitas konsumen.', 'Branding UMKM: Membangun Identitas yang Kuat\r\nBranding adalah kunci agar UMKM tidak hanya dikenal sebagai penjual produk, tetapi juga sebagai pembawa nilai dan cerita. Branding yang kuat membuat konsumen merasa terhubung secara emosional dengan produk.\r\n\r\nLangkah pertama adalah menciptakan logo dan desain visual yang konsisten. Logo sederhana namun bermakna akan menjadi identitas yang mudah diingat. Warna, tipografi, dan gaya visual harus mencerminkan karakter bisnis.\r\n\r\nSelain visual, cerita brand juga penting. UMKM bisa mengangkat kisah tentang asal‑usul produk, nilai lokal, atau perjuangan pemilik usaha. Cerita ini akan membuat konsumen merasa lebih dekat dan loyal.\r\n\r\nBranding juga harus konsisten di semua platform: website, media sosial, kemasan produk, hingga layanan pelanggan. Konsistensi ini membangun kepercayaan dan memperkuat citra positif.\r\n\r\nDengan branding yang kuat, UMKM tidak hanya menjual produk, tetapi juga membangun hubungan jangka panjang dengan konsumen.', NULL, 0, 'publish', '2026-04-07 01:55:08', '2026-04-06 23:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE `article_tags` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_tags`
--

INSERT INTO `article_tags` (`id`, `article_id`, `tag_id`) VALUES
(10, 15, 18),
(11, 15, 2),
(12, 16, 17),
(13, 17, 2),
(14, 18, 20);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `slug`, `created_at`) VALUES
(2, 'Hobi Menarik', 'hobi-menarik', '2026-04-06 20:21:21'),
(3, 'UMKM enterpreneur', 'umkm-enterpreneur', '2026-04-06 20:21:21'),
(4, 'Traveling Adventure', 'traveling-adventure', '2026-04-06 20:21:21'),
(5, 'Foodies Kuliner', 'foodies-kuliner', '2026-04-06 20:21:21'),
(6, 'Lifestyle & Personal Development', 'lifestyle-personal-development', '2026-04-06 20:29:32'),
(7, 'Teknologi & Digital', 'teknologi-digital', '2026-04-06 20:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `isi_komentar` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `nama`, `email`, `isi_komentar`, `status`, `created_at`) VALUES
(8, 15, 'Farah Diyanti', 'farahnti@gmail.com', 'Sebuah pemikiran yang cemerlang!', 'approved', '2026-04-06 23:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nama_tag` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `nama_tag`, `slug`, `created_at`) VALUES
(1, 'Fotografi', 'fotografi', '2026-04-06 20:22:38'),
(2, 'Success Stories', 'success-stories', '2026-04-06 20:22:38'),
(3, 'Digital Marketing', 'digital-marketing', '2026-04-06 20:22:38'),
(4, 'Travel Tips', 'travel-tips', '2026-04-06 20:22:38'),
(5, 'Backpacking', 'backpacking', '2026-04-06 20:22:38'),
(6, 'Street Food', 'street-food', '2026-04-06 20:22:38'),
(17, 'Fashion Trends', 'fashion-trends', '2026-04-06 21:05:05'),
(18, 'AI Machine Learning', 'ai-machine-learning', '2026-04-06 21:05:09'),
(19, 'Web Development', 'web-development', '2026-04-06 21:09:58'),
(20, 'Financial Tips', 'financial-tips', '2026-04-06 23:04:04'),
(21, 'DIY Project', 'diy-project', '2026-04-06 23:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','author') DEFAULT 'author',
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `bio`, `created_at`) VALUES
(1, 'Khalisa Liardi', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'sebagai admin', '2026-04-06 20:07:44'),
(6, 'Rafina', 'cipay', '0192023a7bbd73250516f069df18b500', 'admin', 'adminn', '2026-04-06 20:36:20'),
(7, 'Faija', 'author', 'e22591bbe1941fcc4b78972d4c60281f', 'author', 'autooor', '2026-04-06 21:17:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `article_tags`
--
ALTER TABLE `article_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
