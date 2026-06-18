<?php
include '../helpers/auth.php';
include '../config/koneksi.php';
check_author();

$pageTitle = 'Dashboard Author';
$user_id = $_SESSION['user_id'];

$totalArtikel = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id'
"))['total'];

$totalPublish = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id' AND status='publish'
"))['total'];

$totalDraft = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM articles WHERE user_id='$user_id' AND status='draft'
"))['total'];

$totalKomentar = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(comments.id) as total
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
"))['total'];

$totalPending = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(comments.id) as total
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id' AND comments.status='pending'
"))['total'];

$totalViews = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COALESCE(SUM(views),0) as total FROM articles WHERE user_id='$user_id'
"))['total'];

$artikelSaya = mysqli_query($conn, "
    SELECT * FROM articles
    WHERE user_id='$user_id'
    ORDER BY id DESC
    LIMIT 5
");

$komentarSaya = mysqli_query($conn, "
    SELECT comments.*, articles.judul
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
    ORDER BY comments.id DESC
    LIMIT 5
");

include '../templates/author_header.php';
include '../templates/author_sidebar.php';
?>

<style>

/* ===== BASE ===== */
body{
    background:#1c1f24;
    color:#e6edf3;
}

/* ===== SIDEBAR ===== */
.sidebar{
    background:#0b0f14 !important;
    width:210px;
}

/* ===== MAIN ===== */
.main-content{
    padding:30px;
    position:relative;
}

/* ===== STAR BACKGROUND ===== */
#stars{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:0;
    pointer-events:none;
}

/* ===== CARD ===== */
.card{
    background:#0b0f14;
    border:1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.35);
    transition:0.25s ease;
    position:relative;
    z-index:1;
}

.card:hover{
    transform:translateY(-3px);
    box-shadow:0 6px 18px rgba(0,0,0,0.45);
}

.card h6{
    color:#8b949e;
    font-size:13px;
}

.card h3{
    color:#ffffff;
}

/* HEADER CARD */
.card-header{
    background:#0b0f14;
    border-bottom:1px solid rgba(255,255,255,0.04);
    color:#d1d5db;
}

/* ===== TABLE ===== */
.table{
    background:#0b0f14;
    color:#e6edf3;
}

.table th{
    padding:14px;
    color:#8b949e;
    border-bottom:1px solid rgba(255,255,255,0.08);
}

.table td{
    padding:14px;
    border-bottom:1px solid rgba(255,255,255,0.06);
}

.table tbody tr:hover{
    background:rgba(255,255,255,0.03);
}

/* ===== BADGE ===== */
.badge-premium{
    padding:5px 12px;
    border-radius:6px;
    font-size:11px;
}

.badge-publish{
    background:#23863633;
    color:#3fb950;
}

.badge-draft{
    background:#d2992233;
    color:#e3b341;
}

.badge-pending{
    background:#da363333;
    color:#ff7b72;
}

</style>

<div class="main-content">

<!-- STAR CANVAS -->
<canvas id="stars"></canvas>

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4" style="position:relative; z-index:1;">
    <div>
        <h4 class="mb-1 fw-semibold">Dashboard Author</h4>
        <small style="color:#8b949e;">Overview artikel & aktivitas kamu</small>
    </div>

    <div class="text-end">
    </div>
</div>

<!-- STATS -->
<div class="row g-4 mb-4">

<?php
$data = [
    ["Artikel Saya",  $totalArtikel],
    ["Publish",       $totalPublish],
    ["Draft",         $totalDraft],
    ["Komentar",      $totalKomentar],
    ["Pending",       $totalPending],
    ["Total Views",   $totalViews],
];

foreach($data as $d){
    echo '
<div class="col-lg-3 col-md-6">
<div class="card p-4">
<h6>'.$d[0].'</h6>
<h3>'.$d[1].'</h3>
</div>
</div>';
}
?>

</div>

<!-- TABLE -->
<div class="row">

<div class="col-md-6 mb-4">
<div class="card">
<div class="card-header">5 Artikel Terbaru Saya</div>
<div class="card-body">
<table class="table">
<thead>
<tr><th>Judul</th><th>Status</th><th>Views</th></tr>
</thead>
<tbody>
<?php while($row = mysqli_fetch_assoc($artikelSaya)) : ?>
<tr>
<td><?= htmlspecialchars($row['judul']); ?></td>
<td>
<span class="badge-premium <?= $row['status']=='publish' ? 'badge-publish' : 'badge-draft' ?>">
<?= $row['status']; ?>
</span>
</td>
<td><?= $row['views']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<div class="col-md-6 mb-4">
<div class="card">
<div class="card-header">5 Komentar Terbaru</div>
<div class="card-body">
<table class="table">
<thead>
<tr><th>Nama</th><th>Artikel</th><th>Status</th></tr>
</thead>
<tbody>
<?php while($row = mysqli_fetch_assoc($komentarSaya)) : ?>
<tr>
<td><?= htmlspecialchars($row['nama']); ?></td>
<td><?= htmlspecialchars($row['judul']); ?></td>
<td>
<span class="badge-premium badge-pending"><?= $row['status']; ?></span>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

</div>

</div>

<!-- STAR ANIMATION -->
<script>
const canvas = document.getElementById("stars");
const ctx = canvas.getContext("2d");

function resize(){
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
window.addEventListener("resize", resize);
resize();

let stars = [];
for(let i=0;i<200;i++){
    stars.push({
        x:Math.random()*canvas.width,
        y:Math.random()*canvas.height,
        r:Math.random()*1.2,
        s:Math.random()*0.3
    });
}

function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height);

    stars.forEach(s=>{
        ctx.beginPath();
        ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
        ctx.fillStyle="white";
        ctx.fill();

        s.y += s.s;
        if(s.y > canvas.height){
            s.y = 0;
            s.x = Math.random()*canvas.width;
        }
    });

    requestAnimationFrame(animate);
}
animate();
</script>

<?php include '../templates/author_footer.php'; ?>
