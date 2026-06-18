<?php  
include '../helpers/auth.php';
include '../config/koneksi.php';
check_admin();

$pageTitle = 'Statistik Blog';

/* ================= DATA ================= */
$views_data = mysqli_query($conn, "
    SELECT judul, views
    FROM articles
    WHERE status='publish'
    ORDER BY views DESC
    LIMIT 7
");

$kategori_data = mysqli_query($conn, "
    SELECT categories.nama_kategori, COUNT(articles.id) as total
    FROM categories
    LEFT JOIN articles ON categories.id = articles.category_id
    GROUP BY categories.id
    ORDER BY total DESC
");

$komentar_data = mysqli_query($conn, "
    SELECT DATE(created_at) as tanggal, COUNT(id) as total
    FROM comments
    GROUP BY DATE(created_at)
    ORDER BY tanggal ASC
    LIMIT 7
");

/* ================= PARSING ================= */
$views_labels=[]; $views_values=[];
while ($r=mysqli_fetch_assoc($views_data)){
    $views_labels[]=$r['judul'];
    $views_values[]=(int)$r['views'];
}

$kategori_labels=[]; $kategori_values=[];
while ($r=mysqli_fetch_assoc($kategori_data)){
    $kategori_labels[]=$r['nama_kategori'];
    $kategori_values[]=(int)$r['total'];
}

$komentar_labels=[]; $komentar_values=[];
while ($r=mysqli_fetch_assoc($komentar_data)){
    $komentar_labels[]=$r['tanggal'];
    $komentar_values[]=(int)$r['total'];
}

include '../templates/admin_header.php';
include '../templates/admin_sidebar.php';
?>

<style>
body { background:#1c1f24; color:#e6edf3; }
.sidebar{ background:#0b0f14 !important; width:210px; min-height:100vh; flex:0 0 210px; }
.main-content{ padding:30px; position:relative; }

#stars{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:0;
}

.main-content > *{
    position:relative;
    z-index:1;
}

.card{
    background:#0b0f14;
    border:1px solid rgba(255,255,255,0.08);
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,0.5);
}

.card-header{
    background:#0b0f14;
    border-bottom:1px solid rgba(255,255,255,0.05);
    color:#c9d1d9;
    font-weight:500;
}

.card-body{ padding:25px; }

.header-bar{
    display:flex;
    justify-content:space-between;
    margin-bottom:25px;
}

canvas{ max-height:320px; }
</style>

<div class="main-content">

<canvas id="stars"></canvas>

<div class="header-bar">
    <div>
        <h4 class="fw-semibold">Statistik Blog</h4>
        <small style="color:#8b949e;">Visualisasi data yang lebih jelas & profesional</small>
    </div>
    <div class="text-end">
    </div>
</div>

<div class="row">

<div class="col-md-12 mb-4">
<div class="card">
<div class="card-header">Artikel Terpopuler</div>
<div class="card-body">
<canvas id="chartViews"></canvas>
</div>
</div>
</div>

<div class="col-md-6 mb-4">
<div class="card">
<div class="card-header">Distribusi Kategori</div>
<div class="card-body">
<canvas id="chartKategori"></canvas>
</div>
</div>
</div>

<div class="col-md-6 mb-4">
<div class="card">
<div class="card-header">Komentar per Hari</div>
<div class="card-body">
<canvas id="chartKomentar"></canvas>
</div>
</div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
Chart.defaults.color = "#e6edf3";
Chart.defaults.font.size = 12;

/* ===== BAR CHART (Y AXIS ONLY MODIFIED) ===== */
new Chart(chartViews,{
    type:'bar',
    data:{
        labels:<?= json_encode($views_labels); ?>,
        datasets:[{
            label:'Views',
            data:<?= json_encode($views_values); ?>,
            backgroundColor:'#3fb950',
            borderRadius:6
        }]
    },
    options:{
        plugins:{ legend:{display:false} },
        scales:{
            x:{ ticks:{ color:'#c9d1d9' }, grid:{ display:false } },

            /* ===== ONLY THIS PART CHANGED ===== */
            y:{
                beginAtZero:true,
                ticks:{
                    color:'#c9d1d9',
                    stepSize: Math.ceil(Math.max(...<?= json_encode($views_values); ?>) / 5)
                },
                grid:{ color:'rgba(255,255,255,0.08)' }
            }
        }
    }
});

/* ===== PIE CHART ===== */
new Chart(chartKategori,{
    type:'doughnut',
    data:{
        labels:<?= json_encode($kategori_labels); ?>,
        datasets:[{
            data:<?= json_encode($kategori_values); ?>,
            backgroundColor:[
                '#ff6384',
                '#36a2eb',
                '#ffcd56',
                '#4bc0c0',
                '#9966ff',
                '#ff9f40'
            ],
            borderWidth:0
        }]
    },
    options:{
        cutout:'55%',
        plugins:{
            legend:{
                position:'top',
                labels:{ color:'#e6edf3' }
            }
        }
    }
});

/* ===== LINE CHART ===== */
new Chart(chartKomentar,{
    type:'line',
    data:{
        labels:<?= json_encode($komentar_labels); ?>,
        datasets:[{
            label:'Komentar',
            data:<?= json_encode($komentar_values); ?>,
            borderColor:'#58a6ff',
            backgroundColor:'rgba(88,166,255,0.2)',
            fill:true,
            tension:0.4
        }]
    },
    options:{
        plugins:{ legend:{display:false} },
        scales:{
            x:{ ticks:{ color:'#c9d1d9' } },
            y:{ ticks:{ color:'#c9d1d9' }, grid:{ color:'rgba(255,255,255,0.08)' } }
        }
    }
});
</script>

<script>
/* ===== STAR ANIMATION (TETAP) ===== */
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

<?php include '../templates/admin_footer.php'; ?>