<?php
$path = '../../';
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

if ($role !== 'admin') {
    echo "<script>window.location.href = '" . $path . "index.php';</script>";
    exit;
}
?>

<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">Master Data Sistem</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- 1. MANAJEMEN CABANG -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 h-fit">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="font-bold text-slate-700"><i class="fas fa-building mr-2"></i> Cabang</h3>
                    <button onclick="addBranch()"
                        class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded hover:bg-blue-200 font-bold">
                        + Tambah
                    </button>
                </div>
                <div class="overflow-y-auto max-h-60">
                    <table class="w-full text-sm text-left">
                        <tbody id="branch-list"></tbody>
                    </table>
                </div>
            </div>

            <!-- 2. MANAJEMEN GRUP KATEGORI (BARU) -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 h-fit">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="font-bold text-slate-700"><i class="fas fa-layer-group mr-2"></i> Grup Akun</h3>
                    <button onclick="addGroup()"
                        class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded hover:bg-purple-200 font-bold">
                        + Tambah
                    </button>
                </div>
                <div class="overflow-y-auto max-h-60">
                    <table class="w-full text-sm text-left">
                        <tbody id="group-list"></tbody>
                    </table>
                </div>
            </div>

            <!-- 3. MANAJEMEN KATEGORI -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 lg:col-span-1 h-fit">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="font-bold text-slate-700"><i class="fas fa-list mr-2"></i> Kategori Biaya</h3>
                    <button onclick="addCategory()"
                        class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded hover:bg-green-200 font-bold">
                        + Tambah
                    </button>
                </div>
                <div class="overflow-y-auto max-h-[500px]">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 font-bold text-xs">
                            <tr>
                                <th class="p-2">Grup</th>
                                <th class="p-2">Nama</th>
                                <th class="p-2 text-center">Zakat</th>
                                <th class="p-2 text-right">#</th>
                            </tr>
                        </thead>
                        <tbody id="category-list"></tbody>
                    </table>
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
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-2">${b.name}</td>
                    <td class="p-2 text-right">
                        <button onclick="deleteData('branches', ${b.id}, loadBranches)" class="text-red-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>`;
        });
    }

    async function addBranch() {
        const { value: name } = await Swal.fire({ title: 'Tambah Cabang', input: 'text', showCancelButton: true });
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
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-2 font-medium text-purple-700">${g.name}</td>
                    <td class="p-2 text-right">
                        <button onclick="deleteData('groups', ${g.id}, loadGroups)" class="text-red-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>`;
        });
    }

    async function addGroup() {
        const { value: name } = await Swal.fire({ title: 'Tambah Grup Baru', input: 'text', showCancelButton: true });
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
            const zakat = c.is_zakat == 1 ? '<i class="fas fa-check text-green-500"></i>' : '';
            tbody.innerHTML += `
                <tr class="border-b hover:bg-slate-50">
                    <td class="p-2 text-xs text-slate-400 uppercase font-bold">${c.group_name}</td>
                    <td class="p-2">${c.name}</td>
                    <td class="p-2 text-center text-xs">${zakat}</td>
                    <td class="p-2 text-right">
                        <button onclick="deleteData('categories', ${c.id}, loadCategories)" class="text-red-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>`;
        });
    }

    // Helper: Get Groups for Dropdown
    async function getGroupOptions() {
        const res = await fetch(BASE_PATH + 'api/groups.php');
        const json = await res.json();
        return json.data.map(g => `<option value="${g.id}">${g.name}</option>`).join('');
    }

    async function addCategory() {
        const groupOptions = await getGroupOptions();

        const { value: formValues } = await Swal.fire({
            title: 'Tambah Kategori',
            html:
                `<select id="swal-group-id" class="swal2-input bg-white"><option value="">-- Pilih Grup --</option>${groupOptions}</select>` +
                '<input id="swal-name" class="swal2-input" placeholder="Nama Kategori">' +
                '<div class="flex items-center justify-center mt-4"><input type="checkbox" id="swal-zakat" class="mr-2"> <label>Masuk Zakat?</label></div>',
            focusConfirm: false,
            preConfirm: () => {
                return {
                    group_id: document.getElementById('swal-group-id').value,
                    name: document.getElementById('swal-name').value,
                    is_zakat: document.getElementById('swal-zakat').checked ? 1 : 0
                }
            }
        });

        if (formValues) {
            if (!formValues.group_id || !formValues.name) {
                Swal.fire('Error', 'Grup dan Nama wajib diisi', 'error');
                return;
            }
            await saveData('categories', formValues);
            loadCategories();
        }
    }

    // --- HELPER FETCH ---
    async function saveData(endpoint, data) {
        await fetch(BASE_PATH + 'api/' + endpoint + '.php', {
            method: 'POST',
            body: JSON.stringify(data)
        });
    }

    async function deleteData(endpoint, id, callback) {
        if (!confirm('Hapus data ini?')) return;
        const res = await fetch(BASE_PATH + 'api/' + endpoint + '.php', {
            method: 'DELETE',
            body: JSON.stringify({ id })
        });
        const json = await res.json();
        if (json.success) {
            callback();
        } else {
            Swal.fire('Gagal', json.message, 'error');
        }
    }

    // Init All
    loadBranches();
    loadGroups();
    loadCategories();
</script>

<?php include $path . 'includes/footer.php'; ?>