<?php
// views/pimpinan/laporan.php
$path = '../../';
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';
?>

<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Laporan Keuangan</h2>
                <p class="text-slate-500 text-sm">Rekapitulasi arus kas dan perhitungan zakat.</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex space-x-2">
                <button onclick="window.print()"
                    class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50 text-sm font-medium flex items-center shadow-sm transition-colors">
                    <i class="fas fa-print mr-2"></i> Cetak PDF
                </button>
                <button onclick="exportExcel()"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm font-medium flex items-center shadow-sm shadow-green-200 transition-colors">
                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                </button>
            </div>
        </div>

        <!-- Filter Bar -->
        <div
            class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 mb-6 flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-auto">
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Bulan</label>
                <select id="filter-month"
                    class="w-full md:w-40 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:outline-none bg-white">
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
            <div class="w-full md:w-auto">
                <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Tahun</label>
                <select id="filter-year"
                    class="w-full md:w-32 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:outline-none bg-white">
                    <?php
                    $curr_year = date('Y');
                    for ($i = $curr_year; $i >= $curr_year - 2; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <?php if ($role !== 'pj_gudang'): ?>
                <div class="w-full md:w-auto">
                    <label class="block text-xs font-bold text-slate-500 mb-1 uppercase">Cabang</label>
                    <!-- Opsi diisi otomatis oleh JS -->
                    <select id="filter-branch"
                        class="w-full md:w-40 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="all">Semua Cabang</option>
                        <option disabled>Loading...</option>
                    </select>
                </div>
            <?php endif; ?>

            <button onclick="loadReport()"
                class="w-full md:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium transition-colors shadow-blue-500/30 shadow-lg">
                <i class="fas fa-filter mr-1"></i> Tampilkan
            </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                <p class="text-xs text-slate-400 font-bold uppercase">Total Pemasukan</p>
                <h3 id="sum-in" class="text-xl font-bold text-emerald-600">Rp 0</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                <p class="text-xs text-slate-400 font-bold uppercase">Total Pengeluaran</p>
                <h3 id="sum-out" class="text-xl font-bold text-red-600">Rp 0</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm bg-blue-50 border-blue-100">
                <p class="text-xs text-blue-400 font-bold uppercase">Selisih (Cashflow)</p>
                <h3 id="sum-bal" class="text-xl font-bold text-blue-700">Rp 0</h3>
            </div>
            <div class="bg-white p-4 rounded-xl border border-yellow-100 shadow-sm bg-yellow-50">
                <p class="text-xs text-yellow-600 font-bold uppercase">Akumulasi Zakat</p>
                <h3 id="sum-zakat" class="text-xl font-bold text-yellow-700">Rp 0</h3>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600" id="table-laporan">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">Tanggal</th>
                            <th class="px-6 py-3 font-bold">Cabang</th>
                            <th class="px-6 py-3 font-bold">Kategori</th>
                            <th class="px-6 py-3 font-bold">Keterangan</th>
                            <th class="px-6 py-3 font-bold text-right">Masuk</th>
                            <th class="px-6 py-3 font-bold text-right">Keluar</th>
                            <th class="px-6 py-3 font-bold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody id="report-body">
                        <!-- Data loaded by JS -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<script>
    // Set default month to current month
    document.getElementById('filter-month').value = new Date().toISOString().slice(5, 7);

    // 1. Load Data Cabang untuk Filter (Dinamis)
    const loadFilterBranches = async () => {
        const select = document.getElementById('filter-branch');
        if (!select) return; // Jika role PJ Gudang, elemen ini tidak ada

        try {
            const response = await fetch(BASE_PATH + 'api/branches.php');
            const result = await response.json();

            if (result.success) {
                // Reset dan set default "Semua Cabang"
                select.innerHTML = '<option value="all">Semua Cabang</option>';

                result.data.forEach(branch => {
                    const option = document.createElement('option');
                    option.value = branch.name;
                    option.textContent = branch.name;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading branches:', error);
            select.innerHTML = '<option value="all">Error memuat cabang</option>';
        }
    };

    // 2. Load Report Data
    const loadReport = async () => {
        const month = document.getElementById('filter-month').value;
        const year = document.getElementById('filter-year').value;
        let branch = 'all';

        const branchSelect = document.getElementById('filter-branch');
        if (branchSelect) branch = branchSelect.value;

        // Tampilkan Loading
        document.getElementById('report-body').innerHTML = `<tr><td colspan="7" class="text-center py-8"><i class="fas fa-spinner fa-spin mr-2"></i> Mengambil data...</td></tr>`;

        try {
            // Fetch Report API
            const url = `${BASE_PATH}api/report.php?month=${month}&year=${year}&branch=${branch}`;
            const response = await fetch(url);
            const result = await response.json();

            if (result.success) {
                // A. Update Summary Cards
                document.getElementById('sum-in').innerText = formatRupiah(result.data.summary.total_in);
                document.getElementById('sum-out').innerText = formatRupiah(result.data.summary.total_out);
                document.getElementById('sum-bal').innerText = formatRupiah(result.data.summary.balance);
                document.getElementById('sum-zakat').innerText = formatRupiah(result.data.summary.total_zakat);

                // B. Render Table Rows
                const tbody = document.getElementById('report-body');
                tbody.innerHTML = '';

                if (result.data.transactions.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-8 text-slate-400">Tidak ada data transaksi pada periode ini.</td></tr>`;
                    return;
                }

                result.data.transactions.forEach(trx => {
                    const masuk = trx.type === 'in' ? formatRupiah(trx.amount) : '-';
                    const keluar = trx.type === 'out' ? formatRupiah(trx.amount) : '-';
                    const zakatBadge = trx.is_zakat == 1 ? '<i class="fas fa-star text-yellow-500 ml-1" title="Zakat"></i>' : '';

                    let statusBadge = '';
                    if (trx.status === 'verified') statusBadge = '<span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-bold">Verified</span>';
                    else if (trx.status === 'pending') statusBadge = '<span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">Pending</span>';

                    const row = `
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3 whitespace-nowrap font-mono text-xs text-slate-500">${trx.date}</td>
                            <td class="px-6 py-3 font-semibold text-slate-700">${trx.branch}</td>
                            <td class="px-6 py-3 text-sm">
                                ${trx.category} ${zakatBadge}
                            </td>
                            <td class="px-6 py-3 truncate max-w-xs text-slate-500" title="${trx.description}">${trx.description}</td>
                            <td class="px-6 py-3 text-right font-mono text-emerald-600 font-medium">${masuk}</td>
                            <td class="px-6 py-3 text-right font-mono text-red-600 font-medium">${keluar}</td>
                            <td class="px-6 py-3 text-center">${statusBadge}</td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }
        } catch (error) {
            console.error(error);
            Swal.fire('Error', 'Gagal memuat laporan', 'error');
        }
    };

    // Fungsi Export Excel Sederhana
    const exportExcel = () => {
        let table = document.getElementById("table-laporan");
        let html = table.outerHTML.replace(/ /g, '%20');

        let a = document.createElement('a');
        a.href = 'data:application/vnd.ms-excel,' + html;
        a.download = 'Laporan_PettyCash_' + new Date().toISOString().slice(0, 10) + '.xls';
        a.click();
    }

    // Init Script
    document.addEventListener('DOMContentLoaded', () => {
        loadFilterBranches(); // Load opsi cabang dulu
        loadReport();         // Lalu load default report
    });
</script>

<!-- Style Khusus Print -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        main,
        main * {
            visibility: visible;
        }

        main {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        /* Sembunyikan elemen UI saat print */
        button,
        select,
        input,
        .bg-blue-50,
        .bg-yellow-50 {
            display: none !important;
        }

        /* Pastikan tabel terlihat jelas */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        thead {
            background-color: #f3f4f6 !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<?php include $path . 'includes/footer.php'; ?>