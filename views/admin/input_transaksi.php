<?php
// DEFINISI PATH: Mundur 2 langkah (../../) karena file ini ada di views/admin/
$path = '../../';

// Panggil Header & Sidebar dengan path yang benar
include $path . 'includes/header.php';
include $path . 'includes/sidebar.php';

// Cek akses: Hanya PJ Gudang & Admin yang boleh masuk sini
if ($role !== 'pj_gudang' && $role !== 'admin') {
    echo "<script>
            window.location.href = '" . $path . "index.php';
          </script>";
    exit;
}
?>

<main class="flex-1 overflow-y-auto bg-[#fcfaff] p-6 md:p-10 custom-scrollbar">
    
    <!-- HEADER HALAMAN -->
    <div class="max-w-4xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
                <a href="<?php echo $path; ?>index.php" class="hover:text-purple-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="text-purple-600">Input Transaksi</span>
            </nav>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Input Transaksi Baru</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Catat pengeluaran atau pemasukan kas dengan presisi.</p>
        </div>
        
        <a href="<?php echo $path; ?>index.php"
            class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 text-sm font-bold hover:bg-slate-50 hover:border-purple-200 hover:text-purple-600 transition-all shadow-sm">
            <i class="fa-solid fa-arrow-left-long"></i>
            Kembali
        </a>
    </div>

    <!-- FORM CONTAINER -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/50">
            <div class="p-8 md:p-12">

                <form id="formTransaksi" enctype="multipart/form-data" class="space-y-8">

                    <!-- SEKSI 1: DASAR TRANSAKSI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Tanggal -->
                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Tanggal Transaksi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>
                                <input type="date" name="date" id="date" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-semibold text-slate-700">
                            </div>
                        </div>

                        <!-- Jenis -->
                        <div class="space-y-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Jenis Transaksi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                </div>
                                <select name="type" id="type" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 appearance-none">
                                    <option value="out">Pengeluaran (Uang Keluar)</option>
                                    <option value="in">Pemasukan / Top Up (Uang Masuk)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Kategori / Akun Biaya</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            <select name="category" id="category" required 
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 appearance-none">
                                <option value="">-- Sedang memuat kategori... --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nominal dengan Format Ribuan -->
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Nominal Transaksi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                <span class="text-xl font-black text-purple-600">Rp</span>
                            </div>
                            <!-- Input Tampilan (Formatted) -->
                            <input type="text" id="amount_display" required placeholder="0"
                                class="w-full pl-16 pr-8 py-5 bg-purple-50/30 border border-purple-100 rounded-[1.5rem] focus:ring-8 focus:ring-purple-500/5 focus:border-purple-400 focus:bg-white transition-all outline-none font-black text-2xl text-slate-800 tracking-tight placeholder:text-slate-300">
                            <!-- Input Tersembunyi (Angka Murni untuk Database) -->
                            <input type="hidden" name="amount" id="amount_actual">
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Keterangan Detail</label>
                        <textarea name="description" id="description" rows="3" required placeholder="Jelaskan peruntukan dana secara detail..."
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-[1.5rem] focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 focus:bg-white transition-all outline-none font-medium text-slate-700 placeholder:text-slate-400"></textarea>
                    </div>

                    <!-- Opsi Zakat (Luxury Style) -->
                    <div id="zakat-container" class="relative group overflow-hidden bg-slate-50 border border-slate-100 rounded-[1.5rem] p-6 transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-amber-500 shadow-sm transition-transform group-hover:rotate-12">
                                    <i class="fa-solid fa-hand-holding-heart text-xl"></i>
                                </div>
                                <div>
                                    <label for="is_zakat" class="font-black text-slate-700 cursor-pointer block leading-tight">Masuk Hitungan Zakat?</label>
                                    <p class="text-xs text-slate-400 font-medium mt-1">Sistem akan mengalokasikan potensi pembersihan otomatis.</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <input id="is_zakat" name="is_zakat" type="checkbox" value="1"
                                    class="w-6 h-6 text-purple-600 bg-white border-slate-300 rounded-lg focus:ring-purple-500 focus:ring-offset-0 cursor-pointer transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Upload Bukti (Modern Drag-Drop) -->
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Bukti Transaksi (Struk/Nota)</label>
                        <div class="relative">
                            <label for="proof_file" class="group flex flex-col items-center justify-center w-full h-44 border-2 border-slate-200 border-dashed rounded-[2rem] cursor-pointer bg-slate-50 hover:bg-white hover:border-purple-400 hover:shadow-xl hover:shadow-purple-100/50 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-purple-500"></i>
                                    </div>
                                    <p class="text-sm text-slate-600 font-bold">Klik untuk unggah berkas</p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-1">PNG, JPG, JPEG (Maks. 2MB)</p>
                                    <p id="file-name" class="text-xs text-purple-600 font-black mt-3 truncate max-w-xs px-4"></p>
                                </div>
                                <input id="proof_file" name="proof_file" type="file" class="hidden" accept="image/*" required />
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-6">
                        <button type="reset" class="px-8 py-4 rounded-2xl text-slate-500 font-bold hover:bg-slate-100 transition-all text-sm uppercase tracking-widest">
                            Reset
                        </button>
                        <button type="submit" id="btnSubmit" class="px-10 py-4 rounded-2xl bg-purple-600 text-white font-black hover:bg-purple-700 shadow-xl shadow-purple-200 transition-all transform hover:-translate-y-1 active:scale-95 text-sm uppercase tracking-widest flex items-center gap-3">
                            <i class="fa-solid fa-paper-plane"></i>
                            Simpan Transaksi
                        </button>
                    </div>

                </form>
            </div>
        </div>
        
        <p class="text-center text-slate-400 text-xs font-medium mt-8 mb-10 tracking-wide">
            Pastikan data yang Anda masukkan sesuai dengan bukti fisik yang dilampirkan.
        </p>
    </div>
