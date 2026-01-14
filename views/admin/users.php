<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek Security Extra (Hanya Admin)
if ($role !== 'admin') {
    echo "<script>
            alert('Akses Ditolak!');
            window.location.href = '" . $path . "index.php';
          </script>";
    exit;
}
?>

<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h2>
                <p class="text-slate-500 text-sm">Kelola akun akses untuk PJ Cabang, TUP, dan Pimpinan.</p>
            </div>
            <button onclick="openAddModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-500/30 flex items-center text-sm font-medium transition-transform active:scale-95">
                <i class="fas fa-user-plus mr-2"></i> Tambah User Baru
            </button>
        </div>

        <!-- Tabel User -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                            <th class="px-6 py-4 font-bold">Username</th>
                            <th class="px-6 py-4 font-bold">Role</th>
                            <th class="px-6 py-4 font-bold">Cabang</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <!-- Data loaded via JS -->
                        <tr>
                            <td colspan="5" class="text-center py-8"><i class="fas fa-spinner fa-spin"></i> Loading...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    const apiUrl = BASE_PATH + 'api/users.php';
    const apiBranches = BASE_PATH + 'api/branches.php';

    // 1. Load Data User
    const loadUsers = async () => {
        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            const tbody = document.getElementById('user-table-body');
            tbody.innerHTML = '';

            if (result.success) {
                result.data.forEach(user => {
                    // Badge Role
                    let roleBadge = '';
                    if (user.role === 'admin') roleBadge = '<span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-xs font-bold">Admin</span>';
                    else if (user.role === 'tup') roleBadge = '<span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs font-bold">TUP</span>';
                    else if (user.role === 'pj_gudang') roleBadge = '<span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold">PJ Gudang</span>';
                    else roleBadge = '<span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs font-bold">Pimpinan</span>';

                    const row = `
                        <tr class="border-b hover:bg-slate-50">
                            <td class="px-6 py-4 font-semibold text-slate-800">${user.full_name}</td>
                            <td class="px-6 py-4 font-mono text-xs">${user.username}</td>
                            <td class="px-6 py-4">${roleBadge}</td>
                            <td class="px-6 py-4 text-slate-500">${user.branch || '-'}</td>
                            <td class="px-6 py-4 text-center">
                                ${user.role !== 'admin' ?
                            `<button onclick="deleteUser(${user.id}, '${user.username}')" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded transition" title="Hapus User">
                                    <i class="fas fa-trash-alt"></i>
                                </button>` :
                            '<span class="text-gray-300 text-xs italic">Protected</span>'}
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }
        } catch (error) {
            console.error(error);
            document.getElementById('user-table-body').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>';
        }
    };

    // Helper: Ambil Opsi Cabang dari Database
    const getBranchOptions = async () => {
        try {
            const response = await fetch(apiBranches);
            const res = await response.json();
            if (res.success && res.data.length > 0) {
                return res.data.map(b => `<option value="${b.name}">${b.name}</option>`).join('');
            }
            return '<option value="" disabled>Belum ada cabang (Buat di Master Data)</option>';
        } catch (e) {
            return '<option value="">Error loading branches</option>';
        }
    };

    // 2. Tambah User (SweetAlert Form)
    window.openAddModal = async () => {
        // Fetch dulu data cabang agar dropdown terisi
        const branchOptionsHtml = await getBranchOptions();

        Swal.fire({
            title: 'Tambah User Baru',
            html: `
                <div class="text-left space-y-3">
                    <div>
                        <label class="block text-xs font-bold mb-1 text-slate-600">Username (Login)</label>
                        <input id="swal-username" class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: pj_semarang">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1 text-slate-600">Password</label>
                        <input id="swal-password" type="password" class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="******">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1 text-slate-600">Nama Lengkap</label>
                        <input id="swal-fullname" class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Bambang Pamungkas">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold mb-1 text-slate-600">Role</label>
                            <select id="swal-role" class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                                <option value="pj_gudang">PJ Gudang</option>
                                <option value="tup">TUP (Audit)</option>
                                <option value="pimpinan">Pimpinan</option>
                                <option value="admin">Admin IT</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-1 text-slate-600">Cabang</label>
                            <select id="swal-branch" class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                                <option value="">-- Pilih Cabang --</option>
                                ${branchOptionsHtml}
                            </select>
                            <p class="text-[10px] text-slate-400 mt-1">*Ambil dari Master Data</p>
                        </div>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-save mr-1"></i> Simpan User',
            confirmButtonColor: '#2563eb',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
                return {
                    username: document.getElementById('swal-username').value,
                    password: document.getElementById('swal-password').value,
                    full_name: document.getElementById('swal-fullname').value,
                    role: document.getElementById('swal-role').value,
                    branch: document.getElementById('swal-branch').value
                }
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const data = result.value;

                // Validasi Sederhana
                if (!data.username || !data.password || !data.full_name) {
                    Swal.fire('Gagal', 'Username, Password, dan Nama Lengkap wajib diisi!', 'warning');
                    return;
                }

                try {
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });
                    const res = await response.json();

                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'User baru telah ditambahkan.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        loadUsers();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Koneksi server bermasalah', 'error');
                }
            }
        });
    };

    // 3. Hapus User
    window.deleteUser = (id, name) => {
        Swal.fire({
            title: 'Hapus User?',
            text: `Yakin ingin menghapus akun "${name}"? Data ini tidak bisa dikembalikan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#cbd5e1',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
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
                        Swal.fire('Terhapus!', 'User telah dihapus.', 'success');
                        loadUsers();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Koneksi server bermasalah', 'error');
                }
            }
        });
    };

    // Init Load
    document.addEventListener('DOMContentLoaded', loadUsers);
</script>

<?php include $path . 'includes/footer.php'; ?>