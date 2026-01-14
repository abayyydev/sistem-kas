<?php
// includes/sidebar.php
// Gunakan $path yang didefinisikan di header.php atau file induk
$path = isset($path) ? $path : '';
?>
<!-- SIDEBAR -->
<aside id="sidebar-menu"
    class="w-64 bg-slate-900 text-white flex-col hidden md:flex shrink-0 transition-all duration-300 h-full absolute md:relative z-40">

    <!-- Status Login -->
    <div class="p-4 bg-slate-800 border-b border-slate-700">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Status</p>
        <div class="flex items-center text-green-400 text-sm font-medium">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Online
        </div>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto no-scrollbar">

        <p class="px-4 text-xs font-semibold text-slate-500 mt-2 mb-2 uppercase tracking-wider">Utama</p>
        <!-- Link Dashboard -->
        <a href="<?php echo $path; ?>index.php"
            class="flex items-center px-4 py-3 bg-slate-800 hover:bg-blue-600 rounded-lg text-white transition-all">
            <i class="fas fa-home w-5 text-center mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Role: PJ GUDANG & ADMIN -->
        <?php if ($role == 'pj_gudang' || $role == 'admin'): ?>
            <p class="px-4 text-xs font-semibold text-slate-500 mt-6 mb-2 uppercase tracking-wider">Transaksi</p>

            <!-- Link ke Views/Admin -->
            <a href="<?php echo $path; ?>views/admin/input_transaksi.php"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fas fa-plus-circle w-5 text-center mr-3"></i>
                <span>Input Baru</span>
            </a>
            <!-- Contoh jika ada riwayat -->
            <!-- <a href="<?php echo $path; ?>views/admin/riwayat.php" ... > -->
        <?php endif; ?>

        <!-- Role: TUP & ADMIN -->
        <?php if ($role == 'tup' || $role == 'admin'): ?>
            <p class="px-4 text-xs font-semibold text-slate-500 mt-6 mb-2 uppercase tracking-wider">Audit</p>
            <a href="<?php echo $path; ?>views/tup/audit.php"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fas fa-check-double w-5 text-center mr-3"></i>
                <span>Audit Data</span>
            </a>
        <?php endif; ?>

        <!-- Role: PIMPINAN & ADMIN -->
        <p class="px-4 text-xs font-semibold text-slate-500 mt-6 mb-2 uppercase tracking-wider">Laporan</p>
        <a href="<?php echo $path; ?>views/pimpinan/laporan.php"
            class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
            <i class="fas fa-file-invoice-dollar w-5 text-center mr-3"></i>
            <span>Laporan Keuangan</span>
        </a>

        <!-- Role: ADMIN -->
        <?php if ($role == 'admin'): ?>
            <p class="px-4 text-xs font-semibold text-slate-500 mt-6 mb-2 uppercase tracking-wider">Admin</p>
            <a href="<?php echo $path; ?>views/admin/users.php"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fas fa-users-cog w-5 text-center mr-3"></i>
                <span>Kelola User</span>
            </a>
            <a href="<?php echo $path; ?>views/admin/master_data.php"
                class="flex items-center px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <i class="fas fa-database w-5 text-center mr-3"></i>
                <span>Master Data</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-slate-700 bg-slate-900">
        <a href="<?php echo $path; ?>api/logout.php" onclick="return confirm('Yakin ingin keluar?')"
            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-red-400 bg-slate-800/50 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
        </a>
    </div>
</aside>