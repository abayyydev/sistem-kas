<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Security Extra (Hanya Admin)
if ($role !== 'admin') {
    echo "<script>
            window.location.href = '" . $path . "index.php';
          </script>";
    exit;
}
?>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar">

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo $path; ?>index.php" class="hover:text-purple-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-purple-600">Manajemen Pengguna</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Kelola hak akses akun PJ Cabang, TUP (Audit), dan Pimpinan.</p>
        </div>
        
        <button onclick="openAddModal()"
            class="bg-purple-600 text-white px-6 py-3 rounded-2xl hover:bg-purple-700 shadow-xl shadow-purple-100 flex items-center text-sm font-black uppercase tracking-widest transition-all active:scale-95 group">
            <i class="fa-solid fa-user-plus mr-3 group-hover:rotate-12 transition-transform"></i> Tambah User Baru
        </button>
    </div>

    <!-- TABEL USER CONTAINER -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <tr>
                            <th class="px-8 py-5">Nama Lengkap</th>
                            <th class="px-8 py-5">Username</th>
                            <th class="px-8 py-5">Role Akses</th>
                            <th class="px-8 py-5">Penempatan Cabang</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body" class="divide-y divide-slate-50">
                        <!-- Data loaded via JS -->
                        <tr>
                            <td colspan="5" class="text-center py-20">
                                <div class="flex flex-col items-center justify-center opacity-30">
                                    <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-4 text-purple-600"></i>
                                    <p class="font-bold uppercase tracking-widest text-[10px]">Menyiapkan Data Pengguna...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- INFO BOX -->
        <div class="mt-8 flex items-center justify-between px-6">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                <i class="fa-solid fa-shield-halved mr-2 text-purple-400"></i> 
                Semua password dienkripsi secara aman dalam sistem.
            </p>
        </div>
    </div>
</main>

