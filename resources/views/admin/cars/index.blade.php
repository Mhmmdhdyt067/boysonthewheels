@extends('layouts.app')

@section('title', 'Admin Dashboard - boysonthewheels')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white brand-font">DASHBOARD ADMIN</h1>
        <p class="text-gray-400 text-sm mt-1">Ringkasan aktivitas dan menu pengelolaan website.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <a href="{{ route('dashboard.testimonials.index') }}" class="group bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg hover:border-yellow-500 hover:shadow-yellow-900/20 transition duration-300 flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-xl font-bold text-white group-hover:text-yellow-400 transition brand-font tracking-wide">TESTIMONI</h3>
                <p class="text-gray-400 text-xs mt-1 group-hover:text-gray-300">Kelola ulasan & foto serah terima.</p>
            </div>

            <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center border border-gray-700 group-hover:bg-yellow-500 group-hover:border-yellow-400 transition duration-300 relative z-10">
                <i class="fas fa-star text-lg text-yellow-500 group-hover:text-white"></i>
            </div>

            <div class="absolute -bottom-4 -right-4 text-gray-700 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                <i class="fas fa-star text-8xl"></i>
            </div>
        </a>

        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-xl font-bold text-white brand-font tracking-wide">TOTAL UNIT</h3>
                <p class="text-gray-400 text-xs mt-1">Mobil aktif di katalog.</p>
            </div>
            <div class="text-3xl font-bold text-botw-red brand-font relative z-10">
                {{ $cars->total() }}
            </div>
            <div class="absolute -bottom-4 -right-4 text-gray-700 opacity-10">
                <i class="fas fa-car text-8xl"></i>
            </div>
        </div>

    </div>

    <div class="flex justify-between items-end mb-4 border-t border-gray-700 pt-8">
        <div>
            <h2 class="text-xl font-bold text-white brand-font">KATALOG MOBIL</h2>
            <p class="text-xs text-gray-500">Kelola unit yang tampil di website.</p>
        </div>
        <a href="{{ route('dashboard.cars.create') }}" class="bg-botw-red text-white px-5 py-2.5 rounded-lg font-bold hover:bg-red-700 transition shadow-lg shadow-red-900/30 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> TAMBAH UNIT
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-gray-900 text-xs uppercase text-gray-400 font-bold">
                    <tr>
                        <th class="px-6 py-4">Unit Mobil</th>
                        <th class="px-6 py-4">Harga & DP</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($cars as $car)
                    <tr class="hover:bg-gray-750 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($car->primaryImage)
                                <img src="{{ asset('storage/'.$car->primaryImage->image_path) }}" class="w-12 h-12 rounded object-cover border border-gray-600">
                                @else
                                <div class="w-12 h-12 bg-gray-700 rounded flex items-center justify-center text-[10px] text-gray-500 border border-gray-600">No Pic</div>
                                @endif
                                <div>
                                    <div class="font-bold text-white">{{ $car->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $car->year }} • {{ $car->transmission }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="text-botw-red font-bold">Rp {{ number_format($car->price) }}</div>
                            <div class="text-xs text-gray-500">DP: {{ number_format($car->down_payment) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-900/50 text-green-400 text-[10px] font-bold px-2 py-1 rounded border border-green-700 uppercase tracking-wide">Available</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('dashboard.cars.edit', $car) }}" class="text-blue-400 hover:text-white hover:bg-blue-600 w-8 h-8 flex items-center justify-center rounded transition border border-blue-900/30">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>

                                <form action="{{ route('dashboard.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus unit {{ $car->name }} secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-white hover:bg-red-600 w-8 h-8 flex items-center justify-center rounded transition border border-red-900/30">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-700 bg-gray-800">
            {{ $cars->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection