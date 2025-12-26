@extends('layouts.app')

@section('title', 'Edit Unit - boysonthewheels')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">

    <div class="mb-6 border-b border-gray-700 pb-4 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white brand-font">EDIT KATALOG</h1>
            <p class="text-gray-400 text-sm mt-1">Update informasi unit: <span class="text-botw-red font-bold">{{ $car->name }}</span></p>
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

    <form action="{{ route('dashboard.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT') <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font">Identitas Mobil</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Merek</label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Nama Unit</label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Tahun</label>
                    <input type="number" name="year" value="{{ old('year', $car->year) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Model / Kategori</label>
                    <select name="body_type" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                        @foreach(['City Car', 'Sedan', 'Mobil Keluarga', 'SUV'] as $option)
                        <option value="{{ $option }}" {{ old('body_type', $car->body_type) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Kapasitas Baris Kursi</label>
                    <select name="row_type" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none">
                        <option value="2 baris" {{ old('row_type', $car->row_type) == '2 baris' ? 'selected' : '' }}>2 Baris</option>
                        <option value="3 baris" {{ old('row_type', $car->row_type) == '3 baris' ? 'selected' : '' }}>3 Baris</option>
                        <option value="Lebih dari 3 baris" {{ old('row_type', $car->row_type) == 'Lebih dari 3 baris' ? 'selected' : '' }}>Lebih dari 3 Baris</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font">Spesifikasi & Finansial</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Transmisi</label>
                    <select name="transmission" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red">
                        <option value="Automatic" {{ $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="Manual" {{ $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Odometer (KM)</label>
                    <input type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Harga Cash</label>
                    <input type="number" name="price" value="{{ old('price', $car->price) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red font-bold">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Min. DP</label>
                    <input type="number" name="down_payment" value="{{ old('down_payment', $car->down_payment) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Estimasi Angsuran</label>
                    <input type="number" name="installment" value="{{ old('installment', $car->installment) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red font-bold text-green-400">
                </div>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">
            <h2 class="text-xl font-bold text-botw-blue mb-4 brand-font">Media & Deskripsi</h2>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Link Video Review</label>
                <input type="url" name="video_link" value="{{ old('video_link', $car->video_link) }}" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red">
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Deskripsi</label>
                <textarea name="description" rows="5" class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red">{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="mb-6">
                <div class="flex justify-between items-end mb-2">
                    <label class="block text-gray-400 text-xs font-bold uppercase">Atur Foto</label>
                    <span class="text-xs text-gray-500 italic text-right">
                        *Foto <strong>LAMA</strong> bisa digeser urutannya.<br>
                        *Foto Maximal <strong>2 MB</strong>.<br>
                        *Foto <strong>BARU</strong> akan muncul di paling belakang (setelah disimpan).
                    </span>
                </div>

                <div id="sortable-images" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">

                    @foreach($car->images as $img)
                    <div class="existing-image relative group cursor-move bg-gray-900 rounded-lg border {{ $img->is_primary ? 'border-botw-red ring-1 ring-botw-red' : 'border-gray-600' }} p-1" data-id="{{ $img->id }}">

                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-32 object-cover rounded">

                        <label class="absolute top-2 left-2 cursor-pointer z-20">
                            <input type="radio" name="primary_image_id" value="{{ $img->id }}" {{ $img->is_primary ? 'checked' : '' }} class="hidden peer">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-800/50 peer-checked:bg-botw-red peer-checked:border-botw-red flex items-center justify-center transition shadow-lg">
                                <i class="fas fa-star text-[10px] text-white {{ $img->is_primary ? '' : 'hidden' }}"></i>
                            </div>
                        </label>

                        <button type="button" onclick="confirmDeleteImage({{ $img->id }})" class="absolute top-2 right-2 bg-red-600 text-white w-6 h-6 rounded flex items-center justify-center hover:bg-red-700 shadow-lg transition z-20">
                            <i class="fas fa-trash text-xs"></i>
                        </button>

                        <div class="absolute bottom-1 right-1 bg-black/50 text-white text-[10px] px-2 rounded backdrop-blur-sm z-10">
                            #<span class="position-label">{{ $loop->iteration }}</span>
                        </div>
                    </div>
                    @endforeach

                </div>

                <input type="hidden" name="image_order" id="image_order_input">

                <label for="file-input" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-900 hover:bg-gray-800 hover:border-botw-red transition mb-4">
                    <div class="flex flex-col items-center justify-center pt-2">
                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                        <p class="text-sm text-gray-400 font-bold">Tambah Foto Baru</p>
                        <p class="text-xs text-gray-500">Klik disini untuk memilih foto tambahan</p>
                    </div>
                    <input id="file-input" name="images[]" type="file" multiple class="hidden" onchange="previewNewImages(event)" />
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-botw-red text-white font-bold px-8 py-4 rounded-lg shadow-lg hover:bg-red-700 transition w-full md:w-auto">
                <i class="fas fa-save mr-2"></i> UPDATE DATA
            </button>
        </div>
    </form>

    <form id="delete-image-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // 1. LOGIC DELETE IMAGE (SERVER SIDE)
    function confirmDeleteImage(id) {
        if (confirm('Hapus foto ini dari database?')) {
            let form = document.getElementById('delete-image-form');
            form.action = '/dashboard/cars/image/' + id; // Pastikan route ini ada
            form.submit();
        }
    }

    // 2. LOGIC PREVIEW NEW IMAGES (CLIENT SIDE)
    let newFilesArray = []; // Menyimpan file baru
    const sortableContainer = document.getElementById('sortable-images');
    const fileInput = document.getElementById('file-input');

    function previewNewImages(event) {
        const files = Array.from(event.target.files);

        // Loop setiap file baru
        files.forEach((file, index) => {
            // Masukkan ke array global (opsional jika ingin fitur hapus sebelum upload)
            newFilesArray.push(file);

            const reader = new FileReader();
            reader.onload = function(e) {
                // Buat elemen DIV baru
                const div = document.createElement('div');
                div.className = "relative group bg-gray-800 rounded-lg border-2 border-dashed border-botw-blue p-1 opacity-90";

                // HTML Content untuk Foto Baru
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded opacity-70">

                    <div class="absolute top-1 left-1 bg-botw-blue text-white text-[10px] px-2 rounded-full font-bold shadow z-20">
                        NEW
                    </div>

                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-1 right-1 bg-gray-600 text-white w-6 h-6 rounded flex items-center justify-center hover:bg-gray-500 shadow z-20">
                        <i class="fas fa-times text-xs"></i>
                    </button>

                    <div class="absolute bottom-1 right-1 text-[10px] text-gray-300 italic px-1">
                        Belum Disimpan
                    </div>
                `;

                // Tambahkan ke Grid Sortable
                sortableContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }

    // 3. LOGIC SORTABLE (DRAG & DROP FOTO LAMA)
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('sortable-images');
        var orderInput = document.getElementById('image_order_input');

        var sortable = Sortable.create(el, {
            animation: 150,
            draggable: ".existing-image", // HANYA FOTO LAMA YANG BISA DIGESER
            ghostClass: 'opacity-50',
            onEnd: function() {
                updateOrder();
                updateLabels();
            }
        });

        function updateOrder() {
            // Hanya ambil ID dari foto lama (yang punya data-id)
            var order = [];
            var items = el.querySelectorAll('.existing-image');
            items.forEach(function(item) {
                order.push(item.getAttribute('data-id'));
            });
            orderInput.value = order.join(',');
        }

        function updateLabels() {
            // Update nomor urut visual
            var labels = el.querySelectorAll('.position-label');
            labels.forEach(function(span, index) {
                span.textContent = index + 1;
            });
        }

        // Init awal
        updateOrder();
    });
</script>
<script>
    function confirmDeleteImage(id) {
        if (confirm('Hapus foto ini?')) {
            let form = document.getElementById('delete-image-form');
            form.action = '/dashboard/cars/image/' + id;
            form.submit();
        }
    }
</script>
</div>
@endsection