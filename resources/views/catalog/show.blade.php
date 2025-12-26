@extends('layouts.app')

@section('seo')
<title>Jual {{ $car->name }} ({{ $car->year }}) - boysonthewheels</title>
<meta name="description" content="Spesifikasi {{ $car->name }} tahun {{ $car->year }}. KM {{ $car->mileage }}, Transmisi {{ $car->transmission }}. Hubungi boysonthewheels Jakarta Selatan.">

<meta property="og:title" content="Jual {{ $car->name }} - boysonthewheels" />
<meta property="og:description" content="Harga: Rp {{ number_format($car->price / 1000000, 0) }} Juta. KM: {{ number_format($car->mileage) }}. Cek unit sekarang!" />
@if($car->primaryImage)
<meta property="og:image" content="{{ Str::startsWith($car->primaryImage->image_path, 'http') ? $car->primaryImage->image_path : asset('storage/' . $car->primaryImage->image_path) }}" />
@endif
@endsection

@section('content')
<div class="bg-botw-darker border-b border-gray-800 py-3">
    <div class="container mx-auto px-4 text-xs text-gray-500 flex gap-2">
        <a href="/" class="hover:text-botw-red">Home</a> /
        <span class="text-botw-blue font-bold">{{ $car->brand }}</span> /
        <span class="text-gray-300">{{ $car->name }}</span>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-4"
            x-data="{
                activeImage: '{{ $car->primaryImage ? (Str::startsWith($car->primaryImage->image_path, 'http') ? $car->primaryImage->image_path : asset('storage/' . $car->primaryImage->image_path)) : '' }}',
                isLoading: false
             }">

            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-700 group bg-gray-900 aspect-[4/5] flex items-center justify-center">

                <div x-show="isLoading" class="absolute inset-0 flex items-center justify-center bg-gray-900 z-10">
                    <i class="fas fa-spinner fa-spin text-botw-red text-3xl"></i>
                </div>

                <template x-if="activeImage">
                    <img :src="activeImage"
                        @load="isLoading = false"
                        class="w-full h-full object-cover transition duration-500 ease-in-out"
                        alt="{{ $car->name }} - Tampilan Detail">
                </template>

                <template x-if="!activeImage">
                    <div class="text-gray-500">No Image Available</div>
                </template>

                <div class="absolute top-4 left-4 z-20">
                    <span class="bg-botw-red text-white text-xs font-bold px-3 py-1 rounded shadow-lg uppercase tracking-widest">
                        Available
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                @foreach($car->images as $img)
                @php
                $imgUrl = Str::startsWith($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path);
                @endphp

                <div @click="activeImage = '{{ $imgUrl }}'; isLoading = true"
                    class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden border border-gray-700 cursor-pointer hover:border-botw-red transition relative group"
                    :class="{ 'ring-2 ring-botw-blue ring-offset-2 ring-offset-gray-900': activeImage === '{{ $imgUrl }}' }">

                    <img src="{{ $imgUrl }}" class="w-full h-full object-cover group-hover:opacity-80 transition" alt="Thumbnail {{ $car->name }}">

                    <div class="absolute inset-0 bg-black/20 hidden group-hover:flex items-center justify-center">
                        <i class="fas fa-eye text-white text-xs drop-shadow-md"></i>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg mt-6">
                <h3 class="text-xl font-bold text-white mb-4 border-b border-gray-700 pb-2 brand-font">
                    <i class="fas fa-align-left text-botw-blue mr-2"></i> KETERANGAN UNIT
                </h3>
                <div class="prose prose-invert prose-sm max-w-none text-gray-300 whitespace-pre-line leading-relaxed">
                    {{ $car->description }}
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 sticky top-24 overflow-hidden">
                <div class="p-6 border-b border-gray-700 bg-gray-800">
                    <h1 class="text-2xl font-bold text-white brand-font leading-tight mb-2">{{ $car->name }}</h1>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-bold text-botw-red brand-font">Rp {{ number_format($car->price / 1000000, 0) }} Juta</span>
                        <span class="text-xs text-gray-500 mb-2">(Cash / Nego)</span>
                    </div>
                </div>

                <div class="p-6 bg-gray-800/50">
                    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                        <div class="bg-gray-900/50 p-3 rounded border border-gray-700">
                            <span class="text-gray-500 text-xs block mb-1">Tahun</span>
                            <span class="text-white font-semibold">{{ $car->year }}</span>
                        </div>
                        <div class="bg-gray-900/50 p-3 rounded border border-gray-700">
                            <span class="text-gray-500 text-xs block mb-1">Transmisi</span>
                            <span class="text-white font-semibold">{{ $car->transmission }}</span>
                        </div>
                        <div class="bg-gray-900/50 p-3 rounded border border-gray-700">
                            <span class="text-gray-500 text-xs block mb-1">Kilometer</span>
                            <span class="text-white font-semibold">{{ number_format($car->mileage) }}</span>
                        </div>
                        <div class="bg-gray-900/50 p-3 rounded border border-gray-700">
                            <span class="text-gray-500 text-xs block mb-1">Tipe Bodi</span>
                            <span class="text-white font-semibold">{{ $car->body_type }}</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-4 rounded-xl border border-gray-600 relative overflow-hidden group hover:border-botw-blue transition duration-300">
                        <div class="flex items-center gap-2 mb-3 border-b border-gray-700 pb-2">
                            <i class="fas fa-calculator text-botw-red"></i>
                            <span class="text-xs font-bold text-gray-300 tracking-wider uppercase">Estimasi Kredit</span>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-xs text-gray-400 block">Total DP (Mulai)</span>
                                    <span class="text-sm font-semibold text-gray-500">Min. Down Payment</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-bold text-white brand-font">
                                        Rp {{ number_format($car->down_payment, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="border-t border-dashed border-gray-700"></div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-xs text-gray-400 block">Angsuran / Bulan</span>
                                    <span class="text-xs text-botw-blue font-bold">Estimasi Cicilan</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-bold text-green-400 brand-font">
                                        Rp {{ number_format($car->installment, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-[10px] text-gray-500 italic text-center">
                            *Simulasi hitungan dapat berubah sewaktu-waktu sesuai leasing.
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        @php
                        $wa_message = "Halo boysonthewheels, saya tertarik dengan unit *{$car->name}* ({$car->year}). \n\nHarga: Rp " . number_format($car->price) . "\nDP: Rp " . number_format($car->down_payment) . "\nAngsuran: Rp " . number_format($car->installment) . "\n\nApakah unit masih tersedia?";
                        $wa_link = "https://wa.me/6281181252550?text=" . urlencode($wa_message);
                        @endphp

                        <a href="{{ $wa_link }}" target="_blank" class="block w-full bg-botw-red hover:bg-red-700 text-white text-center font-bold py-4 rounded-lg shadow-lg shadow-red-900/30 transition transform hover:-translate-y-1 flex justify-center items-center gap-2 group brand-font tracking-wider">
                            <i class="fab fa-whatsapp text-2xl group-hover:animate-pulse"></i> HUBUNGI SEKARANG
                        </a>

                        @if($car->video_link)
                        <a href="{{ $car->video_link }}" target="_blank" class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-center font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                            <i class="fab fa-instagram text-xl"></i> TONTON VIDEO REVIEW
                        </a>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            <button class="w-full bg-gray-700 hover:bg-gray-600 text-gray-300 text-xs font-bold py-3 rounded border border-gray-600 transition flex items-center justify-center gap-1">
                                <i class="fas fa-share-alt"></i> SHARE
                            </button>
                            <button onclick="window.print()" class="w-full bg-gray-700 hover:bg-gray-600 text-gray-300 text-xs font-bold py-3 rounded border border-gray-600 transition flex items-center justify-center gap-1">
                                <i class="fas fa-print"></i> PRINT
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 flex items-start gap-3 text-xs text-gray-500 bg-gray-900 p-3 rounded">
                        <i class="fas fa-shield-alt text-gray-400 mt-0.5"></i>
                        <p>Pastikan Anda melakukan inspeksi unit secara langsung di showroom kami di Jakarta Selatan sebelum melakukan pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection