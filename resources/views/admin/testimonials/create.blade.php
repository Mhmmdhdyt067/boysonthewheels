@extends('layouts.app')

@section('title', 'Tambah Testimoni - boysonthewheels')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">

    <div class="mb-6 border-b border-gray-700 pb-4 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white brand-font">INPUT TESTIMONI</h1>
            <p class="text-gray-400 text-sm mt-1">Tambahkan momen serah terima unit kepada pelanggan.</p>
        </div>
        <a href="{{ route('dashboard.testimonials.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 rounded-lg mb-6">
        <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-exclamation-triangle"></i>
            <span class="font-bold">Terjadi Kesalahan:</span>
        </div>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('dashboard.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg">

            <div class="mb-5">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Nama Pembeli</label>
                <input type="text" name="buyer_name" value="{{ old('buyer_name') }}" placeholder="Contoh: Bpk. Budi Santoso"
                    class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition @error('buyer_name') border-red-500 @enderror">
                @error('buyer_name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Unit Mobil yang Dibeli</label>
                <input type="text" name="car_purchased" value="{{ old('car_purchased') }}" placeholder="Contoh: Honda Civic Turbo 2020"
                    class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition">
            </div>

            <div class="mb-5">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Kesan / Pesan Pelanggan</label>
                <textarea name="message" rows="4" placeholder="Tuliskan testimoni singkat mereka..."
                    class="w-full bg-gray-900 border border-gray-600 text-white rounded p-3 focus:border-botw-red focus:outline-none transition">{{ old('message') }}</textarea>
                @error('message') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-2">
                <label class="block text-gray-400 text-xs font-bold mb-2 uppercase">Foto Serah Terima (Wajib)</label>

                <label for="image-upload" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-900 hover:bg-gray-800 hover:border-botw-red transition relative overflow-hidden group">

                    <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                        <i class="fas fa-camera text-3xl text-gray-500 mb-3 group-hover:text-botw-red transition"></i>
                        <p class="text-sm text-gray-400 font-bold">Klik untuk Upload Foto</p>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP (Max 2MB)</p>
                    </div>

                    <img id="preview-img" class="hidden absolute inset-0 w-full h-full object-cover">

                    <input id="image-upload" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                </label>
                @error('image') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="flex-1 bg-botw-red text-white font-bold py-4 rounded-lg shadow-lg shadow-red-900/40 hover:bg-red-700 transition transform hover:-translate-y-1 brand-font tracking-wider">
                <i class="fas fa-save mr-2"></i> SIMPAN TESTIMONI
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const output = document.getElementById('preview-img');
            const placeholder = document.getElementById('upload-placeholder');

            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection