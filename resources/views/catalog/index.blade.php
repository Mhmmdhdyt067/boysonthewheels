@extends('layouts.app')

@section('content')
<div class="bg-botw-darker shadow-lg border-b border-gray-800 sticky top-16 z-30 pb-6 pt-4">
    <div class="container mx-auto px-4">
        <form action="/" method="GET">
            <div class="flex gap-2 mb-4">
                <input type="text" name="search" placeholder="Cari nama mobil, merek (Honda, Toyota)..." value="{{ request('search') }}"
                    class="w-full bg-gray-800 border border-gray-700 text-gray-100 p-3 rounded-lg focus:ring-botw-red focus:border-botw-red placeholder-gray-500">
                <button type="submit" class="bg-botw-red text-white px-6 py-3 rounded-lg font-bold hover:bg-red-700 brand-font">CARI</button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 text-sm">

                <select name="price_range" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue" onchange="this.form.submit()">
                    <option value="">Harga</option>
                    <option value="under_100" {{ request('price_range') == 'under_100' ? 'selected' : '' }}>Di Bawah 100 Juta</option>
                    <option value="100_range" {{ request('price_range') == '100_range' ? 'selected' : '' }}>100 Juta</option>
                    <option value="200_range" {{ request('price_range') == '200_range' ? 'selected' : '' }}>200 Juta</option>
                    <option value="above_300" {{ request('price_range') == 'above_300' ? 'selected' : '' }}>300 Juta Ke Atas</option>
                </select>

                <select name="year_range" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue" onchange="this.form.submit()">
                    <option value="">Tahun</option>
                    <option value="below_2000" {{ request('year_range') == 'below_2000' ? 'selected' : '' }}>2000 Kebawah</option>
                    <option value="2000_2010" {{ request('year_range') == '2000_2010'  ? 'selected' : '' }}>2000 - 2010</option>
                    <option value="2010_2020" {{ request('year_range') == '2010_2020'  ? 'selected' : '' }}>2010 - 2020</option>
                    <option value="above_2020" {{ request('year_range') == 'above_2020' ? 'selected' : '' }}>2020 Ke Atas</option>
                </select>

                <select name="dp_range" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue" onchange="this.form.submit()">
                    <option value="">DP</option>
                    <option value="cash_only" class="bg-botw-red font-bold text-white" {{ request('dp_range') == 'cash_only' ? 'selected' : '' }}>⛔ Cash Only (Tidak Bisa Kredit)</option>
                    <option value="max_5" {{ request('dp_range') == 'max_5'  ? 'selected' : '' }}>0-5 Juta</option>
                    <option value="max_10" {{ request('dp_range') == 'max_10' ? 'selected' : '' }}>0-10 Juta</option>
                    <option value="max_20" {{ request('dp_range') == 'max_20' ? 'selected' : '' }}>0-20 Juta</option>
                    <option value="max_50" {{ request('dp_range') == 'max_50' ? 'selected' : '' }}>0-50 Juta</option>
                    <option value="above_50" {{ request('dp_range') == 'above_50' ? 'selected' : '' }}>Di Atas 50 Juta</option>
                </select>

                <select name="model" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue" onchange="this.form.submit()">
                    <option value="">Model</option>
                    <option value="City Car" {{ request('model') == 'City Car'       ? 'selected' : '' }}>City Car</option>
                    <option value="Sedan" {{ request('model') == 'Sedan'          ? 'selected' : '' }}>Sedan</option>
                    <option value="Mobil Keluarga" {{ request('model') == 'Mobil Keluarga' ? 'selected' : '' }}>Mobil Keluarga</option>
                    <option value="SUV" {{ request('model') == 'SUV' ? 'selected' : '' }}>SUV</option>
                </select>

                <select name="row_type" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue cursor-pointer hover:bg-gray-700 transition" onchange="this.form.submit()">
                    <option value="">Kapasitas Kursi</option>
                    <option value="2 baris" {{ request('row_type') == '2 baris' ? 'selected' : '' }}>2 Baris</option>
                    <option value="3 baris" {{ request('row_type') == '3 baris' ? 'selected' : '' }}>3 Baris</option>
                    <option value="Lebih dari 3 baris" {{ request('row_type') == 'Lebih dari 3 baris' ? 'selected' : '' }}>Lebih dari 3 Baris</option>
                </select>

                <select name="installment_range" class="bg-gray-800 text-gray-200 border border-gray-600 p-2.5 rounded-lg focus:ring-botw-blue" onchange="this.form.submit()">
                    <option value="">Angsuran</option>
                    <option value="max_2" {{ request('installment_range') == 'max_2' ? 'selected' : '' }}>2 Juta/bulan</option>
                    <option value="max_4" {{ request('installment_range') == 'max_4' ? 'selected' : '' }}>4 Juta/bulan</option>
                    <option value="max_8" {{ request('installment_range') == 'max_8' ? 'selected' : '' }}>8 Juta/bulan</option>
                    <option value="above_8" {{ request('installment_range') == 'above_8' ? 'selected' : '' }}>Di Atas 8 Juta/bulan</option>
                </select>

            </div>

            <div class="mt-2 text-right">
                <a href="/" class="text-xs text-botw-red hover:text-white underline">Reset Filter</a>
            </div>
        </form>
    </div>
</div>

<div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 border-b border-gray-800 py-4 shadow-inner">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-300">

        <a href="https://maps.app.goo.gl/vKgk8qYu8ZPPSQti7" target="_blank" class="flex items-center gap-2 mb-2 md:mb-0 hover:text-white transition group cursor-pointer">
            <i class="fas fa-map-marker-alt text-botw-red animate-bounce group-hover:text-red-400"></i>
            <span class="font-medium group-hover:underline">South Jakarta (Jakarta Selatan)</span>
        </a>

        <div class="flex items-center gap-6">
            <a href="https://instagram.com/boys.katalog" target="_blank" class="flex items-center gap-2 hover:text-botw-red transition">
                <i class="fab fa-instagram text-lg"></i> boys.katalog
            </a>

            <a href="https://wa.me/6281181252550" target="_blank" class="flex items-center gap-2 hover:text-green-400 transition">
                <i class="fab fa-whatsapp text-lg"></i> +62 811-8125-2550
            </a>
        </div>
    </div>
</div>



<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white brand-font tracking-wide border-l-4 border-botw-red pl-3">
            KOLEKSI TERBARU
        </h2>
        <span class="text-xs text-gray-500 font-mono">Menampilkan {{ $cars->count() }} Unit</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($cars as $car)
        <a href="{{ route('cars.show', $car) }}" class="group bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-botw-blue hover:shadow-blue-900/20 transition duration-300 flex flex-col h-full">

            <div class="relative overflow-hidden aspect-w-16 aspect-h-10">
                @if($car->primaryImage)
                <img src="{{ Str::startsWith('storage/'.$car->primaryImage->image_path, 'http') ? $car->primaryImage->image_path : asset('storage/'.$car->primaryImage->image_path) }}"
                    alt="{{ $car->name }}"
                    class="object-cover w-full h-56 transform group-hover:scale-110 transition duration-700 ease-in-out">
                @else
                <div class="w-full h-56 bg-gray-700 flex items-center justify-center text-gray-500">No Image</div>
                @endif

                <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded border border-gray-600">
                    {{ $car->year }}
                </div>
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <div class="flex gap-2 mb-2">
                    <span class="text-[10px] uppercase font-bold tracking-wider text-botw-blue bg-blue-900/30 px-2 py-0.5 rounded border border-blue-900/50">
                        {{ $car->body_type }}
                    </span>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-gray-400 bg-gray-700/50 px-2 py-0.5 rounded border border-gray-600">
                        {{ $car->transmission }}
                    </span>
                </div>

                <h3 class="font-bold text-lg text-gray-100 mb-1 leading-tight group-hover:text-botw-red transition brand-font">
                    {{ $car->name }}
                </h3>

                <div class="mt-auto pt-4 border-t border-gray-700/50">
                    <div class="text-xs text-gray-400 mb-1">Harga Cash</div>
                    <div class="font-bold text-2xl text-botw-red brand-font tracking-tight mb-3">
                        Rp {{ number_format($car->price / 1000000, 0) }} Juta
                    </div>

                    <div class="bg-gray-900/50 rounded-lg p-2.5 border border-gray-700 mb-2">
                        <div class="flex justify-between items-center text-xs mb-1.5 border-b border-gray-700/50 pb-1.5">
                            <span class="text-gray-500">DP Mulai</span>
                            @if($car->down_payment > 0)
                            <span class="text-white font-bold">{{ number_format($car->down_payment / 1000000, 0) }} Jt</span>
                            @else
                            <span class="text-botw-red font-bold text-[10px] uppercase">Cash Only</span>
                            @endif
                        </div>

                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500">Angsuran</span>
                            @if($car->installment > 0)
                            <span class="text-green-400 font-bold">Rp {{ number_format($car->installment, 0, ',', '.') }}</span>
                            @else
                            <span class="text-gray-600">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="text-[10px] text-gray-500 text-right">
                        <i class="fas fa-tachometer-alt mr-1"></i> {{ number_format($car->mileage) }} km
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $cars->links('pagination::tailwind') }}
    </div>
</div>
@endsection