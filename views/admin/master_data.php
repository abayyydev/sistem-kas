<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek akses: Hanya Admin yang boleh mengelola Master Data
if ($role !== 'admin') {
    echo "<script>window.location.href = '" . $path . "index.php';</script>";
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
                <span class="text-purple-600">Master Data</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pengaturan Master Data</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Kelola fondasi data sistem mulai dari cabang hingga kategori biaya.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm flex items-center gap-2 text-xs font-bold text-slate-500">
                <i class="fa-solid fa-database text-purple-500"></i>
                Database Status: <span class="text-green-500 uppercase">Synchronized</span>
            </div>
        </div>
    </div>

    <!-- GRID SISTEM MASTER -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- 1. MANAJEMEN CABANG -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-lg">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-gradient-to-r from-white to-purple-50/30">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                            <i class="fa-solid fa-building-circle-check text-lg"></i>
                        </div>
                        <h3 class="font-black text-slate-700 tracking-tight">Cabang</h3>
                    </div>
                    <button onclick="addBranch()" class="w-8 h-8 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center justify-center shadow-md shadow-purple-100 active:scale-90">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="overflow-y-auto max-h-72 pr-2 no-scrollbar">
                        <table class="w-full text-sm">
                            <tbody id="branch-list" class="divide-y divide-slate-50">
                                <!-- Data Cabang -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 2. MANAJEMEN GRUP KATEGORI -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-lg">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-gradient-to-r from-white to-purple-50/30">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                            <i class="fa-solid fa-layer-group text-lg"></i>
                        </div>
                        <h3 class="font-black text-slate-700 tracking-tight">Grup Akun</h3>
                    </div>
                    <button onclick="addGroup()" class="w-8 h-8 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all flex items-center justify-center shadow-md shadow-indigo-100 active:scale-90">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="overflow-y-auto max-h-72 pr-2 no-scrollbar">
                        <table class="w-full text-sm">
                            <tbody id="group-list" class="divide-y divide-slate-50">
                                <!-- Data Grup -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. MANAJEMEN KATEGORI (UTAMA) -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-lg">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-gradient-to-r from-white to-purple-50/20">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-purple-200">
                            <i class="fa-solid fa-list-check text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-800 text-lg leading-none">Kategori Biaya</h3>
                            <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-wider italic">Items & Zakat Mapping</p>
                        </div>
                    </div>
                    <button onclick="addCategory()" class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all font-black text-xs uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-purple-100 active:scale-95">
                        <i class="fa-solid fa-plus"></i> Tambah Baru
                    </button>
                </div>
                
                <div class="p-2">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                <tr>
                                    <th class="px-6 py-4">Grup Akun</th>
                                    <th class="px-6 py-4">Nama Kategori</th>
                                    <th class="px-6 py-4 text-center">Hitungan Zakat</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="category-list" class="divide-y divide-slate-50">
                                <!-- Data Kategori -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- INFO FOOTER -->
            <div class="mt-8 bg-purple-50 border border-purple-100 rounded-[1.5rem] p-6 flex items-start gap-4 transition-all hover:bg-purple-100/50">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-purple-600 shadow-sm shrink-0">
                    <i class="fa-solid fa-circle-info text-xl"></i>
                </div>
                <div>
                    <h4 class="text-purple-900 font-black text-sm uppercase tracking-tight">Informasi Master Data</h4>
                    <p class="text-purple-700/70 text-xs font-medium leading-relaxed mt-1">
                        Menghapus data master (Cabang/Grup/Kategori) tidak akan menghapus data transaksi yang sudah ada, namun disarankan untuk hanya menambah data baru demi menjaga integritas laporan historis.
                    </p>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    // --- 1. CABANG ---
    async function loadBranches() {
        const res = await fetch(BASE_PATH + 'api/branches.php');
        const json = await res.json();
        const tbody = document.getElementById('branch-list');
        tbody.innerHTML = '';
        json.data.forEach(b => {
            tbody.innerHTML += `
                <tr class="group transition-all hover:bg-slate-50">
                    <td class="px-4 py-4 font-bold text-slate-700 tracking-tight">${b.name}</td>
                    <td class="px-4 py-4 text-right">
                        <button onclick="deleteData('branches', ${b.id}, loadBranches)" class="w-8 h-8 rounded-lg text-slate-300 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>`;
        });
    }

    async function addBranch() {
        const { value: name } = await Swal.fire({ 
            title: 'Tambah Cabang', 
            input: 'text', 
            inputPlaceholder: 'Masukan nama cabang...',
            showCancelButton: true,
            confirmButtonColor: '#9333ea',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Simpan',
            customClass: { popup: 'rounded-[2rem] border-none shadow-2xl', input: 'rounded-xl' }
        });
        if (name) {
            await saveData('branches', { name });
            loadBranches();
        }
    }

    // --- 2. GRUP KATEGORI ---
    async function loadGroups() {
        const res = await fetch(BASE_PATH + 'api/groups.php');
        const json = await res.json();
        const tbody = document.getElementById('group-list');
        tbody.innerHTML = '';
        json.data.forEach(g => {
            tbody.innerHTML += `
                <tr class="group transition-all hover:bg-slate-50">
                    <td class="px-4 py-4 font-bold text-indigo-700 tracking-tight">${g.name}</td>
                    <td class="px-4 py-4 text-right">
                        <button onclick="deleteData('groups', ${g.id}, loadGroups)" class="w-8 h-8 rounded-lg text-slate-300 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>`;
        });
    }

    async function addGroup() {
        const { value: name } = await Swal.fire({ 
            title: 'Tambah Grup Akun', 
            input: 'text', 
            inputPlaceholder: 'Misal: Operasional, Inventaris...',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Simpan Grup',
            customClass: { popup: 'rounded-[2rem] border-none shadow-2xl', input: 'rounded-xl' }
        });
        if (name) {
            await saveData('groups', { name });
            loadGroups();
        }
    }

    // --- 3. KATEGORI ---
    async function loadCategories() {
        const res = await fetch(BASE_PATH + 'api/categories.php');
        const json = await res.json();
        const tbody = document.getElementById('category-list');
        tbody.innerHTML = '';
        json.data.forEach(c => {
            const zakatBadge = c.is_zakat == 1 
                ? '<span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-100">Wajib Zakat</span>' 
                : '<span class="text-slate-300">—</span>';
            
            tbody.innerHTML += `
                <tr class="group transition-all hover:bg-purple-50/30">
                    <td class="px-6 py-5">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 py-0.5 bg-slate-50 rounded-md border border-slate-100 group-hover:bg-white transition-colors">${c.group_name}</span>
                    </td>
                    <td class="px-6 py-5 font-bold text-slate-800">${c.name}</td>
                    <td class="px-6 py-5 text-center">${zakatBadge}</td>
                    <td class="px-6 py-5 text-right">
                        <button onclick="deleteData('categories', ${c.id}, loadCategories)" class="w-9 h-9 rounded-xl text-slate-300 hover:text-rose-500 hover:bg-rose-50 transition-all active:scale-90">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>`;
        });
    }

    async function getGroupOptions() {
        const res = await fetch(BASE_PATH + 'api/groups.php');
        const json = await res.json();
        return json.data.map(g => `<option value="${g.id}">${g.name}</option>`).join('');
    }

    async function addCategory() {
        const groupOptions = await getGroupOptions();

        const { value: formValues } = await Swal.fire({
            title: 'Kategori Biaya Baru',
            html:
                `<div class="text-left space-y-4 px-4 py-2">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Grup Akun</label>
                        <select id="swal-group-id" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700">
                            <option value="">-- Pilih Grup --</option>${groupOptions}
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Kategori</label>
                        <input id="swal-name" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-500/10 outline-none font-semibold text-slate-700" placeholder="Misal: Biaya Listrik">
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                        <input type="checkbox" id="swal-zakat" class="w-5 h-5 text-purple-600 rounded-lg"> 
                        <div>
                            <label class="font-black text-sm text-slate-700 leading-tight block">Masuk Perhitungan Zakat</label>
                            <span class="text-[10px] text-amber-600 font-bold uppercase tracking-wide">Aset Produktif / Dana Wajib</span>
                        </div>
                    </div>
                </div>`,
            focusConfirm: false,
            confirmButtonColor: '#9333ea',
            confirmButtonText: 'Simpan Kategori',
            showCancelButton: true,
            customClass: { popup: 'rounded-[2.5rem] border-none shadow-2xl overflow-hidden' },
            preConfirm: () => {
                const group_id = document.getElementById('swal-group-id').value;
                const name = document.getElementById('swal-name').value;
                if (!group_id || !name) {
                    Swal.showValidationMessage('Semua data wajib diisi');
                    return false;
                }
                return {
                    group_id: group_id,
                    name: name,
                    is_zakat: document.getElementById('swal-zakat').checked ? 1 : 0
                }
            }
        });

        if (formValues) {
            await saveData('categories', formValues);
            loadCategories();
            Swal.fire({ icon: 'success', title: 'Tersimpan', showConfirmButton: false, timer: 1000, customClass: { popup: 'rounded-3xl' } });
        }
    }

    // --- HELPER FETCH ---
    async function saveData(endpoint, data) {
        await fetch(BASE_PATH + 'api/' + endpoint + '.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
    }

    async function deleteData(endpoint, id, callback) {
        const result = await Swal.fire({
            title: 'Hapus Data?',
            text: "Tindakan ini tidak dapat dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            customClass: { popup: 'rounded-3xl' }
        });

        if (!result.isConfirmed) return;

        const res = await fetch(BASE_PATH + 'api/' + endpoint + '.php', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });
        const json = await res.json();
        if (json.success) {
            callback();
            Swal.fire({ icon: 'success', title: 'Dihapus', timer: 1000, showConfirmButton: false, customClass: { popup: 'rounded-3xl' } });
        } else {
            Swal.fire('Gagal', json.message, 'error');
        }
    }

    // Init All
    document.addEventListener('DOMContentLoaded', () => {
        loadBranches();
        loadGroups();
        loadCategories();
    });
</script>

<?php include $path . 'includes/footer.php'; ?>