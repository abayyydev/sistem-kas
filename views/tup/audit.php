<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/tup/
$path = '../../'; 
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Role: TUP, Admin, dan Super Admin
if (!in_array($role, ['tup', 'admin', 'super_admin'])) {
    echo "<script>window.location.href = '" . $path . "index.php';</script>";
    exit;
}
?>

<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar relative">
    
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo $path; ?>index.php" class="hover:text-purple-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-purple-600">Audit & Verifikasi</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Validasi Transaksi</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Audit setiap entri kas masuk dan keluar untuk akurasi finansial.</p>
        </div>
        
        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-200">
            <div class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-600"></span>
            </div>
            <span class="text-xs font-black text-slate-600 uppercase tracking-widest">Sesi Audit Aktif</span>
        </div>
    </div>



    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/30 flex flex-col min-h-[400px]">
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <tr>
                            <th class="px-8 py-5 w-32">Waktu Entri</th>
                            <th class="px-8 py-5">Asal Cabang / PJ</th>
                            <th class="px-8 py-5">Kategori & Keterangan</th>
                            <th class="px-8 py-5 text-right">Nominal</th>
                            <th class="px-8 py-5 text-center">Lampiran</th>
                        </tr>
                    </thead>
                    <tbody id="audit-table-body" class="divide-y divide-slate-50">
                        <tr id="loading-row">
                            <td colspan="5" class="text-center py-20">
                                <div class="flex flex-col items-center justify-center opacity-30">
                                    <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
                                    <p class="font-bold uppercase tracking-widest text-[10px]">Sinkronisasi Transaksi...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div id="empty-state" class="hidden flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                        <i class="fa-solid fa-clipboard-list text-3xl text-slate-200"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-700">Tidak Ada Transaksi</h3>
                    <p class="text-slate-400 text-xs font-medium max-w-xs mt-1">Data dengan kriteria tersebut saat ini kosong.</p>
                </div>
            </div>
            
            <div id="pagination-container" class="px-8 py-4 border-t border-slate-50 bg-slate-50/10 flex items-center justify-between print:hidden">
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

    // Variabel Global
    let allAuditData = [];
    let filteredAuditData = [];
    let currentPage = 1;
    const rowsPerPage = 10;

    // --- 1. AMBIL DATA DARI SERVER ---
    const loadAuditData = async () => {
        const tbody = document.getElementById('audit-table-body');
        const emptyState = document.getElementById('empty-state');
        document.getElementById('pagination-container').innerHTML = '';
        
        tbody.innerHTML = `
            <tr id="loading-row">
                <td colspan="5" class="text-center py-20">
                    <div class="flex flex-col items-center justify-center opacity-30">
                        <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
                        <p class="font-bold uppercase tracking-widest text-[10px]">Sinkronisasi Transaksi...</p>
                    </div>
                </td>
            </tr>
        `;
        emptyState.classList.add('hidden');

        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            
            if (result.success) {
                allAuditData = result.data || [];
                applyFilter(); // Terapkan filter setelah data diload
            } else {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-rose-500 italic">Gagal mengambil data dari server.</td></tr>';
            }
        } catch (error) {
            console.error(error);
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-rose-500 italic">Gagal menyambungkan ke pusat data.</td></tr>';
        }
    };

    // --- 2. TERAPKAN FILTER ---
    window.applyFilter = () => {
        filteredAuditData = [...allAuditData];
        currentPage = 1; // Reset ke halaman pertama setiap kali filter diganti
        renderTable();
    };

    // --- 3. RENDER TABEL & PAGINATION ---
    const renderTable = () => {
        const tbody = document.getElementById('audit-table-body');
        const emptyState = document.getElementById('empty-state');
        
        tbody.innerHTML = '';
        
        if (filteredAuditData.length === 0) {
            emptyState.classList.remove('hidden');
            document.getElementById('pagination-container').innerHTML = '';
            return;
        }
        
        emptyState.classList.add('hidden');

        // Tentukan Index Data untuk Pagination
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedItems = filteredAuditData.slice(startIndex, endIndex);

        paginatedItems.forEach(item => {
            const isZakat = item.is_zakat == 1 ? 
                '<span class="ml-2 px-2 py-0.5 rounded-md text-[9px] font-black bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-tighter">Zakat</span>' : '';
            
            const typeColor = item.type === 'in' ? 'text-emerald-600' : 'text-rose-600';
            const typeIcon = item.type === 'in' ? '+' : '-';

            let rowClass = 'group transition-all hover:bg-purple-50/20';

            // Validasi file bukti (jika tidak ada file)
            const proofBtn = item.proof_file ? 
                `<button onclick="viewProof('${item.proof_file}')" class="mx-auto flex items-center justify-center gap-2 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-purple-600 hover:border-purple-200 transition-all shadow-sm">
                    <i class="fa-solid fa-image"></i> Bukti
                </button>` : 
                `<span class="text-[10px] text-slate-300 font-bold italic uppercase tracking-wider">Tanpa Bukti</span>`;

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
                        ${proofBtn}
                    </td>
                </tr>
            `;
        });

        renderPagination();
    };

    // --- 4. RENDER TOMBOL NAVIGASI PAGINATION ---
    const renderPagination = () => {
        const totalPages = Math.ceil(filteredAuditData.length / rowsPerPage);
        const container = document.getElementById('pagination-container');
        
        if (totalPages <= 1) {
            container.innerHTML = `<div class="text-xs font-bold text-slate-400">Menampilkan semua ${filteredAuditData.length} data</div>`;
            return;
        }

        let paginationHTML = `<div class="text-xs font-bold text-slate-400">Halaman ${currentPage} dari ${totalPages} <span class="hidden sm:inline">(${filteredAuditData.length} Data)</span></div>`;
        paginationHTML += `<div class="flex items-center gap-1">`;

        // Tombol Prev
        paginationHTML += `<button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 disabled:opacity-30 disabled:cursor-not-allowed transition-all"><i class="fa-solid fa-chevron-left text-xs"></i></button>`;

        // Nomor Halaman
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                if (i === currentPage) {
                    paginationHTML += `<button class="w-8 h-8 rounded-lg bg-purple-600 text-white font-bold text-xs shadow-md">${i}</button>`;
                } else {
                    paginationHTML += `<button onclick="changePage(${i})" class="w-8 h-8 rounded-lg text-slate-600 font-bold text-xs hover:bg-purple-50 hover:text-purple-600 transition-colors">${i}</button>`;
                }
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                paginationHTML += `<span class="text-slate-300 text-xs">...</span>`;
            }
        }

        // Tombol Next
        paginationHTML += `<button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 disabled:opacity-30 disabled:cursor-not-allowed transition-all"><i class="fa-solid fa-chevron-right text-xs"></i></button>`;
        
        paginationHTML += `</div>`;
        container.innerHTML = paginationHTML;
    };

    // --- 5. FUNGSI GANTI HALAMAN ---
    window.changePage = (pageNumber) => {
        const totalPages = Math.ceil(filteredAuditData.length / rowsPerPage);
        if (pageNumber < 1 || pageNumber > totalPages) return;
        currentPage = pageNumber;
        renderTable();
    };

    // --- LAINNYA: POPUP BUKTI & AKSI ---
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

    // INIT
    document.addEventListener('DOMContentLoaded', loadAuditData);
</script>

<?php include $path . 'includes/footer.php'; ?>