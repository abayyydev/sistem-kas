<?php
include 'includes/header.php';
include 'includes/sidebar.php';

// Cek apakah user memiliki akses manajemen
$is_management = ($role === 'admin' || $role === 'pimpinan');
?>

<!-- Load Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar">

    <!-- DASHBOARD HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Ringkasan Operasional</h2>
            <div class="flex items-center gap-2 mt-1">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                </span>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Update terakhir: <?php echo date('d M Y, H:i'); ?></p>
            </div>
        </div>
        
        <!-- FILTER TANGGAL -->
        <div class="bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-1 group transition-all hover:border-purple-300 hover:shadow-md">
            <div class="flex items-center px-3 gap-2">
                <i class="fa-regular fa-calendar-days text-purple-500"></i>
                <input type="date" id="start_date" class="text-xs font-semibold border-none focus:ring-0 text-slate-600 cursor-pointer bg-transparent" value="<?php echo date('Y-m-01'); ?>">
                <span class="text-slate-300 font-light">—</span>
                <input type="date" id="end_date" class="text-xs font-semibold border-none focus:ring-0 text-slate-600 cursor-pointer bg-transparent" value="<?php echo date('Y-m-t'); ?>">
            </div>
            <button onclick="loadDashboardData()" class="bg-purple-600 text-white w-10 h-10 rounded-xl hover:bg-purple-700 transition-all flex items-center justify-center shadow-lg shadow-purple-100 active:scale-95">
                <i class="fa-solid fa-rotate" id="refresh-icon"></i>
            </button>
        </div>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Kartu Saldo -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-vault text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg uppercase tracking-widest">Saldo</span>
            </div>
            <h3 id="stat-saldo" class="text-2xl font-black text-slate-800 tracking-tight">Rp 0</h3>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Akumulasi saldo saat ini</p>
        </div>

        <!-- Kartu Pemasukan -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-arrow-up-right-dots text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg uppercase tracking-widest">Inflow</span>
            </div>
            <h3 id="stat-in" class="text-2xl font-black text-emerald-600 tracking-tight">Rp 0</h3>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Total dana masuk</p>
        </div>

        <!-- Kartu Pengeluaran -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-arrow-down-right-dots text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-lg uppercase tracking-widest">Outflow</span>
            </div>
            <h3 id="stat-out" class="text-2xl font-black text-rose-600 tracking-tight">Rp 0</h3>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Total dana keluar</p>
        </div>

        <!-- Kartu Zakat -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-hand-holding-heart text-xl"></i>
                </div>
                <span class="text-[10px] font-bold text-amber-500 bg-amber-50 px-2 py-1 rounded-lg uppercase tracking-widest">Zakat</span>
            </div>
            <h3 id="stat-zakat" class="text-2xl font-black text-amber-600 tracking-tight">Rp 0</h3>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Potensi pembersihan</p>
        </div>
    </div>

    <!-- BAGIAN GRAFIK & LIST -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Utama (Kiri) -->
        <div class="lg:col-span-2 space-y-8">
            <?php if ($is_management): ?>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 transition-all hover:shadow-lg">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="font-black text-slate-800 text-lg">Perbandingan Cabang</h3>
                            <p class="text-xs text-slate-400 font-medium">Distribusi pengeluaran antar wilayah</p>
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical text-slate-300"></i>
                    </div>
                    <div class="h-80"><canvas id="branchChart"></canvas></div>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-lg">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="font-black text-slate-800 text-lg">Aktivitas Terbaru</h3>
                    <button class="text-[11px] font-bold text-purple-600 hover:text-purple-800 uppercase tracking-widest">Lihat Semua</button>
                </div>
                <ul id="recent-list" class="divide-y divide-slate-50">
                    <!-- Data akan dimuat via JavaScript -->
                </ul>
            </div>
        </div>

        <!-- Kolom Samping (Kanan) -->
        <div class="space-y-8">
            <?php if ($is_management): ?>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 transition-all hover:shadow-lg">
                    <div class="mb-6">
                        <h3 class="font-black text-slate-800 text-lg">Kategori Terbanyak</h3>
                        <p class="text-xs text-slate-400 font-medium">Alokasi dana berdasarkan pos</p>
                    </div>
                    <div class="h-64"><canvas id="catChart"></canvas></div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gradient-to-br from-purple-600 to-indigo-700 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-purple-200 relative overflow-hidden group">
                <!-- Dekorasi Latar Belakang -->
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-lightbulb text-yellow-300"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Tips Analitik</h4>
                    <p class="text-sm leading-relaxed text-purple-100 font-medium opacity-90">
                        Gunakan filter tanggal di bagian atas untuk melakukan audit laporan mingguan atau bulanan secara mendalam.
                    </p>
                    <button class="mt-6 px-5 py-2.5 bg-white text-purple-700 rounded-xl text-xs font-bold hover:bg-purple-50 transition-colors">
                        Pelajari Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    let branchChart, catChart;
    
    // Fungsi Format Mata Uang IDR
    const formatRp = (v) => new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    }).format(v);

    // Fungsi Utama Memuat Data Dashboard
    async function loadDashboardData() {
        const start = document.getElementById('start_date').value;
        const end = document.getElementById('end_date').value;
        const icon = document.getElementById('refresh-icon');
        
        icon.classList.add('fa-spin');

        try {
            const res = await fetch(`api/dashboard.php?start_date=${start}&end_date=${end}`);
            const result = await res.json();

            if (result.success) {
                const data = result.data;

                // 1. Update Kartu Statistik
                document.getElementById('stat-saldo').innerText = formatRp(data.saldo);
                document.getElementById('stat-in').innerText = formatRp(data.pemasukan);
                document.getElementById('stat-out').innerText = formatRp(data.pengeluaran);
                document.getElementById('stat-zakat').innerText = formatRp(data.potensi_zakat);

                // 2. Update Bar Chart (Perbandingan Cabang)
                if (data.branch_stats) {
                    if (branchChart) branchChart.destroy();
                    const ctx = document.getElementById('branchChart').getContext('2d');
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, '#9333ea');
                    gradient.addColorStop(1, '#c084fc');

                    branchChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.branch_stats.map(b => b.branch),
                            datasets: [{ 
                                label: 'Pengeluaran', 
                                data: data.branch_stats.map(b => b.total_out), 
                                backgroundColor: gradient,
                                borderRadius: 12,
                                hoverBackgroundColor: '#7e22ce'
                            }]
                        },
                        options: { 
                            maintainAspectRatio: false, 
                            plugins: { legend: false },
                            scales: {
                                y: { 
                                    beginAtZero: true, 
                                    grid: { display: true, color: '#f1f5f9', drawBorder: false }, 
                                    ticks: { font: { family: 'Inter', size: 10 } } 
                                },
                                x: { 
                                    grid: { display: false }, 
                                    ticks: { font: { family: 'Inter', size: 10, weight: '600' } } 
                                }
                            }
                        }
                    });
                }

                // 3. Update Pie Chart (Kategori)
                if (data.top_categories) {
                    if (catChart) catChart.destroy();
                    catChart = new Chart(document.getElementById('catChart'), {
                        type: 'doughnut',
                        data: {
                            labels: data.top_categories.map(c => c.category),
                            datasets: [{ 
                                data: data.top_categories.map(c => c.total), 
                                backgroundColor: ['#9333ea', '#a855f7', '#c084fc', '#d8b4fe', '#f3e8ff'],
                                borderWeight: 0,
                                hoverOffset: 20
                            }]
                        },
                        options: { 
                            maintainAspectRatio: false, 
                            cutout: '82%',
                            plugins: {
                                legend: { 
                                    position: 'bottom', 
                                    labels: { 
                                        usePointStyle: true, 
                                        padding: 20, 
                                        font: { family: 'Inter', size: 10, weight: '600' } 
                                    } 
                                }
                            }
                        }
                    });
                }

                // 4. Update List Transaksi Terbaru
                document.getElementById('recent-list').innerHTML = data.recent_transactions.map(t => `
                    <li class="px-8 py-5 hover:bg-slate-50 transition-all flex justify-between items-center group cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center ${t.type === 'in' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600'} transition-transform group-hover:scale-110">
                                <i class="fa-solid ${t.type === 'in' ? 'fa-circle-arrow-down' : 'fa-circle-arrow-up'} text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[14px] font-black text-slate-700 leading-tight">${t.category}</p>
                                <p class="text-[11px] text-slate-400 font-bold mt-0.5 uppercase tracking-wide">${t.branch} • ${t.date}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black ${t.type === 'in' ? 'text-emerald-600' : 'text-rose-600'}">
                                ${t.type === 'in' ? '+' : '-'} ${formatRp(t.amount)}
                            </p>
                            <span class="text-[9px] font-bold text-slate-300 uppercase tracking-tighter italic">Verified</span>
                        </div>
                    </li>
                `).join('');
            }
        } catch (e) { 
            console.error("Gagal memuat data dashboard:", e); 
        } finally {
            icon.classList.remove('fa-spin');
        }
    }

    // Jalankan pemuatan data saat halaman siap
    document.addEventListener('DOMContentLoaded', loadDashboardData);
</script>

<?php include 'includes/footer.php'; ?>