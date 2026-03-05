<?php
// includes/sidebar.php
$path = isset($path) ? $path : '';
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- OVERLAY BACKDROP (Hanya muncul di mobile saat menu aktif) -->
<div id="sidebar-overlay" 
    class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
</div>

<!-- SIDEBAR -->
<aside id="sidebar-menu"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-white flex flex-col transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:h-full border-r border-slate-200">

    <!-- BRAND HEADER (Hanya muncul di Mobile: md:hidden) -->
    <div class="px-8 py-7 flex items-center gap-3 border-b border-slate-50 shrink-0 md:hidden">
        <div class="w-8 h-8 rounded-lg shadow-md overflow-hidden">
                <img src="<?php echo $path; ?>assets/logo/logosigma.png"" alt="Sigma ERP Logo" class="w-full h-full object-cover">
            </div>
        <div class="flex flex-col leading-tight">
            <span class="font-black text-xl tracking-tight text-slate-800 uppercase">Sigma<span class="text-purple-600">Cash</span></span>
            <span class="text-[10px] font-black text-slate-300 tracking-[0.25em] uppercase">Media Asia</span>
        </div>
    </div>

    <!-- Navigation List (Scrollable Area) -->
    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto no-scrollbar pb-6">

        <div class="px-4 py-2 mt-2">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Menu Utama</span>
        </div>

        <!-- Dashboard Link -->
        <a href="<?php echo $path; ?>index.php"
            class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 <?php echo ($current_page == 'index.php') ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?>">
            <div class="w-8 flex justify-center">
                <i class="fa-solid fa-house-chimney text-[17px]"></i>
            </div>
            <span class="font-semibold text-[14px] ml-1">Dashboard</span>
            <?php if ($current_page == 'index.php'): ?>
                <div class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></div>
            <?php endif; ?>
        </a>

        <!-- Role: PJ GUDANG & ADMIN -->
        <?php if ($role == 'pj_gudang' || $role == 'admin'): ?>
            <div class="px-4 py-2 mt-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Transaksi</span>
            </div>

            <a href="<?php echo $path; ?>views/admin/input_transaksi.php"
                class="group flex items-center px-4 py-3 rounded-xl <?php echo (strpos($_SERVER['PHP_SELF'], 'input_transaksi.php') !== false) ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?> transition-all duration-200">
                <div class="w-8 flex justify-center">
                    <i class="fa-solid fa-circle-plus text-[17px]"></i>
                </div>
                <span class="font-semibold text-[14px] ml-1">Input Baru</span>
            </a>
        <?php endif; ?>

        <!-- Role: TUP & ADMIN -->
        <?php if ($role == 'tup' || $role == 'admin'): ?>
            <div class="px-4 py-2 mt-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Audit & Kontrol</span>
            </div>
            <a href="<?php echo $path; ?>views/tup/audit.php"
                class="group flex items-center px-4 py-3 rounded-xl <?php echo (strpos($_SERVER['PHP_SELF'], 'audit.php') !== false) ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?> transition-all duration-200">
                <div class="w-8 flex justify-center">
                    <i class="fa-solid fa-clipboard-check text-[18px]"></i>
                </div>
                <span class="font-semibold text-[14px] ml-1">Audit Data</span>
            </a>
        <?php endif; ?>

        <!-- Reports -->
        <div class="px-4 py-2 mt-6">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Laporan</span>
        </div>
        <a href="<?php echo $path; ?>views/pimpinan/laporan.php"
            class="group flex items-center px-4 py-3 rounded-xl <?php echo (strpos($_SERVER['PHP_SELF'], 'laporan.php') !== false) ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?> transition-all duration-200">
            <div class="w-8 flex justify-center">
                <i class="fa-solid fa-chart-line text-[17px]"></i>
            </div>
            <span class="font-semibold text-[14px] ml-1 text-slate-600 group-hover:text-purple-600">Laporan Keuangan</span>
        </a>

        <!-- Admin Settings -->
        <?php if ($role == 'admin'): ?>
            <div class="px-4 py-2 mt-6">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Pengaturan</span>
            </div>
            <a href="<?php echo $path; ?>views/admin/users.php"
                class="group flex items-center px-4 py-3 rounded-xl <?php echo (strpos($_SERVER['PHP_SELF'], 'users.php') !== false) ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?> transition-all duration-200">
                <div class="w-8 flex justify-center">
                    <i class="fa-solid fa-user-gear text-[17px]"></i>
                </div>
                <span class="font-semibold text-[14px] ml-1">Kelola User</span>
            </a>
            <a href="<?php echo $path; ?>views/admin/master_data.php"
                class="group flex items-center px-4 py-3 rounded-xl <?php echo (strpos($_SERVER['PHP_SELF'], 'master_data.php') !== false) ? 'bg-purple-600 text-white shadow-lg shadow-purple-100' : 'text-slate-500 hover:bg-purple-50 hover:text-purple-600'; ?> transition-all duration-200">
                <div class="w-8 flex justify-center">
                    <i class="fa-solid fa-layer-group text-[17px]"></i>
                </div>
                <span class="font-semibold text-[14px] ml-1">Master Data</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout Area -->
    <div class="p-6 border-t border-slate-100 shrink-0">
        <button onclick="handleLogout()"
            class="group flex items-center justify-center w-full px-4 py-3 text-[13px] font-bold text-red-500 bg-red-50 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300">
            <i class="fa-solid fa-arrow-right-from-bracket mr-2 group-hover:-translate-x-1 transition-transform"></i> 
            Keluar Sesi
        </button>
    </div>
</aside>

<script>
    const sidebar = document.getElementById('sidebar-menu');
    const overlay = document.getElementById('sidebar-overlay');
    const mobileBtn = document.getElementById('mobile-menu-btn');

    function toggleSidebar() {
        const isHidden = sidebar.classList.contains('-translate-x-full');
        
        if (isHidden) {
            // Tampilkan Sidebar
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('pointer-events-none', 'opacity-0');
            overlay.classList.add('opacity-100');
            document.body.style.overflow = 'hidden'; // Stop scroll body
        } else {
            // Sembunyikan Sidebar
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100');
            document.body.style.overflow = ''; // Enable scroll body
        }
    }

    // Event Listeners
    if (mobileBtn) {
        mobileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });
    }

    // Klik pada overlay untuk menutup sidebar
    overlay.addEventListener('click', toggleSidebar);

    // Logout Function
    function handleLogout() {
        Swal.fire({
            title: 'Keluar?',
            text: "Sesi Anda akan berakhir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9333ea',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-3xl border-none shadow-2xl',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo $path; ?>api/logout.php';
            }
        })
    }
</script>