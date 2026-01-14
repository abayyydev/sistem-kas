<?php
// views/tup/audit.php
$path = '../../'; // Mundur 2 folder ke root
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Role
if ($role !== 'tup' && $role !== 'admin') {
    echo "<script>window.location.href = '" . $path . "index.php';</script>";
    exit;
}
?>

<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Audit & Verifikasi Data</h2>
                <p class="text-slate-500 text-sm">Validasi transaksi masuk dari PJ Cabang.</p>
            </div>
            <!-- Indikator Live -->
            <div class="flex items-center space-x-2 bg-white px-3 py-1 rounded-full shadow-sm border border-slate-200">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                <span class="text-xs font-semibold text-slate-600">Mode Audit Aktif</span>
            </div>
        </div>

        <!-- Tabel Audit -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-bold">Tanggal</th>
                            <th class="px-6 py-4 font-bold">Cabang / PJ</th>
                            <th class="px-6 py-4 font-bold">Keterangan</th>
                            <th class="px-6 py-4 font-bold text-right">Nominal</th>
                            <th class="px-6 py-4 font-bold text-center">Bukti</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="audit-table-body">
                        <!-- Data akan di-load via JS -->
                        <tr id="loading-row">
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400">
                                <i class="fas fa-circle-notch fa-spin mr-2"></i> Memuat data transaksi...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- State Kosong (Hidden Default) -->
            <div id="empty-state" class="hidden flex flex-col items-center justify-center py-12 text-center">
                <div class="bg-green-50 p-4 rounded-full mb-3">
                    <i class="fas fa-check text-3xl text-green-500"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-700">Semua Beres!</h3>
                <p class="text-slate-500 text-sm">Tidak ada transaksi pending saat ini.</p>
            </div>
        </div>

    </div>
</main>

<script>
    const apiUrl = BASE_PATH + 'api/audit.php';
    const uploadsUrl = BASE_PATH + 'assets/uploads/';

    // 1. Fungsi Load Data
    const loadAuditData = async () => {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();

            const tbody = document.getElementById('audit-table-body');
            const emptyState = document.getElementById('empty-state');
            tbody.innerHTML = ''; // Clear loading

            if (result.success && result.data.length > 0) {
                emptyState.classList.add('hidden');

                result.data.forEach(item => {
                    const isZakat = item.is_zakat == 1 ? '<span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-100 text-yellow-700">ZAKAT</span>' : '';
                    const typeColor = item.type === 'in' ? 'text-green-600' : 'text-red-600';
                    const typeIcon = item.type === 'in' ? '+' : '-';

                    const row = `
                        <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-medium">${item.date}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">${item.branch}</div>
                                <div class="text-xs text-slate-400">${item.pic_name}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-700">${item.category} ${isZakat}</div>
                                <div class="text-xs text-slate-500 truncate max-w-xs" title="${item.description}">${item.description}</div>
                            </td>
                            <td class="px-6 py-4 text-right font-mono font-bold ${typeColor}">
                                ${typeIcon} ${formatRupiah(item.amount)}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="viewProof('${item.proof_file}')" class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center justify-center mx-auto space-x-1 border border-blue-200 px-2 py-1 rounded hover:bg-blue-50">
                                    <i class="fas fa-image"></i> <span>Lihat</span>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <button onclick="processAudit(${item.id}, 'verify')" class="bg-green-100 text-green-700 hover:bg-green-200 p-2 rounded-lg transition" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button onclick="processAudit(${item.id}, 'reject')" class="bg-red-100 text-red-700 hover:bg-red-200 p-2 rounded-lg transition" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            } else {
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            console.error(error);
            Swal.fire('Error', 'Gagal memuat data audit', 'error');
        }
    };

    // 2. Fungsi Lihat Bukti (SweetAlert Image)
    window.viewProof = (fileName) => {
        const url = uploadsUrl + fileName;
        Swal.fire({
            imageUrl: url,
            imageAlt: 'Bukti Transaksi',
            title: 'Bukti Transaksi',
            text: fileName,
            showCloseButton: true,
            confirmButtonText: 'Tutup',
            width: '600px'
        });
    };

    // 3. Fungsi Proses Audit (Verify/Reject)
    window.processAudit = (id, action) => {
        let title = action === 'verify' ? 'Setujui Transaksi?' : 'Tolak Transaksi?';
        let text = action === 'verify' ? 'Saldo kas akan terupdate otomatis.' : 'Data akan ditandai ditolak.';
        let btnColor = action === 'verify' ? '#22c55e' : '#ef4444';

        // Konfigurasi SweetAlert
        let swalConfig = {
            title: title,
            text: text,
            icon: action === 'verify' ? 'question' : 'warning',
            showCancelButton: true,
            confirmButtonColor: btnColor,
            confirmButtonText: action === 'verify' ? 'Ya, Setujui' : 'Ya, Tolak',
            cancelButtonText: 'Batal'
        };

        // Jika Reject, butuh input alasan
        if (action === 'reject') {
            swalConfig.input = 'text';
            swalConfig.inputPlaceholder = 'Masukkan alasan penolakan...';
            swalConfig.inputValidator = (value) => {
                if (!value) return 'Alasan wajib diisi!';
            };
        }

        Swal.fire(swalConfig).then(async (result) => {
            if (result.isConfirmed) {
                // Prepare Payload
                const payload = {
                    id: id,
                    action: action,
                    reason: result.value || '' // Alasan dari input reject
                };

                try {
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });

                    const res = await response.json();

                    if (res.success) {
                        Swal.fire('Berhasil!', res.message, 'success');
                        loadAuditData(); // Refresh tabel
                    } else {
                        Swal.fire('Gagal!', res.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Koneksi server bermasalah', 'error');
                }
            }
        });
    };

    // Init Load
    document.addEventListener('DOMContentLoaded', loadAuditData);

</script>

<?php include $path . 'includes/footer.php'; ?>