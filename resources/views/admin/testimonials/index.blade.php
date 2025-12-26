@extends('layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard.index') }}" class="text-gray-400 hover:text-white transition bg-gray-800 hover:bg-gray-700 p-2 rounded-lg border border-gray-700">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div>
                <h1 class="text-2xl font-bold text-white brand-font">Daftar Testimoni Klien</h1>
                <p class="text-xs text-gray-400 mt-1">Kelola ulasan dan foto serah terima unit.</p>
            </div>
        </div>

        <a href="{{ route('dashboard.testimonials.create') }}" class="bg-botw-red text-white px-5 py-2.5 rounded-lg shadow-lg hover:bg-red-700 transition flex items-center gap-2 font-bold text-sm">
            <i class="fas fa-plus"></i> Tambah Testimoni
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-600/20 text-green-400 p-4 rounded-lg mb-6 border border-green-600/50 flex items-center gap-3">
        <i class="fas fa-check-circle text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-400 text-sm">
                <thead class="bg-gray-900 text-gray-200 uppercase font-bold text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama Pembeli</th>
                        <th class="px-6 py-4">Unit Dibeli</th>
                        <th class="px-6 py-4">Pesan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($testimonials as $item)
                    <tr class="hover:bg-gray-700/50 transition">
                        <td class="px-6 py-4">
                            <div class="w-16 h-12 rounded overflow-hidden border border-gray-600 relative group">
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-white">{{ $item->buyer_name }}</td>
                        <td class="px-6 py-4">
                            @if($item->car_purchased)
                            <span class="bg-botw-blue/20 text-botw-blue px-2 py-1 rounded text-[10px] font-bold uppercase border border-botw-blue/30">{{ $item->car_purchased }}</span>
                            @else
                            <span class="text-gray-600">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 italic text-gray-400">"{{ Str::limit($item->message, 50) }}"</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('dashboard.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus testimoni ini? Foto juga akan terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-white bg-gray-900 hover:bg-red-600 w-8 h-8 rounded flex items-center justify-center transition shadow border border-gray-700 hover:border-red-500" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-comment-slash text-4xl mb-3 opacity-30"></i>
                                <p>Belum ada data testimoni.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection