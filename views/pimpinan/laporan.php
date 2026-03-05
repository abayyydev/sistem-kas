<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/pimpinan/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';
?>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar">

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10 print:hidden">
        <div>
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo $path; ?>index.php" class="hover:text-purple-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-purple-600">Laporan Keuangan</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Laporan Kas & Zakat</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Rekapitulasi arus kas masuk, keluar, dan pembersihan dana secara periodik.</p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3">
            <button onclick="window.print()"
                class="flex items-center gap-2 px-5 py-3 bg-white border border-slate-200 rounded-2xl text-slate-600 text-sm font-bold hover:bg-slate-50 hover:border-purple-200 hover:text-purple-600 transition-all shadow-sm group">
                <i class="fa-solid fa-file-pdf text-rose-500 group-hover:scale-110 transition-transform"></i>
                Cetak PDF
            </button>
            <button onclick="exportExcel()"
                class="flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100 active:scale-95 group">
                <i class="fa-solid fa-file-excel group-hover:rotate-12 transition-transform"></i>
                Export Excel
            </button>
        </div>
    </div>

    <!-- FILTER BAR (LUXURY STYLE) -->
    <div class="max-w-7xl mx-auto mb-10 print:hidden">
        <div class="bg-white p-2 rounded-[2rem] shadow-sm border border-slate-100 flex flex-wrap items-center gap-4 lg:gap-6">
            
            <div class="flex-1 min-w-[150px] flex items-center gap-3 px-4">
                <i class="fa-solid fa-calendar-days text-purple-500"></i>
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Periode Bulan</label>
                    <select id="filter-month" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0 cursor-pointer">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>

            <div class="h-10 w-[1px] bg-slate-100 hidden lg:block"></div>

            <div class="flex-1 min-w-[120px] flex items-center gap-3 px-4">
                <i class="fa-solid fa-clock-rotate-left text-purple-500"></i>
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Tahun</label>
                    <select id="filter-year" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0 cursor-pointer">
                        <?php
                        $curr_year = date('Y');
                        for ($i = $curr_year; $i >= $curr_year - 2; $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php if ($role !== 'pj_gudang'): ?>
            <div class="h-10 w-[1px] bg-slate-100 hidden lg:block"></div>
            <div class="flex-1 min-w-[180px] flex items-center gap-3 px-4">
                <i class="fa-solid fa-building text-purple-500"></i>
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Lokasi Cabang</label>
                    <select id="filter-branch" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0 cursor-pointer">
                        <option value="all">Semua Cabang</option>
                    </select>
                </div>
            </div>
            <?php endif; ?>

            <button onclick="loadReport()"
                class="bg-purple-600 text-white px-8 py-3.5 rounded-2xl hover:bg-purple-700 transition-all font-black text-xs uppercase tracking-[0.2em] shadow-lg shadow-purple-100 active:scale-95 ml-auto">
                Tampilkan Data
            </button>
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm transition-all hover:shadow-lg">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">Total Pemasukan</p>
            <h3 id="sum-in" class="text-2xl font-black text-slate-800 tracking-tight uppercase">Rp 0</h3>
            <div class="w-full bg-emerald-50 h-1.5 rounded-full mt-4 overflow-hidden">
                <div class="bg-emerald-500 h-full w-full opacity-30"></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm transition-all hover:shadow-lg">
            <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-1">Total Pengeluaran</p>
            <h3 id="sum-out" class="text-2xl font-black text-slate-800 tracking-tight uppercase">Rp 0</h3>
            <div class="w-full bg-rose-50 h-1.5 rounded-full mt-4 overflow-hidden">
                <div class="bg-rose-500 h-full w-full opacity-30"></div>
            </div>
        </div>
        <div class="bg-purple-600 p-6 rounded-[2rem] shadow-xl shadow-purple-100 transition-all hover:-translate-y-1 group">
            <p class="text-[10px] font-black text-purple-200 uppercase tracking-widest mb-1 group-hover:text-white transition-colors">Selisih (Cashflow)</p>
            <h3 id="sum-bal" class="text-2xl font-black text-white tracking-tight uppercase">Rp 0</h3>
            <div class="w-full bg-white/20 h-1.5 rounded-full mt-4"></div>
        </div>
        <div class="bg-amber-500 p-6 rounded-[2rem] shadow-xl shadow-amber-100 transition-all hover:-translate-y-1 group">
            <p class="text-[10px] font-black text-amber-100 uppercase tracking-widest mb-1 group-hover:text-white transition-colors">Akumulasi Zakat</p>
            <h3 id="sum-zakat" class="text-2xl font-black text-white tracking-tight uppercase">Rp 0</h3>
            <div class="w-full bg-white/20 h-1.5 rounded-full mt-4"></div>
        </div>
    </div>

    <!-- TABEL LAPORAN (LUXURY TABLE) -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/30">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600" id="table-laporan">
                    <thead class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Unit / Cabang</th>
                            <th class="px-8 py-5">Kategori & Akun</th>
                            <th class="px-8 py-5">Keterangan Detail</th>
                            <th class="px-8 py-5 text-right">Debet (Masuk)</th>
                            <th class="px-8 py-5 text-right">Kredit (Keluar)</th>
                            <th class="px-8 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody id="report-body" class="divide-y divide-slate-50">
                        <!-- Data loaded via JS -->
                        <tr>
                            <td colspan="7" class="text-center py-20">
                                <div class="flex flex-col items-center justify-center opacity-30">
                                    <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
                                    <p class="font-bold uppercase tracking-widest text-[10px]">Menyusun Laporan Finansial...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-8 mb-10 text-center italic">
            <i class="fa-solid fa-circle-check text-purple-400 mr-2"></i> 
            Laporan ini dihasilkan secara otomatis oleh Sistem Sigma Cash Management.
        </p>
    </div>
</main>

<script>
    // Set default month
    document.getElementById('filter-month').value = new Date().toISOString().slice(5, 7);

    // Format Rupiah
    const formatRp = (v) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(v);

    // 1. Load Opsi Cabang
    const loadFilterBranches = async () => {
        const select = document.getElementById('filter-branch');
        if (!select) return;

        try {
            const response = await fetch(BASE_PATH + 'api/branches.php');
            const result = await response.json();
            if (result.success) {
                select.innerHTML = '<option value="all">Semua Cabang</option>';
                result.data.forEach(branch => {
                    const option = document.createElement('option');
                    option.value = branch.name;
                    option.textContent = branch.name;
                    select.appendChild(option);
                });
            }
        } catch (error) { console.error(error); }
    };

    // 2. Load Report Data
    const loadReport = async () => {
        const month = document.getElementById('filter-month').value;
        const year = document.getElementById('filter-year').value;
        let branch = 'all';
        const branchSelect = document.getElementById('filter-branch');
        if (branchSelect) branch = branchSelect.value;

        // Reset Table
        document.getElementById('report-body').innerHTML = `
            <tr><td colspan="7" class="text-center py-20 opacity-30">
                <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
            </td></tr>`;

        try {
            const url = `${BASE_PATH}api/report.php?month=${month}&year=${year}&branch=${branch}`;
            const response = await fetch(url);
            const result = await response.json();

            if (result.success) {
                // Update Cards
                document.getElementById('sum-in').innerText = formatRp(result.data.summary.total_in);
                document.getElementById('sum-out').innerText = formatRp(result.data.summary.total_out);
                document.getElementById('sum-bal').innerText = formatRp(result.data.summary.balance);
                document.getElementById('sum-zakat').innerText = formatRp(result.data.summary.total_zakat);

                // Render Table
                const tbody = document.getElementById('report-body');
                tbody.innerHTML = '';

                if (result.data.transactions.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-20 font-bold text-slate-300 uppercase tracking-widest text-xs italic">Data transaksi periode ini belum tersedia.</td></tr>`;
                    return;
                }

                result.data.transactions.forEach(trx => {
                    const masuk = trx.type === 'in' ? formatRp(trx.amount) : '—';
                    const keluar = trx.type === 'out' ? formatRp(trx.amount) : '—';
                    const zakatIcon = trx.is_zakat == 1 ? '<i class="fa-solid fa-hand-holding-heart text-amber-500 ml-2" title="Alokasi Zakat"></i>' : '';

                    let statusBadge = '';
                    if (trx.status === 'verified') 
                        statusBadge = '<span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">Verified</span>';
                    else 
                        statusBadge = '<span class="px-3 py-1 bg-slate-50 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-slate-100">Pending</span>';

                    tbody.innerHTML += `
                        <tr class="group hover:bg-purple-50/30 transition-all">
                            <td class="px-8 py-5">
                                <div class="flex flex-col leading-tight">
                                    <span class="font-bold text-slate-800">${trx.date.split('-')[2]}</span>
                                    <span class="text-[10px] text-slate-400 font-black uppercase tracking-tighter">${trx.date.split('-')[1]}/${trx.date.split('-')[0]}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="font-bold text-slate-700 tracking-tight">${trx.branch}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <span class="font-bold text-purple-700 bg-purple-50 px-3 py-1 rounded-lg border border-purple-100 text-xs">${trx.category}</span>
                                    ${zakatIcon}
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-xs text-slate-500 font-medium leading-relaxed max-w-xs truncate" title="${trx.description}">${trx.description}</p>
                            </td>
                            <td class="px-8 py-5 text-right font-black text-emerald-600">${masuk}</td>
                            <td class="px-8 py-5 text-right font-black text-rose-600">${keluar}</td>
                            <td class="px-8 py-5 text-center">${statusBadge}</td>
                        </tr>
                    `;
                });
            }
        } catch (error) {
            console.error(error);
            Swal.fire({ icon: 'error', title: 'Data Error', text: 'Gagal mengambil laporan dari server.' });
        }
    };

    // Export Excel
    const exportExcel = () => {
        let table = document.getElementById("table-laporan");
        let html = table.outerHTML.replace(/ /g, '%20');
        let a = document.createElement('a');
        a.href = 'data:application/vnd.ms-excel,' + html;
        a.download = 'SIGMA_CASH_LAPORAN_' + new Date().toISOString().slice(0, 10) + '.xls';
        a.click();
    }

    // Init
    document.addEventListener('DOMContentLoaded', () => {
        loadFilterBranches();
        loadReport();
    });
</script>

<style>
    @media print {
        body * { visibility: hidden; background: white !important; }
        main, main * { visibility: visible; }
        main { position: absolute; left: 0; top: 0; width: 100%; padding: 0; margin: 0; }
        .print\:hidden { display: none !important; }
        .rounded-\[2\.5rem\], .rounded-\[2rem\] { border-radius: 0 !important; border: 1px solid #eee !important; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #eee; padding: 10px; font-size: 10px; }
        th { background: #f8fafc !important; text-transform: uppercase; color: #64748b !important; }
    }
</style>

<?php include $path . 'includes/footer.php'; ?>