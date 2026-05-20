<?php
include 'config.php';
cek_login();

/** @var mysqli $conn */ 


if (isset($_POST['add']) && $_SESSION['role'] == 'admin') {
    $n = mysqli_real_escape_string($conn, $_POST['nama']);
    $k = mysqli_real_escape_string($conn, $_POST['kat']);
    $s = (int)$_POST['stok'];
    $h = (float)$_POST['harga'];
    $t = $_POST['tgl'];
    mysqli_query($conn, "INSERT INTO barang (nama_barang, kategori, stok, harga_satuan, tgl_masuk) VALUES ('$n', '$k', '$s', '$h', '$t')");
    header("Location: index.php"); exit();
}


if (isset($_POST['edit']) && $_SESSION['role'] == 'admin') {
    $id = (int)$_POST['id_barang'];
    $n = mysqli_real_escape_string($conn, $_POST['nama']);
    $k = mysqli_real_escape_string($conn, $_POST['kat']);
    $s = (int)$_POST['stok'];
    $h = (float)$_POST['harga'];
    mysqli_query($conn, "UPDATE barang SET nama_barang='$n', kategori='$k', stok=$s, harga_satuan=$h WHERE id=$id");
    header("Location: index.php"); exit();
}


if (isset($_GET['del_b']) && $_SESSION['role'] == 'admin') {
    $id = (int)$_GET['del_b'];
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
    header("Location: index.php"); exit();
}


