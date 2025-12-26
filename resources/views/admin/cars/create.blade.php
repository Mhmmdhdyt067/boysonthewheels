@extends('layouts.app')

@section('title', 'Tambah Unit Baru - boysonthewheels')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">

    <div class="mb-6 border-b border-gray-700 pb-4 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white brand-font">INPUT KATALOG BARU</h1>
            <p class="text-gray-400 text-sm mt-1">Masukkan data unit terbaru. Pastikan foto jernih dan data akurat.</p>
        </div>
        <a href="{{ route('dashboard.cars.index') }}" class="text-gray-400 hover:text-white transition"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 rounded-lg mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('dashboard.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="uploadForm">
        @csrf

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font"><i class="fas fa-car mr-2"></i> Identitas Mobil</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Merek (Brand)</label>
                    <input type="text" name="brand" list="brands" value="{{ old('brand') }}" placeholder="Ketik atau Pilih Merek..."
                        class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition">
                    <datalist id="brands">
                        <option value="Honda">
                        <option value="Toyota">
                        <option value="Mercy">
                        <option value="BMW">
                        <option value="Nissan">
                        <option value="Grandmax">
                        <option value="Suzuki">
                    </datalist>
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Nama Unit / Tipe</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Civic Turbo Hatchback"
                        class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Tahun Pembuatan</label>
                    <input type="number" name="year" value="{{ old('year') }}" placeholder="2022"
                        class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Kategori / Model</label>
                    <select name="body_type" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                        <option value="" disabled selected>-- Pilih Model --</option>
                        <option value="City Car">City Car</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Mobil Keluarga">Mobil Keluarga</option>
                        <option value="SUV">SUV</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Kapasitas Baris Kursi</label>
                    <select name="row_type" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                        <option value="2 baris">2 Baris</option>
                        <option value="3 baris">3 Baris</option>
                        <option value="Lebih dari 3 baris">Lebih dari 3 Baris</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font"><i class="fas fa-cogs mr-2"></i> Spesifikasi & Harga</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Transmisi</label>
                    <div class="flex gap-4">
                        <label class="flex items-center bg-gray-900 border border-gray-600 px-4 py-3 rounded cursor-pointer hover:border-botw-red w-full">
                            <input type="radio" name="transmission" value="Automatic" checked class="text-botw-red focus:ring-botw-red">
                            <span class="ml-2 text-white">Automatic</span>
                        </label>
                        <label class="flex items-center bg-gray-900 border border-gray-600 px-4 py-3 rounded cursor-pointer hover:border-botw-red w-full">
                            <input type="radio" name="transmission" value="Manual" class="text-botw-red focus:ring-botw-red">
                            <span class="ml-2 text-white">Manual</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Odometer (KM)</label>
                    <input type="number" name="mileage" value="{{ old('mileage') }}" placeholder="Contoh: 45000"
                        class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Estimasi Angsuran / Bulan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 font-bold">Rp</span>
                        <input type="number" name="installment" value="{{ old('installment') }}" placeholder="4500000"
                            class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 pl-10 focus:border-botw-red focus:outline-none font-bold text-green-400">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Min. DP (Down Payment)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 font-bold">Rp</span>
                        <input type="number" name="down_payment" value="{{ old('down_payment') }}" placeholder="50000000"
                            class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 pl-10 focus:border-botw-red focus:outline-none">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Harga Cash (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 font-bold">Rp</span>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="350000000"
                            class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 pl-10 focus:border-botw-red focus:outline-none font-bold text-lg">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font"><i class="fas fa-photo-video mr-2"></i> Media & Foto</h2>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Link Video Review (Instagram/YouTube)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fab fa-instagram"></i>
                    </span>
                    <input type="url" name="video_link" value="{{ old('video_link') }}" placeholder="https://www.instagram.com/reel/..."
                        class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 pl-10 focus:border-botw-red focus:outline-none transition">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" placeholder="Jelaskan kondisi, fitur, dan kelengkapan surat..."
                    class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Upload & Atur Foto</label>

                <label for="file-input" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-900 hover:bg-gray-800 hover:border-botw-red transition mb-4">
                    <div class="flex flex-col items-center justify-center pt-2">
                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                        <p class="text-xs text-gray-400">Klik untuk pilih foto</p>
                    </div>
                    <input id="file-input" name="images[]" type="file" multiple class="hidden" onchange="addFiles(event)" />
                </label>

                <input type="hidden" name="primary_index" id="primary_index" value="0">

                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs text-gray-500 italic">*Foto Maximal <strong>2 MB</strong>.<br>*Klik foto untuk <strong>Set Cover</strong>. Gunakan panah untuk <strong>Geser Urutan</strong>.</span>
                    <button type="button" onclick="clearAllFiles()" class="text-xs text-red-400 hover:text-red-300 underline">Hapus Semua</button>
                </div>

                <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="flex-1 bg-botw-red text-white font-bold py-4 rounded-lg shadow-lg shadow-red-900/40 hover:bg-red-700 transition transform hover:-translate-y-1 brand-font tracking-wider">
                <i class="fas fa-save mr-2"></i> SIMPAN UNIT BARU
            </button>
        </div>
    </form>
</div>

<script>
    let filesArray = []; // Menyimpan File object yang sebenarnya
    let primaryIndex = 0; // Menyimpan index mana yang jadi cover

    const fileInput = document.getElementById('file-input');
    const container = document.getElementById('preview-container');
    const primaryInput = document.getElementById('primary_index');

    // 1. Saat user memilih file (bisa berkali-kali)
    function addFiles(event) {
        const newFiles = Array.from(event.target.files);

        // Gabungkan file baru ke array yang sudah ada
        filesArray = filesArray.concat(newFiles);

        // Render ulang tampilan
        renderPreview();

        // Update input asli agar form bisa disubmit
        updateFileInput();
    }

    // 2. Render Tampilan Preview
    function renderPreview() {
        container.innerHTML = ''; // Kosongkan dulu

        filesArray.forEach((file, index) => {
            const reader = new FileReader();

            // Container Card Foto
            const div = document.createElement('div');
            div.className = `relative group border-2 rounded-lg overflow-hidden transition bg-gray-900 ${index === primaryIndex ? 'border-botw-red ring-2 ring-botw-red' : 'border-gray-700'}`;

            // Struktur HTML per foto
            const htmlContent = `
                <div class="relative w-full h-32 cursor-pointer" onclick="setPrimary(${index})">
                    <img src="" class="preview-img-${index} w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">

                    <div class="${index === primaryIndex ? '' : 'hidden'} absolute top-1 left-1 bg-botw-red text-white text-[10px] px-2 rounded-full font-bold shadow z-10">
                        COVER UTAMA
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 bg-black/70 backdrop-blur-sm flex justify-between items-center p-1 z-20">
                    <button type="button" onclick="moveFile(${index}, -1)" class="text-white hover:text-botw-blue px-2 ${index === 0 ? 'opacity-30 cursor-not-allowed' : ''}">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <span class="text-[10px] text-gray-300">#${index + 1}</span>

                    <button type="button" onclick="moveFile(${index}, 1)" class="text-white hover:text-botw-blue px-2 ${index === filesArray.length - 1 ? 'opacity-30 cursor-not-allowed' : ''}">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <button type="button" onclick="removeFile(${index})" class="absolute top-1 right-1 bg-red-600 text-white w-6 h-6 rounded flex items-center justify-center hover:bg-red-700 shadow z-30 transition transform hover:scale-110">
                    <i class="fas fa-times text-xs"></i>
                </button>
            `;

            div.innerHTML = htmlContent;
            container.appendChild(div);

            // Load Gambar Asynchronous
            reader.onload = function(e) {
                document.querySelector(`.preview-img-${index}`).src = e.target.result;
            }
            reader.readAsDataURL(file);
        });

        // Update input hidden primary index
        primaryInput.value = primaryIndex;
    }

    // 3. Fungsi Menentukan Cover
    window.setPrimary = function(index) {
        primaryIndex = index;
        renderPreview();
    }

    // 4. Fungsi Hapus File
    window.removeFile = function(index) {
        filesArray.splice(index, 1);

        // Jika cover yang dihapus, reset cover ke 0
        if (index === primaryIndex) primaryIndex = 0;
        else if (index < primaryIndex) primaryIndex--; // Geser index cover jika file sebelumnya dihapus

        renderPreview();
        updateFileInput();
    }

    // 5. Fungsi Geser Urutan (Swap)
    window.moveFile = function(index, direction) {
        const newIndex = index + direction;

        // Cek batas array
        if (newIndex < 0 || newIndex >= filesArray.length) return;

        // Swap file di array
        const temp = filesArray[index];
        filesArray[index] = filesArray[newIndex];
        filesArray[newIndex] = temp;

        // Logika pindah Cover jika yang digeser adalah cover
        if (primaryIndex === index) {
            primaryIndex = newIndex;
        } else if (primaryIndex === newIndex) {
            primaryIndex = index;
        }

        renderPreview();
        updateFileInput();
    }

    // 6. Fungsi Hapus Semua
    window.clearAllFiles = function() {
        filesArray = [];
        primaryIndex = 0;
        renderPreview();
        updateFileInput();
    }

    // 7. SYNC ARRAY JS KE INPUT FILE ASLI (CORE LOGIC)
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        filesArray.forEach(file => {
            dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files;
    }
</script>
@endsection