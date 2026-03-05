<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/tup/
$path = '../../'; 
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Role: Hanya TUP dan Admin
if ($role !== 'tup' && $role !== 'admin') {
    echo "<script>window.location.href = '" . $path . "index.php';</script>";
    exit;
}
?>

<!-- BACKDROP OVERLAY (Mobile Only) -->
<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar relative">
    
    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo $path; ?>index.php" class="hover:text-purple-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-purple-600">Audit & Verifikasi</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Validasi Transaksi</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Audit setiap entri kas masuk dan keluar untuk akurasi finansial.</p>
        </div>
        
        <!-- INDIKATOR LIVE -->
        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-200">
            <div class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-600"></span>
            </div>
            <span class="text-xs font-black text-slate-600 uppercase tracking-widest">Sesi Audit Aktif</span>
        </div>
    </div>

    <!-- TABEL AUDIT CONTAINER -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/30">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <tr>
                            <th class="px-8 py-5">Waktu Entri</th>
                            <th class="px-8 py-5">Asal Cabang / PJ</th>
                            <th class="px-8 py-5">Kategori & Keterangan</th>
                            <th class="px-8 py-5 text-right">Nominal</th>
                            <th class="px-8 py-5 text-center">Lampiran</th>
                            <th class="px-8 py-5 text-center">Keputusan Audit</th>
                        </tr>
                    </thead>
                    <tbody id="audit-table-body" class="divide-y divide-slate-50">
                        <tr id="loading-row">
                            <td colspan="6" class="text-center py-20">
                                <div class="flex flex-col items-center justify-center opacity-30">
                                    <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
                                    <p class="font-bold uppercase tracking-widest text-[10px]">Sinkronisasi Transaksi Baru...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="empty-state" class="hidden flex flex-col items-center justify-center py-20 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                    <i class="fa-solid fa-clipboard-list text-3xl text-slate-200"></i>
                </div>
                <h3 class="text-lg font-black text-slate-700">Semua Data Telah Ter-Audit</h3>
                <p class="text-slate-400 text-xs font-medium max-w-xs mt-1">Belum ada transaksi baru yang masuk dalam antrean verifikasi.</p>
            </div>
        </div>

        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-8 mb-10 text-center italic">
            <i class="fa-solid fa-circle-info text-purple-400 mr-2"></i> 
            Klik pada tombol bukti untuk meninjau struk asli sebelum melakukan verifikasi.
        </p>
    </div>
</main>

