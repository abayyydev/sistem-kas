<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Security Extra (Hanya Super Admin)
if ($role !== 'super_admin') {
    echo "<script>
            window.location.href = '" . $path . "index.php';
          </script>";
    exit;
}
?>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar">

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
            <div id="pagination-container" class="px-8 py-4 border-t border-slate-50 bg-slate-50/10 flex items-center justify-between">
            </div>
        </div>

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
    
    // Simpan data user secara global agar mudah diakses saat edit
    let usersData = [];
    let currentPage = 1;
    const rowsPerPage = 10;

    // 1. Load Data User dengan UI Mewah
    const loadUsers = async () => {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            
            if (result.success) {
                usersData = result.data; // Simpan ke variabel global
                currentPage = 1; // Reset ke halaman 1 tiap kali load data
                renderTable();
            } else {
                document.getElementById('user-table-body').innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-rose-500">Gagal memuat data pengguna.</td></tr>';
            }
        } catch (error) {
            console.error(error);
            document.getElementById('user-table-body').innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-rose-500">Gagal sinkronisasi data pengguna.</td></tr>';
        }
    };

    const renderTable = () => {
        const tbody = document.getElementById('user-table-body');
        tbody.innerHTML = '';

        if (usersData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-10 font-bold text-slate-400">Belum ada data pengguna.</td></tr>';
            document.getElementById('pagination-container').innerHTML = '';
            return;
        }

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedItems = usersData.slice(startIndex, endIndex);

        paginatedItems.forEach(user => {
                    // Badge Role Modern
                    let roleBadge = '';
                    const badgeClass = "px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border";
                    
                    if (user.role === 'super_admin') {
                        roleBadge = `<span class="${badgeClass} bg-purple-50 text-purple-600 border-purple-100">Super Admin</span>`;
                    } else if (user.role === 'admin') {
                        roleBadge = `<span class="${badgeClass} bg-blue-50 text-blue-600 border-blue-100">Administrator</span>`;
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
                                ${user.role !== 'super_admin' ? `
                                    <div class="flex items-center justify-center gap-1">
                                        <button onclick="openEditModal(${user.id})" 
                                            class="w-8 h-8 rounded-lg text-slate-300 hover:text-blue-500 hover:bg-blue-50 transition-all active:scale-90" 
                                            title="Edit User">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button onclick="deleteUser(${user.id}, '${user.username}')" 
                                            class="w-8 h-8 rounded-lg text-slate-300 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90" 
                                            title="Hapus User">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                ` : `
                                    <div class="w-8 h-8 mx-auto flex items-center justify-center text-slate-200" title="Sistem Dilindungi">
                                        <i class="fa-solid fa-lock text-xs"></i>
                                    </div>
                                `}
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
        
        renderPagination();
    };

    const renderPagination = () => {
        const totalPages = Math.ceil(usersData.length / rowsPerPage);
        const container = document.getElementById('pagination-container');
        
        if (totalPages <= 1) {
            container.innerHTML = `<div class="text-xs font-bold text-slate-400">Menampilkan semua ${usersData.length} pengguna</div>`;
            return;
        }

        let paginationHTML = `<div class="text-xs font-bold text-slate-400">Halaman ${currentPage} dari ${totalPages} <span class="hidden sm:inline">(${usersData.length} Total)</span></div>`;
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

    window.changePage = (pageNumber) => {
        const totalPages = Math.ceil(usersData.length / rowsPerPage);
        if (pageNumber < 1 || pageNumber > totalPages) return;
        currentPage = pageNumber;
        renderTable();
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
                                <option value="admin">Administrator Biasa</option>
                                <option value="super_admin">Super Admin</option>
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

    // 3. Edit User (Modal Modern)
    window.openEditModal = async (id) => {
        const user = usersData.find(u => u.id == id);
        if (!user) return;

        const branchOptionsHtml = await getBranchOptions();
        
        const roleOptions = [
            { val: 'pj_gudang', label: 'PJ Cabang (Input)' },
            { val: 'tup', label: 'TUP (Audit Data)' },
            { val: 'pimpinan', label: 'Pimpinan (Laporan)' },
            { val: 'admin', label: 'Administrator Biasa' },
            { val: 'super_admin', label: 'Super Admin' }
        ].map(r => `<option value="${r.val}" ${user.role === r.val ? 'selected' : ''}>${r.label}</option>`).join('');

        // Helper untuk set branch yang sedang aktif
        const prefilledBranchOptions = branchOptionsHtml.replace(`value="${user.branch}"`, `value="${user.branch}" selected`);

        Swal.fire({
            title: '<span class="font-black text-2xl tracking-tight">Edit Data User</span>',
            html: `
                <div class="text-left space-y-4 px-4 py-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Username Login</label>
                            <input id="edit-username" value="${user.username}" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 outline-none font-semibold text-slate-700" placeholder="Misal: pj_jakarta">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Password Baru</label>
                            <input id="edit-password" type="password" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 outline-none font-semibold text-slate-700" placeholder="(Kosongkan jika sama)">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap Pengguna</label>
                        <input id="edit-fullname" value="${user.full_name}" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 outline-none font-semibold text-slate-700" placeholder="Nama sesuai identitas">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Role Akses</label>
                            <select id="edit-role" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 outline-none font-semibold text-slate-700 appearance-none bg-white">
                                ${roleOptions}
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Penempatan Cabang</label>
                            <select id="edit-branch" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 outline-none font-semibold text-slate-700 appearance-none bg-white">
                                <option value="">-- Pilih Cabang --</option>
                                ${prefilledBranchOptions}
                            </select>
                        </div>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan Perubahan',
            confirmButtonColor: '#3b82f6', // blue-500
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[2.5rem] border-none shadow-2xl overflow-hidden',
                confirmButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs',
                cancelButton: 'rounded-xl px-8 py-3 font-bold uppercase tracking-widest text-xs'
            },
            preConfirm: () => {
                const username = document.getElementById('edit-username').value;
                const password = document.getElementById('edit-password').value;
                const full_name = document.getElementById('edit-fullname').value;

                if (!username || !full_name) {
                    Swal.showValidationMessage('Mohon lengkapi Username dan Nama Lengkap');
                    return false;
                }

                const payload = {
                    id: id,
                    username: username,
                    full_name: full_name,
                    role: document.getElementById('edit-role').value,
                    branch: document.getElementById('edit-branch').value
                };

                // Hanya sertakan password jika admin mengetikkan yang baru
                if (password.trim() !== '') {
                    payload.password = password;
                }

                return payload;
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(apiUrl, {
                        method: 'PUT', // Menggunakan PUT untuk standar update
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(result.value)
                    });
                    const res = await response.json();

                    if (res.success) {
                        Swal.fire({ icon: 'success', title: 'Data Diperbarui', showConfirmButton: false, timer: 1500, customClass: { popup: 'rounded-3xl' } });
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

    // 4. Hapus User dengan Konfirmasi Mewah
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