<?php
include 'includes/header.php';
include 'includes/sidebar.php';

$is_management = ($role === 'admin' || $role === 'pimpinan');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main class="flex-1 overflow-y-auto bg-slate-50 p-4 md:p-8">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Ringkasan Operasional</h2>
            <p class="text-slate-500 text-sm">Update terakhir: <?php echo date('d M Y, H:i'); ?></p>
        </div>
        
        <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-200 flex flex-wrap items-center gap-2">
            <input type="date" id="start_date" class="text-xs border-none focus:ring-0 text-slate-600 cursor-pointer" value="<?php echo date('Y-m-01'); ?>">
            <span class="text-slate-300">-</span>
            <input type="date" id="end_date" class="text-xs border-none focus:ring-0 text-slate-600 cursor-pointer" value="<?php echo date('Y-m-t'); ?>">
            <button onclick="loadDashboardData()" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-sync-alt" id="refresh-icon"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase">Saldo Akhir</p>
            <h3 id="stat-saldo" class="text-xl font-bold text-slate-800">Rp 0</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-emerald-500 uppercase">Pemasukan</p>
            <h3 id="stat-in" class="text-xl font-bold text-emerald-600 uppercase">Rp 0</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-red-500 uppercase">Pengeluaran</p>
            <h3 id="stat-out" class="text-xl font-bold text-red-600">Rp 0</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-yellow-500 uppercase">Zakat</p>
            <h3 id="stat-zakat" class="text-xl font-bold text-yellow-600">Rp 0</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <?php if ($is_management): ?>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Perbandingan Cabang</h3>
                    <div class="h-72"><canvas id="branchChart"></canvas></div>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-5 border-b border-slate-50"><h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3></div>
                <ul id="recent-list" class="divide-y divide-slate-50"></ul>
            </div>
        </div>

        <div class="space-y-6">
            <?php if ($is_management): ?>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Kategori Terbanyak</h3>
                    <div class="h-64"><canvas id="catChart"></canvas></div>
                </div>
            <?php endif; ?>
            
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-2xl text-white shadow-lg">
                <i class="fas fa-lightbulb mb-3 text-yellow-300"></i>
                <h4 class="font-bold mb-1">Tips Analitik</h4>
                <p class="text-xs leading-relaxed opacity-80">Gunakan filter tanggal untuk melihat laporan mingguan atau bulanan secara spesifik.</p>
            </div>
        </div>
    </div>
</main>

<script>
    let branchChart, catChart;
    const formatRp = (v) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(v);

    async function loadDashboardData() {
        const start = document.getElementById('start_date').value;
        const end = document.getElementById('end_date').value;
        const icon = document.getElementById('refresh-icon');
        
        icon.classList.add('fa-spin');

        try {
            const res = await fetch(`api/dashboard.php?start_date=${start}&end_date=${end}`);
            const { success, data } = await res.json();

            if (success) {
                // 1. Update Stats
                document.getElementById('stat-saldo').innerText = formatRp(data.saldo);
                document.getElementById('stat-in').innerText = formatRp(data.pemasukan);
                document.getElementById('stat-out').innerText = formatRp(data.pengeluaran);
                document.getElementById('stat-zakat').innerText = formatRp(data.potensi_zakat);

                // 2. Update Bar Chart
                if (data.branch_stats) {
                    if (branchChart) branchChart.destroy();
                    branchChart = new Chart(document.getElementById('branchChart'), {
                        type: 'bar',
                        data: {
                            labels: data.branch_stats.map(b => b.branch),
                            datasets: [{ label: 'Pengeluaran', data: data.branch_stats.map(b => b.total_out), backgroundColor: '#3b82f6', borderRadius: 8 }]
                        },
                        options: { maintainAspectRatio: false, plugins: { legend: false } }
                    });
                }

                // 3. Update Pie Chart
                if (data.top_categories) {
                    if (catChart) catChart.destroy();
                    catChart = new Chart(document.getElementById('catChart'), {
                        type: 'doughnut',
                        data: {
                            labels: data.top_categories.map(c => c.category),
                            datasets: [{ data: data.top_categories.map(c => c.total), backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'] }]
                        },
                        options: { maintainAspectRatio: false, cutout: '70%' }
                    });
                }

                // 4. Update Recent List
                document.getElementById('recent-list').innerHTML = data.recent_transactions.map(t => `
                    <li class="p-4 hover:bg-slate-50 transition flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full ${t.type === 'in' ? 'bg-emerald-500' : 'bg-red-500'}"></div>
                            <div>
                                <p class="text-sm font-bold text-slate-700">${t.category}</p>
                                <p class="text-[10px] text-slate-400">${t.branch} • ${t.date}</p>
                            </div>
                        </div>
                        <p class="text-sm font-mono font-bold ${t.type === 'in' ? 'text-emerald-600' : 'text-red-600'}">${t.type === 'in' ? '+' : '-'} ${formatRp(t.amount)}</p>
                    </li>
                `).join('');
            }
        } catch (e) { console.error("Load error:", e); }
        icon.classList.remove('fa-spin');
    }

    // Load awal saat halaman dibuka
    document.addEventListener('DOMContentLoaded', loadDashboardData);
</script>

<?php include 'includes/footer.php'; ?>