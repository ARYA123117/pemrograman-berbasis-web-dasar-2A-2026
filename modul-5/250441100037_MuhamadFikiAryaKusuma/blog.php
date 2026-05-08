<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blog Reflektif - Aryaaa</title>
</head>

<body class="bg-slate-50 p-6 md:p-12">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <div class="md:col-span-1 space-y-4">
                <h3 class="font-black text-slate-800 text-lg uppercase mb-4 tracking-tighter border-b-4 border-indigo-600 inline-block">Daftar Artikel</h3>
                <div class="flex flex-col gap-3">
                    <?php
                    $artikel = [
                        [
                            "judul" => "Belajar HTML Pertama Kali",
                            "tanggal" => "15 September 2025",
                            "refleksi" => "Pertama kali melihat tag-tag HTML terasa sangat asing, namun setelah berhasil menampilkan 'Hello World', rasanya luar biasa!",
                            "gambar" => "html-post.jpg",
                            "link" => "https://www.w3schools.com/html/"
                        ],
                        [
                            "judul" => "Error Pertama di Python",
                            "tanggal" => "02 Oktober 2025",
                            "refleksi" => "Menghadapi 'Indentation Error' selama satu jam adalah pengalaman yang sangat berharga untuk melatih ketelitian saya.",
                            "gambar" => "python-error.jpg",
                            "link" => "https://docs.python.org/3/tutorial/errors.html"
                        ],
                        [
                            "judul" => "Eksplorasi Framework Tailwind",
                            "tanggal" => "20 Maret 2026",
                            "refleksi" => "Tailwind CSS mengubah cara saya membangun UI secara drastis. Lebih cepat, efisien, dan sangat menyenangkan!",
                            "gambar" => "tailwind-dev.jpg",
                            "link" => "https://tailwindcss.com"
                        ]
                    ];

                    foreach ($artikel as $id => $data) {
                        echo "<a href='blog.php?id=$id' class='p-4 bg-white rounded-xl shadow-sm border-l-4 border-transparent hover:border-indigo-600 hover:bg-indigo-50 transition font-bold text-sm text-slate-700 shadow-indigo-100'>" . $data['judul'] . "</a>";
                    }
                    ?>
                </div>


                <div class="mt-8 p-6 bg-slate-800 rounded-2xl text-white">
                    <p class="text-[10px] uppercase font-bold text-slate-400 mb-2 tracking-widest">Motivation Quote</p>
                    <?php
                    $quotes = [
                        "Koding adalah seni memecahkan masalah yang kamu ciptakan sendiri.",
                        "Jangan berhenti saat lelah, berhentilah saat selesai.",
                        "Satu baris kode hari ini adalah satu langkah menuju masa depan.",
                        "Error bukan berarti gagal, itu berarti kamu sedang belajar hal baru."
                    ];
                    echo "<p class='italic font-serif text-sm'>\"" . $quotes[array_rand($quotes)] . "\"</p>";
                    ?>
                </div>
            </div>


            <div class="md:col-span-3 bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 min-h-[500px]">
                <?php if (isset($_GET['id']) && isset($artikel[$_GET['id']])):
                    $selected = $artikel[$_GET['id']];
                ?>
                    <h1 class="text-4xl font-black text-slate-800 mb-2 leading-tight"><?php echo $selected['judul']; ?></h1>
                    <p class="text-indigo-500 font-bold text-xs uppercase tracking-widest mb-8"><?php echo $selected['tanggal']; ?></p>


                    <div class="aspect-video bg-slate-100 rounded-3xl mb-8 flex items-center justify-center border-4 border-slate-50 overflow-hidden shadow-inner">
                        <img src="img/<?php echo $selected['gambar']; ?>"
                            alt="Ilustrasi"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    </div>

                    <div class="prose prose-slate max-w-none">
                        <h4 class="font-bold text-slate-800 mb-2  decoration-indigo-500 decoration-4">Refleksi Pengalaman:</h4>
                        <p class="text-slate-600 leading-relaxed text-lg mb-8">
                            <?php echo $selected['refleksi']; ?>
                        </p>
                    </div>

                    <a href="<?php echo $selected['link']; ?>" target="_blank" class="inline-flex items-center text-indigo-600 font-bold hover:underline">
                        Baca Referensi Tambahan &rarr;
                    </a>

                <?php else: ?>

                    <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <p class="text-xl font-bold">Silahkan pilih artikel untuk dibaca</p>
                    </div>
                <?php endif; ?>

                <div class="mt-20 pt-8 border-t border-slate-100">
                    <a href="timeline.php" class="text-slate-400 hover:text-indigo-600 font-bold text-xs uppercase tracking-widest transition">
                        &larr; Kembali ke Timeline
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>