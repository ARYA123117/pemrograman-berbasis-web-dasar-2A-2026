<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Timeline Perjalanan - Aryaaa</title>
</head>
<body class="bg-slate-50 p-6 md:p-12">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-black text-slate-800 mb-12 text-center uppercase tracking-widest">Timeline Perjalanan Belajar</h1>
        
        <div class="relative border-l-4 border-indigo-200 ml-6 space-y-10">
            <?php

            $riwayat_belajar = [
                ["tahun" => 2025, "kegiatan" => "Masuk Kuliah di Prodi Sistem Informasi Universitas Trunojoyo Madura."],
                ["tahun" => 2025, "kegiatan" => "Mulai mendalami pemrograman Python dan lulus kursus Dasar AI."],
                ["tahun" => 2025, "kegiatan" => "Mengerjakan proyek Hospital Management System pertama kali."],
                ["tahun" => 2026, "kegiatan" => "Bergabung dengan Information Technology Center (ITC) divisi Infokom."],
                ["tahun" => 2026, "kegiatan" => "Mulai fokus pada Web Development menggunakan Tailwind CSS."],
                ["tahun" => 2026, "kegiatan" => "Mulai fokus pada Web Development menggunakan Tailwind CSS."]
            ];

            function beriEfekTahun($tahun) {
                if ($tahun == 2025) {
                    return "<span class='bg-indigo-600 text-white px-4 py-1 rounded-full text-xs font-black shadow-lg uppercase'>$tahun</span>";
                }
                return "<span class='bg-slate-200 text-slate-600 px-4 py-1 rounded-full text-xs font-bold'>$tahun</span>";
            }

            foreach ($riwayat_belajar as $data): ?>
                <div class="relative pl-10">
                    <div class="absolute -left-[14px] top-1 w-6 h-6 bg-white border-4 border-indigo-500 rounded-full shadow-sm"></div>
                    
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:scale-105 hover:shadow-lg transition">
                        <div class="mb-2">
                            <?php echo beriEfekTahun($data['tahun']); ?>
                        </div>
                        <p class="text-slate-600 leading-relaxed font-medium">
                            <?php echo $data['kegiatan']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-16 flex flex-col md:flex-row justify-between items-center gap-4 border-t pt-8">
            <a href="index.php" class="flex items-center text-slate-500 hover:text-indigo-600 transition font-bold uppercase text-xs tracking-tighter">
                &larr; Kembali ke Profil
            </a>
            <a href="blog.php" class="bg-indigo-600 text-white px-8 py-3 rounded-xl hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition font-bold text-sm">
                Menuju Blog Developer &rarr;
            </a>
        </div>
    </div>
</body>
</html>