<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// DEFINISI JALUR (PATH) OTOMATIS
// Jika variabel $path belum diset oleh halaman pemanggil, anggap di root ('')
$path = isset($path) ? $path : '';

// 1. Cek Login Global
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . $path . "login.php");
    exit;
}

// 2. Ambil Data Session
$role = $_SESSION['role'];
$full_name = $_SESSION['full_name'];
$branch = $_SESSION['branch'] ?? 'Nasional';
$user_initial = substr($full_name, 0, 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Petty Cash - PT Sigma Media Asia</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <!-- Script Global untuk Base URL di JS -->
    <script>
        const BASE_PATH = "<?php echo $path; ?>";
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- CONTAINER UTAMA -->
    <div class="flex flex-col h-screen overflow-hidden">
        
        <!-- TOP NAVBAR -->
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-30 relative shrink-0">
            <!-- Logo & Mobile Toggle -->
            <div class="flex items-center">
                <button id="mobile-menu-btn" class="md:hidden mr-4 text-slate-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center text-slate-800">
                    <i class="fas fa-coins text-blue-600 text-2xl mr-3"></i>
                    <span class="font-bold text-xl tracking-wide hidden sm:block">SIGMA CASH</span>
                    <span class="font-bold text-xl tracking-wide sm:hidden">SIGMA</span>
                </div>
            </div>

            <!-- Title (Desktop) -->
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2">
                <h1 class="text-lg font-semibold text-slate-600">Sistem Monitoring Keuangan</h1>
            </div>

            <!-- User Profile -->
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800"><?php echo htmlspecialchars($full_name); ?></p>
                    <p class="text-xs text-slate-500 font-semibold"><?php echo strtoupper($role); ?> - <?php echo htmlspecialchars($branch); ?></p>
                </div>
                <!-- Logout link menggunakan $path -->
                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200 shadow-sm cursor-pointer" onclick="window.location.href='<?php echo $path; ?>api/logout.php'">
                    <?php echo $user_initial; ?>
                </div>
            </div>
        </header>

        <!-- WRAPPER BAWAH -->
        <div class="flex flex-1 overflow-hidden">