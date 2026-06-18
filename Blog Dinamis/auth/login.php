<?php
session_start();
include '../config/koneksi.php';

// GENERATE CAPTCHA
function generateCaptcha() {
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
    return substr(str_shuffle($chars), 0, 4);
}

// REFRESH CAPTCHA
if(isset($_GET['refresh'])){
    $_SESSION['captcha'] = generateCaptcha();
    echo $_SESSION['captcha'];
    exit;
}

// FIRST LOAD
if(!isset($_SESSION['captcha'])){
    $_SESSION['captcha'] = generateCaptcha();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Blog Dinamis</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    height: 100vh;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
    background: radial-gradient(circle at bottom, #0d0d0d, #000000);
}

/* PARTICLES */
#particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 0;
}

/* LOGIN BOX */
.login-box {
    position: relative;
    z-index: 1;
    width: 380px;
    padding: 35px;
    border-radius: 16px;
    background: #2b2b2b;
    border: 1px solid #3a3a3a;
    box-shadow: 0 0 60px rgba(255,255,255,0.05);
    color: #fff;
}

/* INPUT */
.form-control {
    background: #1e1e1e;
    border: 1px solid #444;
    color: #fff;
    border-radius: 8px;
}

.form-control:focus {
    background: #1e1e1e;
    border-color: #888;
    box-shadow: none;
}

/* PASSWORD ICON */
.input-group-text {
    background: #1e1e1e;
    border: 1px solid #444;
    color: #aaa;
    cursor: pointer;
}

/* BUTTON */
.btn-login {
    background: linear-gradient(135deg, #5f6368, #9aa0a6);
    border: none;
    border-radius: 8px;
    color: white;
    transition: 0.3s;
}

.btn-login:hover {
    background: linear-gradient(135deg, #7a7f85, #c0c4c8);
}

/* CAPTCHA */
canvas {
    width: 100px;
    height: 35px;
    background: #2a2a2a;
    border-radius: 6px;
    border: 1px solid #444;
}

/* REFRESH BOX */
.refresh-box {
    width: 40px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #1e1e1e;
    border: 1px solid #444;
    border-radius: 6px;
    cursor: pointer;
    color: #aaa;
}

.refresh-box:hover {
    background: #2a2a2a;
    color: #fff;
}

/* CAPTCHA INPUT */
input[name="captcha"] {
    color: #fff !important;
}

/* SUCCESS OVERLAY */
#successOverlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.85);
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 20px;
    animation: fadeInOverlay 0.4s ease;
}

#successOverlay.show {
    display: flex;
}

