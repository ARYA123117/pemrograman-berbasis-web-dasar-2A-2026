<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profil Interaktif Developer</title>
</head>
<body class="bg-slate-50 p-4 md:p-10">
    <div class="max-w-6xl mx-auto space-y-8">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-slate-200">
            <div class="bg-indigo-700 p-6">
                <h1 class="text-xl font-bold text-white uppercase tracking-wider text-center">Profil Interaktif Developer Pemula</h1>
            </div>
            <div class="p-8">
                <table class="w-full text-left border-collapse">
                    <tr class="border-b border-slate-100">
                        <td class="py-3 font-bold text-slate-500 w-1/3 uppercase text-xs">Nama Lengkap</td>
                        <td class="py-3 text-slate-800">Muhamad Fiki Arya Kusuma</td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="py-3 font-bold text-slate-500 uppercase text-xs">ID Developer (NIM)</td>
                        <td class="py-3 text-slate-800">250441100037</td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="py-3 font-bold text-slate-500 uppercase text-xs">Kota/Tgl Lahir</td>
                        <td class="py-3 text-slate-800">Lamongan, 01 April 2007</td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="py-3 font-bold text-slate-500 uppercase text-xs">Email</td>
                        <td class="py-3 text-slate-800">mfikiarya@gmail.com</td>
                    </tr>
                    <tr>
                        <td class="py-3 font-bold text-slate-500 uppercase text-xs">No. WhatsApp</td>
                        <td class="py-3 text-slate-800">085755741684</td> 
                    </tr>
                </table>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center">
                    <span></span> Form Isian Dinamis
                </h2>
                
                <form method="POST" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Framework/Tools yang dikuasai (pisah dengan koma)</label>
                        <input type="text" name="framework" placeholder="Contoh: Tailwind, PHP, SQL" class="w-full mt-1 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Pengalaman Membuat Aplikasi</label>
                        <textarea name="pengalaman" rows="3" class="w-full mt-1 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tools Penunjang</label>
                            <div class="space-y-1 text-sm text-slate-600">
                                <label class="flex items-center"><input type="checkbox" name="tools[]" value="VS Code" class="mr-2"> VS Code</label>
                                <label class="flex items-center"><input type="checkbox" name="tools[]" value="GitHub" class="mr-2"> GitHub</label>
                                <label class="flex items-center"><input type="checkbox" name="tools[]" value="Figma" class="mr-2"> Figma</label>
                                <label class="flex items-center"><input type="checkbox" name="tools[]" value="Postman" class="mr-2"> Postman</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Minat Bidang</label>
                            <div class="space-y-1 text-sm text-slate-600">
                                <label class="flex items-center"><input type="radio" name="bidang" value="Frontend" checked class="mr-2"> Frontend</label>
                                <label class="flex items-center"><input type="radio" name="bidang" value="Backend" class="mr-2"> Backend</label>
                                <label class="flex items-center"><input type="radio" name="bidang" value="Fullstack" class="mr-2"> Fullstack</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Tingkat Skill Coding</label>
                        <select name="skill_level" class="w-full mt-1 border border-slate-300 rounded-lg px-4 py-2 outline-none">
                            <option value="Dasar">Dasar</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Profesional">Profesional</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">Proses & Tampilkan Data</button>
                </form>
            </div>


            <div class="bg-indigo-50 p-8 rounded-2xl border-2 border-dashed border-indigo-200">
                <h2 class="text-xl font-bold text-indigo-900 mb-6 flex items-center">
                    <span></span> Hasil Output
                </h2>

                <?php
                function prosesDataDeveloper($data) {
                    $frameworks = explode(",", $data['framework']);
                    $tools = isset($data['tools']) ? implode(", ", $data['tools']) : "Tidak ada";
                    
                    echo "<div class='bg-white p-6 rounded-xl shadow-sm border border-indigo-100'>";
                    echo "<table class='w-full text-sm mb-4'>";
                    echo "<tr class='border-b'><td class='py-2 font-bold text-slate-400 uppercase text-[10px]'>Bidang</td><td class='py-2 text-indigo-700 font-bold'>" . $data['bidang'] . "</td></tr>";
                    echo "<tr class='border-b'><td class='py-2 font-bold text-slate-400 uppercase text-[10px]'>Level</td><td class='py-2 text-slate-700'>" . $data['skill_level'] . "</td></tr>";
                    echo "<tr class='border-b'><td class='py-2 font-bold text-slate-400 uppercase text-[10px]'>Tools</td><td class='py-2 text-slate-700'>" . $tools . "</td></tr>";
                    echo "<tr><td class='py-2 font-bold text-slate-400 uppercase text-[10px]'>Framework</td><td class='py-2 text-slate-700'>" . implode(" • ", $frameworks) . "</td></tr>";
                    echo "</table>";

                    if (count($frameworks) > 2) {
                        echo "<p class='bg-emerald-500 text-white p-2 rounded text-xs font-bold text-center mb-4 shadow-md'>Skill Anda cukup luas di bidang development!</p>";
                    }

                    echo "<h4 class='font-bold text-slate-800 text-sm mb-1'>Pengalaman:</h4>";
                    echo "<p class='text-slate-600 text-sm italic leading-relaxed'>\"" . $data['pengalaman'] . "\"</p>";
                    echo "</div>";
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($_POST['framework']) && !empty($_POST['pengalaman'])) {
                        prosesDataDeveloper($_POST);
                    } else {
                        echo "<p class='text-red-500 font-bold'>Gagal: Semua input wajib diisi!</p>";
                    }
                } else {
                    echo "<p class='text-slate-400 text-center py-20 italic'>Data akan muncul di sini setelah diproses.</p>";
                }
                ?>
            </div>
        </div>

        <div class="text-center">
            <a href="timeline.php" class="inline-block bg-white text-indigo-600 border border-indigo-600 px-6 py-2 rounded-full font-bold hover:bg-indigo-600 hover:text-white transition shadow-md">Menuju Timeline Journey &rarr;</a>
        </div>
    </div>
</body>
</html>