<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sigma Cash System</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #fcfaff;
            background-image: radial-gradient(at 0% 0%, rgba(147, 51, 234, 0.05) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(79, 70, 229, 0.05) 0px, transparent 50%);
        }
        .login-card {
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <!-- Logo Area -->
        <div class="flex flex-col items-center mb-8">
           <div class="w-16 h-16 rounded-lg shadow-md overflow-hidden ">
                <img src="assets/logo/logosigma.png" alt="Sigma ERP Logo" class="w-full h-full object-cover">
            </div>
            <br>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">SIGMA<span class="text-purple-600">CASH</span></h1>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.3em] mt-1">Management System</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden login-card">
            <div class="p-10">
                <div class="mb-8">
                    <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-400 text-sm font-medium mt-1">Silakan masuk untuk mengelola petty cash.</p>
                </div>

                <form id="loginForm" class="space-y-6">
                    <!-- Input Username -->
                    <div class="space-y-2">
                        <label for="username" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-300 group-focus-within:text-purple-500 transition-colors">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text" id="username" name="username" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300"
                                placeholder="ID Pengguna">
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-300 group-focus-within:text-purple-500 transition-colors">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" id="btnSubmit"
                            class="w-full py-4 px-6 bg-purple-600 hover:bg-purple-700 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-purple-100 transition-all transform active:scale-[0.98] flex justify-center items-center gap-3">
                            Masuk ke Sistem
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Card -->
            <div class="px-10 py-6 bg-slate-50 border-t border-slate-100 text-center">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                    &copy; <?php echo date('Y'); ?> PT Sigma Media Asia
                </p>
            </div>
        </div>

     
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('btnSubmit');
            const originalText = btn.innerHTML;

            // Loading State Luxury
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin text-sm"></i> Authenticating...';

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('api/auth.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '<span class="font-black text-2xl tracking-tight">Login Berhasil</span>',
                        text: 'Mempersiapkan dashboard Anda...',
                        timer: 1500,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-[2rem] border-none shadow-2xl',
                        }
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<span class="font-black text-xl text-rose-600">Akses Ditolak</span>',
                        text: result.message || 'Username atau password tidak ditemukan.',
                        confirmButtonColor: '#9333ea',
                        customClass: {
                            popup: 'rounded-[2rem] border-none shadow-2xl',
                            confirmButton: 'rounded-xl px-8 py-2.5 font-bold uppercase tracking-widest text-[10px]'
                        }
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: 'Gagal terhubung ke server.',
                    confirmButtonColor: '#9333ea'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    </script>
</body>

</html>