</main>

<script>
    // 1. Set Default Tanggal
    document.getElementById('date').valueAsDate = new Date();

    // 2. Logika Currency Formatter Otomatis
    const amountDisplay = document.getElementById('amount_display');
    const amountActual = document.getElementById('amount_actual');

    amountDisplay.addEventListener('input', function(e) {
        // Hapus semua karakter kecuali angka
        let value = this.value.replace(/[^0-9]/g, '');
        
        // Simpan angka murni ke input hidden untuk dikirim ke PHP
        amountActual.value = value;
        
        // Format tampilan dengan titik (IDR Style)
        if (value) {
            this.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            this.value = '';
        }
    });

    // 3. Load Kategori Dinamis
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const response = await fetch(BASE_PATH + 'api/categories.php');
            const result = await response.json();
            
            const select = document.getElementById('category');
            
            if (result.success && result.data.length > 0) {
                select.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                
                const groups = {};
                result.data.forEach(item => {
                    if (!groups[item.group_name]) groups[item.group_name] = [];
                    groups[item.group_name].push(item);
                });

                for (const [groupName, items] of Object.entries(groups)) {
                    const optgroup = document.createElement('optgroup');
                    optgroup.label = groupName;

                    items.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name;
                        option.textContent = item.name;
                        option.dataset.zakat = item.is_zakat;
                        optgroup.appendChild(option);
                    });
                    select.appendChild(optgroup);
                }

                select.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const isZakat = selectedOption.dataset.zakat == 1;
                    const checkbox = document.getElementById('is_zakat');
                    const container = document.getElementById('zakat-container');
                    
                    checkbox.checked = isZakat;
                    
                    if(isZakat) {
                        container.classList.add('bg-purple-50', 'border-purple-200', 'shadow-sm');
                    } else {
                        container.classList.remove('bg-purple-50', 'border-purple-200', 'shadow-sm');
                    }
                });
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    });

    // 4. File Name Display
    document.getElementById('proof_file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const display = document.getElementById('file-name');
        if(fileName) {
            display.innerHTML = '<i class="fa-solid fa-file-circle-check mr-2"></i> ' + fileName;
        } else {
            display.textContent = '';
        }
    });

    // 5. Submit via AJAX
    document.getElementById('formTransaksi').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validasi tambahan: pastikan nominal terisi
        if (!amountActual.value || amountActual.value < 100) {
            Swal.fire({ icon: 'warning', title: 'Nominal tidak valid', text: 'Silakan masukkan jumlah uang yang benar.' });
            return;
        }

        const btn = document.getElementById('btnSubmit');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Menyimpan...';

        const formData = new FormData(this);

        try {
            const apiUrl = BASE_PATH + 'api/transaction.php';
            const response = await fetch(apiUrl, {
                method: 'POST',
                body: formData 
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: '<span class="font-black text-2xl">Berhasil Disimpan!</span>',
                    text: 'Transaksi telah dicatat dan masuk dalam antrean audit.',
                    confirmButtonColor: '#9333ea',
                    customClass: {
                        popup: 'rounded-[2rem] shadow-2xl',
                        confirmButton: 'rounded-xl px-10 py-3 font-bold uppercase tracking-widest text-xs'
                    }
                }).then(() => {
                    this.reset();
                    amountActual.value = ''; // Reset angka murni
                    document.getElementById('date').valueAsDate = new Date(); 
                    document.getElementById('file-name').textContent = '';
                    document.getElementById('zakat-container').classList.remove('bg-purple-50', 'border-purple-200');
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal Simpan', text: result.message });
            }
        } catch (error) {
            console.error(error);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Koneksi ke server terputus.' });
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
</script>

<?php include $path . 'includes/footer.php'; ?>