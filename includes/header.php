<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path = isset($path) ? $path : '';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . $path . "login.php");
    exit;
}

$role = $_SESSION['role'];
$full_name = $_SESSION['full_name'];
$branch = $_SESSION['branch'] ?? 'Nasional';
$user_initial = strtoupper(substr($full_name, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigma Cash — Monitoring Keuangan</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#9333ea', // Purple 600
                        dark: '#0f172a',    // Slate 900
                    }
                }
            }
        }
        const BASE_PATH = "<?php echo $path; ?>";
    </script>
    
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.8); }
    </style>
</head>
<body class="bg-[#fcfaff] text-slate-900 font-sans antialiased">

    <div class="flex flex-col h-screen overflow-hidden">
        
        <!-- TOP NAVBAR -->
        <header class="glass-effect h-16 flex items-center justify-between px-8 z-50 sticky top-0 shrink-0">
            <!-- Logo & Toggle -->
            <div class="flex items-center gap-4">
                <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-500 hover:bg-purple-50 rounded-full transition-all">
                    <i class="fa-solid fa-bars-staggered text-xl text-purple-600"></i>
                </button>
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="w-8 h-8 rounded-lg shadow-md overflow-hidden">
                        <img src="<?php echo $path; ?>assets/logo/logosigma.png" alt="Sigma ERP Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="font-bold text-lg tracking-tight text-slate-800">SIGMA<span class="text-purple-600">CASH</span></span>
                        <span class="text-[10px] font-medium text-slate-400 tracking-[0.2em] uppercase">Media Asia</span>
                    </div>
                </div>
            </div>

            <!-- Middle Title -->
            <div class="hidden lg:block">
                <div class="px-4 py-1.5 bg-purple-50 rounded-full text-[13px] font-medium text-purple-700 border border-purple-100">
                    <i class="fa-solid fa-circle-check text-purple-500 mr-2 text-[10px]"></i>
                    Financial Monitoring Dashboard
                </div>
            </div>

            <!-- User Profile & Actions -->
            <div class="flex items-center gap-5">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-sm font-semibold text-slate-800 tracking-tight"><?php echo htmlspecialchars($full_name); ?></span>
                    <span class="text-[11px] font-medium px-2 py-0.5 bg-purple-50 text-purple-600 rounded-md border border-purple-100 italic">
                        <?php echo $branch; ?>
                    </span>
                </div>
                
                <div class="relative group">
                    <button class="flex items-center focus:outline-none">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-purple-600 to-fuchsia-500 flex items-center justify-center text-white font-bold shadow-md shadow-purple-100 border-2 border-white transition-transform group-hover:rotate-3">
                            <?php echo $user_initial; ?>
                        </div>
                    </button>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">