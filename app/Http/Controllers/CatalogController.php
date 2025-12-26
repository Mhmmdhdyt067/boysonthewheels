<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan Scope 'filter' yang kita buat tadi
        // with('primaryImage') untuk mencegah N+1 Query Problem (Optimasi Perform)
        $cars = Car::latest()
            ->with('primaryImage')
            ->filter($request->all()) // Magic happens here
            ->paginate(12) // Pagination ala Shopee
            ->withQueryString(); // Agar filter tidak hilang saat ganti halaman

        // TAMBAHAN: Ambil data testimoni
        $testimonials = \App\Models\Testimonial::latest()->take(10)->get();

        return view('catalog.index', [
            'cars' => $cars,
            'testimonials' => $testimonials // Kirim ke view
        ]);
    }

    public function show(Car $car)
    {
        // Load semua gambar untuk detail
        $car->load('images');

        // Data Perusahaan (Bisa diambil dari database settings atau config)
        $company = [
            'wa' => '6281234567890', // Format internasional tanpa +
            'address' => 'Jl. Jenderal Sudirman No. 1, Jakarta',
            'maps_link' => 'https://goo.gl/maps/example',
            'instagram' => '@mobilmurah.id'
        ];

        return view('catalog.show', compact('car', 'company'));
    }
}
