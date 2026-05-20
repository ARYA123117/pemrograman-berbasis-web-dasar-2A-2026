<?php
include 'config.php';
$err = ""; $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $conn; 
    
    if (isset($_POST['register'])) {
        $u = mysqli_real_escape_string($conn, $_POST['username']);
        $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$u'");
        if(mysqli_num_rows($check) > 0) {
            $err = "Username sudah dipakai!";
        } else {
            mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$u', '$p', 'user')");
            $msg = "Akun berhasil dibuat! Silakan Sign In.";
        }
    }
    
    if (isset($_POST['login'])) {
        $u = mysqli_real_escape_string($conn, $_POST['username']);
        $p = $_POST['password'];
        $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$u'");
        if ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($p, $row['password'])) {
                $_SESSION['user_id'] = $row['id']; 
                $_SESSION['username'] = $row['username']; 
                $_SESSION['role'] = $row['role'];
                header("Location: index.php"); exit;
            }
        }
        $err = "Kombinasi salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Nexus Authentication</title>
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-[400px] bg-slate-900 border border-slate-800 p-10 rounded-[3rem] shadow-2xl">
        <div class="text-center mb-8">
            <div class="bg-indigo-600 w-16 h-16 rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                <i class="fas fa-fingerprint"></i>
            </div>
            <h2 id="at" class="text-3xl font-black text-white italic uppercase tracking-tighter">Nexus ID</h2>
        </div>

        <?php if($err) echo "<p class='text-red-500 text-center text-xs mb-4'>$err</p>"; ?>
        <?php if($msg) echo "<p class='text-emerald-500 text-center text-xs mb-4'>$msg</p>"; ?>

        <form id="lf" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" class="w-full bg-slate-950 border border-slate-800 p-4 rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-600 transition" required>
            <input type="password" name="password" placeholder="Password" class="w-full bg-slate-950 border border-slate-800 p-4 rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-600 transition" required>
            <button name="login" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Sign In</button>
            <p class="text-center text-slate-500 text-xs mt-6 font-bold uppercase">Belum punya akun? <button type="button" onclick="sw('r')" class="text-indigo-400 hover:underline">Daftar</button></p>
        </form>

        <form id="rf" method="POST" class="space-y-4 hidden">
            <input type="text" name="username" placeholder="New Username" class="w-full bg-slate-950 border border-slate-800 p-4 rounded-2xl text-white outline-none focus:ring-2 focus:ring-emerald-600 transition" required>
            <input type="password" name="password" placeholder="New Password" class="w-full bg-slate-950 border border-slate-800 p-4 rounded-2xl text-white outline-none focus:ring-2 focus:ring-emerald-600 transition" required>
            <button name="register" class="w-full bg-emerald-600 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Create Account</button>
            <p class="text-center text-slate-500 text-xs mt-6 font-bold uppercase tracking-widest">Sudah ada akun? <button type="button" onclick="sw('l')" class="text-emerald-400 hover:underline ml-1">Login</button></p>
        </form>
    </div>
    <script>
        function sw(t){ 
            document.getElementById('lf').classList.toggle('hidden', t==='r'); 
            document.getElementById('rf').classList.toggle('hidden', t==='l');
        }
    </script>
</body>
</html>