<script>
    const apiUrl = BASE_PATH + 'api/users.php';
    const apiBranches = BASE_PATH + 'api/branches.php';

    // 1. Load Data User dengan UI Mewah
    const loadUsers = async () => {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            const tbody = document.getElementById('user-table-body');
            tbody.innerHTML = '';

            if (result.success) {
                result.data.forEach(user => {
                    // Badge Role Modern
                    let roleBadge = '';
                    const badgeClass = "px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border";
                    
                    if (user.role === 'admin') {
                        roleBadge = `<span class="${badgeClass} bg-purple-50 text-purple-600 border-purple-100">Administrator</span>`;
                    } else if (user.role === 'tup') {
                        roleBadge = `<span class="${badgeClass} bg-indigo-50 text-indigo-600 border-indigo-100">Audit TUP</span>`;
                    } else if (user.role === 'pj_gudang') {
                        roleBadge = `<span class="${badgeClass} bg-emerald-50 text-emerald-600 border-emerald-100">PJ Cabang</span>`;
                    } else {
                        roleBadge = `<span class="${badgeClass} bg-amber-50 text-amber-600 border-amber-100">Pimpinan</span>`;
                    }

                    const row = `
                        <tr class="group transition-all hover:bg-purple-50/30">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-purple-600 group-hover:text-white transition-all font-bold text-xs uppercase">
                                        ${user.full_name.substring(0, 1)}
                                    </div>
                                    <span class="font-bold text-slate-800 tracking-tight">${user.full_name}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="font-mono text-[11px] font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md border border-slate-100 group-hover:bg-white transition-colors">@${user.username}</span>
                            </td>
                            <td class="px-8 py-5">${roleBadge}</td>
                            <td class="px-8 py-5 font-semibold text-slate-500 italic">${user.branch || '—'}</td>
                            <td class="px-8 py-5 text-center">
                                ${user.role !== 'admin' ? `
                                    <button onclick="deleteUser(${user.id}, '${user.username}')" 
                                        class="w-10 h-10 rounded-xl text-slate-300 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90" 
                                        title="Hapus User">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                ` : `
                                    <div class="w-10 h-10 flex items-center justify-center text-slate-200" title="Sistem Dilindungi">
                                        <i class="fa-solid fa-lock text-xs"></i>
                                    </div>
                                `}
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }
        } catch (error) {
            console.error(error);
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-rose-500">Gagal sinkronisasi data pengguna.</td></tr>';
        }
    };

    // Helper: Ambil Opsi Cabang
    const getBranchOptions = async () => {
        try {
            const response = await fetch(apiBranches);
            const res = await response.json();
            if (res.success && res.data.length > 0) {
                return res.data.map(b => `<option value="${b.name}">${b.name}</option>`).join('');
            }
            return '<option value="" disabled>Belum ada cabang aktif</option>';
        } catch (e) {
            return '<option value="">Gagal memuat cabang</option>';
        }
    };

    // 2. Tambah User (Modal Modern)
    window.openAddModal = async () => {
        const branchOptionsHtml = await getBranchOptions();

        Swal.fire({
            title: '<span class="font-black text-2xl tracking-tight">Tambah User Baru</span>',
            html: `
                <div class="text-left space-y-4 px-4 py-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Username Login</label>
                            <input id="swal-username" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700" placeholder="Misal: pj_jakarta">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Password</label>
                            <input id="swal-password" type="password" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700" placeholder="******">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap Pengguna</label>
                        <input id="swal-fullname" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700" placeholder="Nama sesuai identitas">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Role Akses</label>
                            <select id="swal-role" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700 appearance-none bg-white">
                                <option value="pj_gudang">PJ Cabang (Input)</option>
                                <option value="tup">TUP (Audit Data)</option>
                                <option value="pimpinan">Pimpinan (Laporan)</option>
                                <option value="admin">Administrator IT</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Penempatan Cabang</label>
                            <select id="swal-branch" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700 appearance-none bg-white">
                                <option value="">-- Pilih Cabang --</option>
                                ${branchOptionsHtml}
                            </select>
                        </div>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan Akun',
            confirmButtonColor: '#9333ea',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[2.5rem] border-none shadow-2xl overflow-hidden',
                confirmButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs',
                cancelButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs'
            },
            preConfirm: () => {
                const username = document.getElementById('swal-username').value;
                const password = document.getElementById('swal-password').value;
                const full_name = document.getElementById('swal-fullname').value;
                if (!username || !password || !full_name) {
                    Swal.showValidationMessage('Mohon lengkapi Username, Password, dan Nama Lengkap');
                    return false;
                }
                return {
                    username: username,
                    password: password,
                    full_name: full_name,
                    role: document.getElementById('swal-role').value,
                    branch: document.getElementById('swal-branch').value
                }
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(result.value)
                    });
                    const res = await response.json();

                    if (res.success) {
                        Swal.fire({ icon: 'success', title: 'User Berhasil Ditambahkan', showConfirmButton: false, timer: 1500, customClass: { popup: 'rounded-3xl' } });
                        loadUsers();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Terjadi gangguan pada server.', 'error');
                }
            }
        });
    };

    // 3. Hapus User dengan Konfirmasi Mewah
    window.deleteUser = (id, name) => {
        Swal.fire({
            title: 'Hapus Akun Pengguna?',
            text: `Akun "@${name}" akan dihapus permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus Akun',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-3xl' }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(apiUrl, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: id })
                    });
                    const res = await response.json();
                    if (res.success) {
                        Swal.fire({ icon: 'success', title: 'Dihapus', timer: 1000, showConfirmButton: false, customClass: { popup: 'rounded-3xl' } });
                        loadUsers();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Gangguan koneksi server.', 'error');
                }
            }
        });
    };

    // Init Load
    document.addEventListener('DOMContentLoaded', loadUsers);
</script>

<?php include $path . 'includes/footer.php'; ?>