<script>
    const apiUrl = BASE_PATH + 'api/audit.php';
    const uploadsUrl = BASE_PATH + 'assets/uploads/';

    // --- RESPONSIVE SIDEBAR LOGIC ---
   

    // --- AUDIT DATA LOGIC ---
    const loadAuditData = async () => {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            
            const tbody = document.getElementById('audit-table-body');
            const emptyState = document.getElementById('empty-state');
            tbody.innerHTML = ''; 

            if (result.success && result.data.length > 0) {
                emptyState.classList.add('hidden');
                
                result.data.forEach(item => {
                    const isZakat = item.is_zakat == 1 ? 
                        '<span class="ml-2 px-2 py-0.5 rounded-md text-[9px] font-black bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-tighter">Zakat</span>' : '';
                    
                    const typeColor = item.type === 'in' ? 'text-emerald-600' : 'text-rose-600';
                    const typeIcon = item.type === 'in' ? '+' : '-';

                    let rowClass = 'group transition-all hover:bg-purple-50/20';
                    let actionHtml = '';

                    if (item.status === 'pending') {
                        actionHtml = `
                            <div class="flex justify-center items-center gap-2">
                                <button onclick="processAudit(${item.id}, 'verify')" 
                                    class="w-9 h-9 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm active:scale-90 flex items-center justify-center" 
                                    title="Setujui Transaksi">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button onclick="processAudit(${item.id}, 'reject')" 
                                    class="w-9 h-9 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm active:scale-90 flex items-center justify-center" 
                                    title="Tolak Transaksi">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        `;
                    } else if (item.status === 'verified') {
                        rowClass = 'bg-slate-50/50 opacity-60';
                        actionHtml = `
                            <div class="flex items-center justify-center gap-1 text-emerald-600 font-black text-[10px] uppercase tracking-widest bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">
                                <i class="fa-solid fa-circle-check"></i> Verified
                            </div>
                        `;
                    } else {
                        rowClass = 'bg-rose-50/20 opacity-60';
                        actionHtml = `
                            <div class="flex items-center justify-center gap-1 text-rose-600 font-black text-[10px] uppercase tracking-widest bg-rose-50 px-3 py-1.5 rounded-full border border-rose-100">
                                <i class="fa-solid fa-circle-xmark"></i> Rejected
                            </div>
                        `;
                    }

                    tbody.innerHTML += `
                        <tr class="${rowClass}">
                            <td class="px-8 py-5">
                                <div class="flex flex-col leading-tight">
                                    <span class="font-bold text-slate-800">${item.date.split('-')[2]}</span>
                                    <span class="text-[10px] text-slate-400 font-black uppercase tracking-tighter">${item.date.split('-')[1]}/${item.date.split('-')[0]}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="font-bold text-slate-700 tracking-tight">${item.branch}</div>
                                <div class="text-[10px] font-bold text-purple-400 uppercase tracking-wide mt-0.5 italic">${item.pic_name}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center font-bold text-slate-800 text-xs">
                                    ${item.category} ${isZakat}
                                </div>
                                <div class="text-[11px] text-slate-400 font-medium mt-1 truncate max-w-[200px]" title="${item.description}">${item.description}</div>
                            </td>
                            <td class="px-8 py-5 text-right font-black text-[14px] tracking-tight ${typeColor}">
                                ${typeIcon} ${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(item.amount)}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <button onclick="viewProof('${item.proof_file}')" 
                                    class="mx-auto flex items-center justify-center gap-2 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-purple-600 hover:border-purple-200 transition-all shadow-sm">
                                    <i class="fa-solid fa-image"></i> Bukti
                                </button>
                            </td>
                            <td class="px-8 py-5 text-center">
                                ${actionHtml}
                            </td>
                        </tr>
                    `;
                });
            } else {
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            console.error(error);
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-10 font-bold text-rose-500 italic">Gagal menyambungkan ke pusat data.</td></tr>';
        }
    };

    window.viewProof = (fileName) => {
        const url = uploadsUrl + fileName;
        Swal.fire({
            imageUrl: url,
            imageAlt: 'Bukti Transaksi',
            title: '<span class="font-black text-lg tracking-tight uppercase">Pratinjau Bukti</span>',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#9333ea',
            width: '420px',
            padding: '1.5rem',
            customClass: {
                popup: 'rounded-[2rem] border-none shadow-2xl overflow-hidden',
                confirmButton: 'rounded-xl px-8 py-2.5 font-bold uppercase tracking-widest text-[10px]',
                image: 'rounded-2xl border border-slate-100 shadow-sm'
            },
            showClass: { popup: 'animate__animated animate__fadeInUp animate__faster' },
            hideClass: { popup: 'animate__animated animate__fadeOutDown animate__faster' }
        });
    };

    window.processAudit = (id, action) => {
        const isVerify = action === 'verify';
        let swalConfig = {
            title: `<span class="font-black text-2xl tracking-tight">${isVerify ? 'Konfirmasi Verifikasi?' : 'Tolak Transaksi?'}</span>`,
            text: isVerify ? 'Transaksi akan diposting dan saldo cabang akan diperbarui.' : 'Mohon berikan alasan penolakan untuk PJ Cabang.',
            icon: isVerify ? 'question' : 'warning',
            showCancelButton: true,
            confirmButtonColor: isVerify ? '#10b981' : '#ef4444',
            confirmButtonText: isVerify ? 'Ya, Verifikasi' : 'Ya, Tolak',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[2.5rem] border-none shadow-2xl',
                confirmButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs',
                cancelButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs'
            }
        };

        if (!isVerify) {
            swalConfig.input = 'text';
            swalConfig.inputPlaceholder = 'Misal: Bukti struk tidak jelas...';
            swalConfig.inputValidator = (value) => { if (!value) return 'Alasan wajib diisi!'; };
        }

        Swal.fire(swalConfig).then(async (result) => {
            if (result.isConfirmed) {
                const payload = { id: id, action: action, reason: result.value || '' };
                try {
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(payload)
                    });
                    const res = await response.json();
                    if(res.success) {
                        Swal.fire({ icon: 'success', title: 'Status Diperbarui', timer: 1500, showConfirmButton: false, customClass: { popup: 'rounded-3xl' } });
                        loadAuditData();
                    } else {
                        Swal.fire('Gagal!', res.message, 'error');
                    }
                } catch (err) { Swal.fire('Error', 'Kegagalan sistem.', 'error'); }
            }
        });
    };

    document.addEventListener('DOMContentLoaded', loadAuditData);
</script>

<?php include $path . 'includes/footer.php'; ?>