$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM barang";
if ($search != '') {
    $query .= " WHERE nama_barang LIKE '%$search%' OR kategori LIKE '%$search%'";
}
$q_barang = mysqli_query($conn, $query);
$count = mysqli_num_rows($q_barang);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Nexus Premium Dashboard</title>
    <style>
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .sidebar-item:hover { background: #4f46e5; color: white; transform: translateX(5px); }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex text-slate-800 font-sans">

    <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col sticky top-0 h-screen">
        <div class="p-8 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg shadow-indigo-200"><i class="fas fa-box-open"></i></div>
            <span class="font-black text-xl tracking-tighter italic">NEXUS v1</span>
        </div>
        <nav class="p-6 flex-1 space-y-2">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Menu Utama</p>
            <a href="index.php" class="sidebar-item flex items-center gap-3 p-4 rounded-2xl transition-all duration-300 font-bold bg-indigo-600 text-white shadow-lg shadow-indigo-100">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </nav>
        <div class="p-6 border-t border-slate-100">
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <p class="text-[10px] font-bold text-slate-400 uppercase">User</p>
                <p class="text-xs font-black text-indigo-600"><?= $_SESSION['username'] ?></p>
            </div>
        </div>
    </aside>

    <main class="flex-1 p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Inventaris Barang</h1>
                <p class="text-slate-400 text-sm italic">Sistem Informasi Manajemen (AryaaTzy)</p>
            </div>
            
            <form action="" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari barang..." class="p-3 rounded-2xl border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 shadow-sm">
                <button type="submit" class="bg-white p-3 rounded-2xl border border-slate-200 text-indigo-600"><i class="fas fa-search"></i></button>
            </form>

            <div class="flex items-center gap-6 bg-white p-3 pr-6 rounded-3xl shadow-sm border border-slate-200">
                <div class="bg-indigo-100 p-3 rounded-2xl text-indigo-600 font-black"><i class="fas fa-user-shield"></i></div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest leading-none">Role: <?= $_SESSION['role'] ?></p>
                    <p class="text-sm font-black text-slate-700"><?= $_SESSION['username'] ?></p>
                </div>
                <a href="logout.php" class="ml-4 text-rose-500 hover:text-rose-700 font-black text-xs uppercase underline tracking-widest">Logout</a>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border flex items-center gap-6 hover:shadow-xl transition-all border-l-8 border-l-indigo-600 group">
                <div class="bg-indigo-50 p-5 rounded-3xl text-indigo-600 text-2xl group-hover:scale-110 transition"><i class="fas fa-cubes"></i></div>
                <div><p class="text-slate-400 text-xs font-bold uppercase">Total Jenis</p><h4 class="text-3xl font-black"><?= $count ?></h4></div>
            </div>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
            <button onclick="openModal('addModal')" class="bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl text-white flex flex-col justify-center items-center hover:bg-indigo-700 transition">
                <i class="fas fa-plus-circle text-3xl mb-2"></i>
                <span class="font-black text-xs uppercase tracking-widest">Tambah Data Baru</span>
            </button>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Katalog Produk</h3>
                <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-4 py-2 rounded-full tracking-tighter">DATA REALTIME</span>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] text-slate-400 font-black uppercase tracking-[2px]">
                        <th class="px-8 py-4 border-b">Detail Barang</th>
                        <th class="px-8 py-4 border-b">Kategori</th>
                        <th class="px-8 py-4 border-b text-center">Stok</th>
                        <th class="px-8 py-4 border-b">Harga Satuan</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php while($row = mysqli_fetch_assoc($q_barang)): ?>
                    <tr class="hover:bg-indigo-50/30 transition group">
                        <td class="px-8 py-6">
                            <p class="font-black text-slate-700 group-hover:text-indigo-600 transition uppercase"><?= htmlspecialchars($row['nama_barang']) ?></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Masuk: <?= $row['tgl_masuk'] ?></p>
                        </td>
                        <td class="px-8 py-6"><span class="bg-slate-100 text-slate-500 text-[10px] px-4 py-1.5 rounded-full font-black"><?= strtoupper($row['kategori']) ?></span></td>
                        <td class="px-8 py-6 text-center font-mono font-black text-slate-500"><?= $row['stok'] ?></td>
                        <td class="px-8 py-6 font-black text-indigo-600">Rp <?= number_format($row['harga_satuan'],0,',','.') ?></td>
                        <td class="px-8 py-6 text-center space-x-2">
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <button onclick="openEditModal(<?= htmlspecialchars(json_encode($row)) ?>)" class="text-indigo-400 hover:text-indigo-600"><i class="fas fa-edit"></i></button>
                                <a href="?del_b=<?= $row['id'] ?>" class="text-rose-400 hover:text-rose-600" onclick="return confirm('Hapus barang ini?')"><i class="fas fa-trash-alt"></i></a>
                            <?php else: ?>
                                <i class="fas fa-lock text-slate-200"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="addModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur hidden z-[100] flex items-center justify-center p-6">
        <div class="bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl">
            <h3 class="text-2xl font-black mb-8 text-slate-800">New Inventory Entry</h3>
            <form method="POST" class="space-y-4">
                <input type="text" name="nama" placeholder="Nama Barang" class="w-full bg-slate-50 border p-4 rounded-2xl outline-none" required>
                <input type="text" name="kat" placeholder="Kategori" class="w-full bg-slate-50 border p-4 rounded-2xl outline-none" required>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="stok" placeholder="Stok" class="bg-slate-50 border p-4 rounded-2xl outline-none" required>
                    <input type="number" name="harga" placeholder="Harga" class="bg-slate-50 border p-4 rounded-2xl outline-none" required>
                </div>
                <input type="date" name="tgl" class="w-full bg-slate-50 border p-4 rounded-2xl outline-none" required>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('addModal')" class="flex-1 bg-slate-100 p-4 rounded-2xl font-black text-xs uppercase">Batal</button>
                    <button name="add" class="flex-1 bg-indigo-600 text-white p-4 rounded-2xl font-black text-xs uppercase shadow-lg">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur hidden z-[100] flex items-center justify-center p-6">
        <div class="bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl">
            <h3 class="text-2xl font-black mb-8 text-slate-800 uppercase italic">Update Data</h3>
            <form method="POST" class="space-y-4">
                <input type="hidden" name="id_barang" id="edit_id">
                <input type="text" name="nama" id="edit_nama" class="w-full bg-slate-50 border p-4 rounded-2xl" required>
                <input type="text" name="kat" id="edit_kat" class="w-full bg-slate-50 border p-4 rounded-2xl" required>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="stok" id="edit_stok" class="bg-slate-50 border p-4 rounded-2xl" required>
                    <input type="number" name="harga" id="edit_harga" class="bg-slate-50 border p-4 rounded-2xl" required>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('editModal')" class="flex-1 bg-slate-100 p-4 rounded-2xl font-black text-xs uppercase tracking-widest">Batal</button>
                    <button name="edit" class="flex-1 bg-indigo-600 text-white p-4 rounded-2xl font-black text-xs uppercase shadow-lg">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        
        function openEditModal(data) {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_nama').value = data.nama_barang;
            document.getElementById('edit_kat').value = data.kategori;
            document.getElementById('edit_stok').value = data.stok;
            document.getElementById('edit_harga').value = data.harga_satuan;
            openModal('editModal');
        }
    </script>
</body>
</html>