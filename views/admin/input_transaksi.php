<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek akses: Hanya PJ Gudang & Admin yang boleh masuk sini
if ($role !== 'pj_gudang' && $role !== 'admin') {
    echo "<script>
            alert('Akses Ditolak! Anda tidak memiliki izin input data.');
            window.location.href = '" . $path . "index.php';
          </script>";
    exit;
}
?>

<main class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">
    <div class="flex-1 overflow-y-auto p-6 md:p-8">

        <!-- Judul Halaman -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Input Transaksi Baru</h2>
                <p class="text-slate-500 text-sm">Silakan isi detail transaksi dengan teliti.</p>
            </div>
            <!-- Link Kembali menggunakan $path -->
            <a href="<?php echo $path; ?>index.php"
                class="text-slate-500 hover:text-blue-600 text-sm flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 max-w-3xl mx-auto">
            <div class="p-6 md:p-8">

                <form id="formTransaksi" enctype="multipart/form-data" class="space-y-6">

                    <!-- Grid 2 Kolom untuk Tanggal & Jenis -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tanggal -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Transaksi</label>
                            <input type="date" name="date" id="date" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Jenis Transaksi -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Transaksi</label>
                            <select name="type" id="type" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="out">Pengeluaran (Uang Keluar)</option>
                                <option value="in">Pemasukan / Top Up (Uang Masuk)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kategori (DINAMIS DARI DATABASE) -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori / Akun</label>
                        <select name="category" id="category" required 
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                            <!-- Opsi akan diisi otomatis oleh Javascript -->
                            <option value="">-- Sedang memuat kategori... --</option>
                        </select>
                    </div>

                    <!-- Nominal -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nominal (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-slate-500 font-bold">Rp</span>
                            <input type="number" name="amount" id="amount" required min="100" placeholder="0"
                                class="w-full pl-12 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-lg font-medium">
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Keterangan Detail</label>
                        <textarea name="description" id="description" rows="3" required placeholder="Contoh: Pembelian 2 rim kertas A4 untuk divisi marketing..."
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"></textarea>
                    </div>

                    <!-- Opsi Zakat -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-start transition-all hover:shadow-sm">
                        <div class="flex items-center h-5">
                            <input id="is_zakat" name="is_zakat" type="checkbox" value="1"
                                class="focus:ring-blue-500 h-5 w-5 text-blue-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_zakat" class="font-bold text-slate-700 cursor-pointer">Masuk Hitungan Zakat?</label>
                            <p class="text-slate-500 text-xs mt-1">Centang jika transaksi ini adalah pembelian aset produktif atau dana yang wajib dizakatkan.</p>
                        </div>
                    </div>

                    <!-- Upload Bukti -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Bukti Transaksi (Struk/Nota)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="proof_file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-slate-400 mb-2"></i>
                                    <p class="mb-1 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-slate-400">PNG, JPG, JPEG (Max. 2MB)</p>
                                    <p id="file-name" class="text-xs text-blue-600 font-bold mt-2"></p>
                                </div>
                                <input id="proof_file" name="proof_file" type="file" class="hidden" accept="image/*" required />
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                        <button type="reset" class="px-6 py-2 rounded-lg text-slate-600 hover:bg-slate-100 font-medium transition-colors">Reset</button>
                        <button type="submit" id="btnSubmit" class="px-8 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i> Simpan Transaksi
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</main>

<script>
    // 1. Set Default Date to Today
    document.getElementById('date').valueAsDate = new Date();

    // 2. Load Kategori Dinamis dari Database
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            // Panggil API Category
            const response = await fetch(BASE_PATH + 'api/categories.php');
            const result = await response.json();
            
            const select = document.getElementById('category');
            
            if (result.success && result.data.length > 0) {
                select.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                
                // Grouping Data berdasarkan group_name
                const groups = {};
                result.data.forEach(item => {
                    if (!groups[item.group_name]) {
                        groups[item.group_name] = [];
                    }
                    groups[item.group_name].push(item);
                });

                // Render Option ke HTML
                for (const [groupName, items] of Object.entries(groups)) {
                    const optgroup = document.createElement('optgroup');
                    optgroup.label = groupName;

                    items.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name; // Simpan Nama Kategori
                        option.textContent = item.name;
                        option.dataset.zakat = item.is_zakat; // Simpan status zakat (0/1) di atribut data
                        optgroup.appendChild(option);
                    });

                    select.appendChild(optgroup);
                }

                // Event Listener: Auto-Check Zakat
                select.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const isZakat = selectedOption.dataset.zakat == 1; // Cek apakah data-zakat bernilai 1
                    
                    const checkbox = document.getElementById('is_zakat');
                    checkbox.checked = isZakat;
                    
                    // Efek visual opsional (highlight checkbox)
                    if(isZakat) {
                        checkbox.parentElement.parentElement.classList.add('bg-yellow-100', 'border-yellow-300');
                    } else {
                        checkbox.parentElement.parentElement.classList.remove('bg-yellow-100', 'border-yellow-300');
                    }
                });

            } else {
                select.innerHTML = '<option value="">Gagal memuat kategori</option>';
            }
        } catch (error) {
            console.error('Error loading categories:', error);
            document.getElementById('category').innerHTML = '<option value="">Error koneksi server</option>';
        }
    });

    // 3. Tampilkan nama file saat dipilih
    document.getElementById('proof_file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        document.getElementById('file-name').textContent = fileName ? 'File terpilih: ' + fileName : '';
    });

    // 4. Handle Submit Form via AJAX
    document.getElementById('formTransaksi').addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('btnSubmit');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';

        const formData = new FormData(this);

        try {
            // Gunakan BASE_PATH untuk memastikan URL benar
            const apiUrl = BASE_PATH + 'api/transaction.php';
            
            const response = await fetch(apiUrl, {
                method: 'POST',
                body: formData 
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Transaksi telah disimpan dan menunggu audit.',
                    confirmButtonColor: '#2563eb'
                }).then(() => {
                    document.getElementById('formTransaksi').reset();
                    document.getElementById('date').valueAsDate = new Date(); 
                    document.getElementById('file-name').textContent = '';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: result.message,
                });
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan koneksi server.',
            });
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
</script>

<?php include $path . 'includes/footer.php'; ?>