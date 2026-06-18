<?php 
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$pageTitle = 'Data User';

$data = mysqli_query($conn, "
    SELECT users.*, COUNT(articles.id) as jumlah_artikel
    FROM users
    LEFT JOIN articles ON users.id = articles.user_id
    GROUP BY users.id
    ORDER BY users.id DESC
");

include '../../templates/admin_header.php';
include '../../templates/admin_sidebar.php';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar { background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content { padding:30px; position:relative; }

/* ===== TAMBAHAN: STAR BACKGROUND ===== */
#stars{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:0;
    pointer-events:none;
}

/* pastikan semua konten di atas canvas */
.main-content > *{
    position:relative;
    z-index:1;
}
/* ===== END TAMBAHAN ===== */

.header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.page-title { flex:1; }
.page-title h4 { margin:0; }
.card { background:#0b0f14; border:1px solid rgba(255,255,255,0.08); border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.35); margin:0; width:100%; }
.card-body { padding:20px; }

.table-responsive { width:100%; margin:0; }
.table { width:100%; margin:0; background:#0b0f14; color:#e6edf3; border-collapse:collapse; }
.table thead th { color:#8b949e; font-size:12px; border-bottom:1px solid rgba(255,255,255,0.08); padding:12px; }
.table tbody td { padding:12px; border-bottom:1px solid rgba(255,255,255,0.06); vertical-align:middle; }
/* semua baris gelap */
.table tbody tr { background:#0b0f14; }
.table tbody tr:hover { background:rgba(255,255,255,0.05); }

.btn-primary { background:#238636; border:none; border-radius:8px; font-size:13px; }
.btn-primary:hover { background:#2ea043; }
.btn-warning { background:#d29922; border:none; color:#0b0f14; }
.btn-danger { background:#da3633; border:none; }

/* ===== DATATABLES OVERRIDE ===== */
.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    background-color:#1c1f24;
    color:#e6edf3;
    border:1px solid rgba(255,255,255,0.2);
    border-radius:4px;
    padding:4px 8px;
}
.dataTables_wrapper .dataTables_filter input:focus,
.dataTables_wrapper .dataTables_length select:focus { outline:none; border-color:#3fb950; }
.dataTables_wrapper .dataTables_paginate { display:flex; justify-content:flex-end; margin-top:10px; }
.dataTables_wrapper .dataTables_paginate .paginate_button,
.dataTables_wrapper .dataTables_paginate .paginate_button .page-link {
    background:#1c1f24 !important; color:#e6edf3 !important; border:none !important; margin:0; padding:6px 12px; border-radius:0 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current .page-link { background:#238636 !important; color:#fff !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button:hover .page-link { background:#2ea043 !important; color:#fff !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:first-child,
.dataTables_wrapper .dataTables_paginate .paginate_button:first-child .page-link { border-radius:6px 0 0 6px !important; }
.dataTables_wrapper .dataTables_paginate .paginate_button:last-child,
.dataTables_wrapper .dataTables_paginate .paginate_button:last-child .page-link { border-radius:0 6px 6px 0 !important; }
</style>

<div class="main-content">

    <!-- TAMBAHAN: CANVAS BINTANG -->
    <canvas id="stars"></canvas>

    <div class="header-bar">
        <div class="page-title">
            <h4 class="fw-semibold">Data User</h4>
            <small class="text-muted">Manajemen user blog</small>
        </div>
    </div>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah User</a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Jumlah Artikel</th>
                            <th>Bio</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['role']); ?></td>
                            <td><?= $row['jumlah_artikel']; ?></td>
                            <td><?= htmlspecialchars($row['bio']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus user?')">Hapus</a>
                            </td>
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
    $('#userTable').DataTable({
        "pageLength": 10,
        "lengthChange": true,
        "ordering": true,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Next",
                "previous": "Prev"
            }
        }
    });
});

/* ===== ANIMASI RASI BINTANG (SAMA PERSIS DASHBOARD) ===== */
const canvas = document.getElementById("stars");
const ctx = canvas.getContext("2d");

function resize(){
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
window.addEventListener("resize", resize);
resize();

let stars = [];
for(let i=0;i<100;i++){
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

<?php include '../../templates/admin_footer.php'; ?>