@keyframes fadeInOverlay {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.success-card {
    background: #1e1e1e;
    border: 1px solid #555;
    border-radius: 20px;
    padding: 40px 50px;
    text-align: center;
    color: #fff;
    box-shadow: 0 0 40px rgba(180, 180, 180, 0.1);
    animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes popIn {
    from { transform: scale(0.5); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}

.success-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, #555, #888);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 36px;
    animation: bounceIcon 0.6s 0.3s ease both;
}

@keyframes bounceIcon {
    0%   { transform: scale(0); }
    60%  { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.success-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #ccc;
    margin-bottom: 6px;
}

.success-subtitle {
    font-size: 0.85rem;
    color: #aaa;
}

.success-bar {
    width: 220px;
    height: 4px;
    background: #333;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 24px;
}

.success-bar-fill {
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #555, #999);
    border-radius: 4px;
    animation: fillBar 2s linear forwards;
}

@keyframes fillBar {
    from { width: 0%; }
    to   { width: 100%; }
}
</style>
</head>

<body>

<!-- SUCCESS OVERLAY -->
<div id="successOverlay">
    <div class="success-card">
        <div class="success-icon">✓</div>
        <div class="success-title">Login Berhasil!</div>
        <div class="success-subtitle" id="successMsg">Selamat datang, <span id="welcomeName"></span></div>
        <div class="success-bar">
            <div class="success-bar-fill" id="successBarFill"></div>
        </div>
    </div>
</div>

<div id="particles-js"></div>

<div class="d-flex justify-content-center align-items-center vh-100">

<div class="login-box">

    <h5 class="text-center mb-4">
        <i class="bi bi-shield-lock"></i> Login Blog Dinamis
    </h5>

    <form id="loginForm">

        <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

        <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <span class="input-group-text" onclick="togglePassword()">
                <i class="bi bi-eye" id="icon"></i>
            </span>
        </div>

        <!-- CAPTCHA -->
        <div class="mb-3 text-center">

            <div class="d-flex justify-content-center align-items-center gap-2">
                <canvas id="captchaCanvas"></canvas>

                <div class="refresh-box" onclick="refreshCaptcha()">
                    <i class="bi bi-arrow-clockwise"></i>
                </div>
            </div>

            <input type="text" name="captcha" class="form-control mt-2" placeholder="Masukkan captcha" required>

        </div>

        <button type="submit" class="btn btn-login w-100">
            Login
        </button>

        <div id="msg" class="mt-3"></div>

    </form>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

<script>
// PARTICLES
particlesJS("particles-js", {
  particles: {
    number: { value: 80 },
    size: { value: 2 },
    move: { speed: 0.5 },
    line_linked: { enable: true }
  }
});

// SHOW PASSWORD
function togglePassword(){
    let p = document.getElementById("password");
    let i = document.getElementById("icon");

    if(p.type === "password"){
        p.type = "text";
        i.classList.replace("bi-eye","bi-eye-slash");
    } else {
        p.type = "password";
        i.classList.replace("bi-eye-slash","bi-eye");
    }
}

// CAPTCHA
let captchaText = "<?php echo $_SESSION['captcha']; ?>";

function drawCaptcha(text){
    let canvas = document.getElementById("captchaCanvas");
    let ctx = canvas.getContext("2d");

    canvas.width = 100;
    canvas.height = 35;

    ctx.clearRect(0,0,100,35);

    ctx.fillStyle="#2a2a2a";
    ctx.fillRect(0,0,100,35);

    ctx.font="18px Poppins";
    ctx.fillStyle="#fff";
    ctx.setTransform(1,0.1,-0.1,1,0,0);
    ctx.fillText(text,10,22);

    for(let i=0;i<3;i++){
        ctx.strokeStyle="#888";
        ctx.beginPath();
        ctx.moveTo(Math.random()*100, Math.random()*35);
        ctx.lineTo(Math.random()*100, Math.random()*35);
        ctx.stroke();
    }

    for(let i=0;i<25;i++){
        ctx.fillStyle="#666";
        ctx.fillRect(Math.random()*100, Math.random()*35,1,1);
    }
}

drawCaptcha(captchaText);

// REFRESH CAPTCHA
function refreshCaptcha(){
    fetch("login.php?refresh=1")
    .then(res=>res.text())
    .then(data=>{
        captchaText = data;
        drawCaptcha(captchaText);
    });
}

// AJAX LOGIN
document.getElementById("loginForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("proses_login.php", {
        method: "POST",
        body: formData
    })
    .then(res=>res.text())
    .then(res=>{
        res = res.trim();
        if(res.startsWith("redirect:")){
            let url = res.substring("redirect:".length);
            showSuccessAndRedirect(url);
        } else if(res === "captcha_error"){
            document.getElementById("msg").innerHTML =
                "<div class='alert alert-danger'>Captcha salah! Silakan coba lagi.</div>";
            refreshCaptcha();
        } else {
            document.getElementById("msg").innerHTML =
                "<div class='alert alert-danger'>Login gagal! Username atau password salah.</div>";
            refreshCaptcha();
        }
    })
    .catch(err => {
        document.getElementById("msg").innerHTML =
            "<div class='alert alert-danger'>Terjadi kesalahan. Silakan coba lagi.</div>";
    });
});

function showSuccessAndRedirect(url) {
    // Isi nama sambutan dari input username
    let username = document.querySelector("input[name='username']").value;
    document.getElementById("welcomeName").textContent = username + "!";

    // Tampilkan overlay
    let overlay = document.getElementById("successOverlay");
    overlay.classList.add("show");

    // Reset & restart animasi progress bar
    let bar = document.getElementById("successBarFill");
    bar.style.animation = "none";
    bar.offsetHeight; // reflow
    bar.style.animation = "fillBar 2s linear forwards";

    // Redirect setelah 2.2 detik (sedikit lebih dari bar selesai)
    setTimeout(function(){
        window.location.href = url;
    }, 2200);
}
</script>

</body>
</html>