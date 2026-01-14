<?php
// Panggil Header (sudah termasuk cek login & buka HTML)
include 'includes/header.php';
// Panggil Sidebar
include 'includes/sidebar.php';
?>

<!-- KONTEN HALAMAN DIMULAI DISINI -->
<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">
        
        <!-- Welcome Banner -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border-l-4 border-blue-600 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Dashboard Overview</h2>
                <p class="text-slate-500 text-sm mt-1">
                    Halo, <span class="font-bold text-blue-600"><?php echo htmlspecialchars($full_name); ?></span>! 
                    Berikut ringkasan kas cabang <span class="font-bold"><?php echo htmlspecialchars($branch); ?></span>.
                </p>
            </div>
            <div class="hidden md:block text-4xl text-blue-100">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Saldo -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Saldo Akhir</p>
                        <h3 id="stat-saldo" class="text-2xl font-bold text-slate-800 mt-1">Rp 0</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg text-blue-600"><i class="fas fa-wallet"></i></div>
                </div>
            </div>
            <!-- Masuk -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Pemasukan</p>
                        <h3 id="stat-in" class="text-2xl font-bold text-emerald-600 mt-1">Rp 0</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600"><i class="fas fa-arrow-down"></i></div>
                </div>
            </div>
            <!-- Keluar -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Pengeluaran</p>
                        <h3 id="stat-out" class="text-2xl font-bold text-red-600 mt-1">Rp 0</h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-lg text-red-600"><i class="fas fa-arrow-up"></i></div>
                </div>
            </div>
            <!-- Zakat -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Potensi Zakat</p>
                        <h3 id="stat-zakat" class="text-2xl font-bold text-yellow-600 mt-1">Rp 0</h3>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-lg text-yellow-600"><i class="fas fa-hand-holding-heart"></i></div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- SCRIPT KHUSUS HALAMAN INI -->
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const response = await fetch('api/dashboard.php');
            const result = await response.json();
            if (result.success) {
                // formatRupiah sudah tersedia global dari footer.php
                document.getElementById('stat-saldo').innerText = formatRupiah(result.data.saldo);
                document.getElementById('stat-in').innerText = formatRupiah(result.data.pemasukan);
                document.getElementById('stat-out').innerText = formatRupiah(result.data.pengeluaran);
                document.getElementById('stat-zakat').innerText = formatRupiah(result.data.potensi_zakat);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>

<?php
// Panggil Footer (Tutup HTML)
include 'includes/footer.php';
?>