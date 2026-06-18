<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_author();

$pageTitle = 'Komentar Artikel Saya';
$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "
    SELECT comments.*, articles.judul
    FROM comments
    JOIN articles ON comments.article_id = articles.id
    WHERE articles.user_id='$user_id'
    ORDER BY comments.id DESC
");

include '../../templates/author_header.php';
include '../../templates/author_sidebar.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar { background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content { padding:30px; position:relative; }

.header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.page-title h4 { margin:0; }
.card { background:#0b0f14; border:1px solid rgba(255,255,255,0.08); border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.35); position:relative; z-index:1; }
.card-body { padding:20px; }

.table { background:#0b0f14; color:#e6edf3; margin-bottom:0; }
.table thead th { color:#8b949e; font-size:12px; border-bottom:1px solid rgba(255,255,255,0.08); padding:12px; }
.table tbody td { padding:12px; border-bottom:1px solid rgba(255,255,255,0.06); vertical-align:middle; }
.table tbody tr { background:#0b0f14; }
.table tbody tr:hover { background:rgba(255,255,255,0.05); }

.badge-status { padding:5px 10px; border-radius:6px; font-size:11px; }
.approved { background:#23863633; color:#3fb950; }
.pending  { background:#d2992233; color:#e3b341; }
.rejected { background:#da363333; color:#ff7b72; }

#stars { position:absolute; top:0; left:0; width:100%; height:100%; z-index:0; pointer-events:none; }

/* DATATABLES OVERRIDE */
.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    background-color:#1c1f24; color:#e6edf3;
    border:1px solid rgba(255,255,255,0.2);
    border-radius:4px; padding:4px 8px;
}
.dataTables_wrapper .dataTables_filter input:focus,
.dataTables_wrapper .dataTables_length select:focus { outline:none; border-color:#3fb950; }
.dataTables_wrapper .dataTables_paginate { display:flex; justify-content:flex-end; margin-top:10px; }
.dataTables_wrapper .dataTables_paginate .paginate_button,
.dataTables_wrapper .dataTables_paginate .paginate_button .page-link {
    background:#1c1f24 !important; color:#e6edf3 !important; border:none !important;
    margin:0; padding:6px 12px; border-radius:0 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current .page-link { background:#238636 !important; color:#fff !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button:hover .page-link { background:#2ea043 !important; color:#fff !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:first-child,
.dataTables_wrapper .dataTables_paginate .paginate_button:first-child .page-link { border-radius:6px 0 0 6px !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:last-child,
.dataTables_wrapper .dataTables_paginate .paginate_button:last-child .page-link { border-radius:0 6px 6px 0 !important; }
.dataTables_wrapper .dataTables_info { color:#8b949e; font-size:12px; margin-top:10px; }
.dataTables_wrapper label { color:#8b949e; }
</style>

<div class="main-content">

<canvas id="stars"></canvas>

<div class="header-bar">
    <div class="page-title">
        <h4 class="fw-semibold">Komentar Artikel Saya</h4>
        <small style="color:#8b949e;">Daftar komentar pada artikel kamu</small>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="komentarTable" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Komentar</th>
                        <th>Artikel</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['isi_komentar']); ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td>
                            <span class="badge-status <?= $row['status']=='approved' ? 'approved' : ($row['status']=='pending' ? 'pending' : 'rejected') ?>">
                                <?= ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#komentarTable').DataTable({
        "pageLength": 10,
        "lengthChange": true,
        "ordering": true,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": { "first":"Awal","last":"Akhir","next":"Next","previous":"Prev" }
        }
    });
});

const canvas = document.getElementById("stars");
const ctx = canvas.getContext("2d");
function resize(){ canvas.width=canvas.offsetWidth; canvas.height=canvas.offsetHeight; }
window.addEventListener("resize", resize);
resize();
let stars=[];
for(let i=0;i<200;i++){
    stars.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,r:Math.random()*1.2,s:Math.random()*0.3});
}
function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    stars.forEach(s=>{
        ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
        ctx.fillStyle="white"; ctx.fill();
        s.y+=s.s;
        if(s.y>canvas.height){ s.y=0; s.x=Math.random()*canvas.width; }
    });
    requestAnimationFrame(animate);
}
animate();
</script>

<?php include '../../templates/author_footer.php'; ?>
