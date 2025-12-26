<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{
    // Tampilkan Daftar Testimoni
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    // Tampilkan Form Tambah
    public function create()
    {
        return view('admin.testimonials.create');
    }

    // Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'car_purchased' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        ]);

        $path = $request->file('image')->store('testimonials', 'public');

        Testimonial::create([
            'buyer_name' => $request->buyer_name,
            'car_purchased' => $request->car_purchased,
            'message' => $request->message,
            'image_path' => $path,
        ]);

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    // Hapus Data & Foto (Otomatis)
    public function destroy(Testimonial $testimonial)
    {
        // 1. Hapus File Foto dari Storage (jika ada)
        if ($testimonial->image_path && Storage::disk('public')->exists($testimonial->image_path)) {
            Storage::disk('public')->delete($testimonial->image_path);
        }

        // 2. Hapus Data dari Database
        $testimonial->delete();

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
