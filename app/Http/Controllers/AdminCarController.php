<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    // 1. Tampilkan Daftar Mobil (Dashboard)
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    // 2. Tampilkan Form Tambah Mobil
    public function create()
    {
        return view('admin.cars.create');
    }

    // 3. Proses Simpan Data ke Database
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'transmission' => 'required|in:Manual,Automatic',
            'body_type' => 'required|string',
            'row_type' => 'required|in:2 baris,3 baris,Lebih dari 3 baris',
            'mileage' => 'required|numeric',
            'price' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'installment' => 'required|numeric', // Kolom Baru
            'description' => 'required|string',
            'video_link' => 'nullable|url',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp'
        ]);

        $car = Car::create($validated);

        // 2. Simpan Foto dengan Logika Primary Index
        if ($request->hasFile('images')) {
            // Ambil index foto yang dipilih admin sebagai cover (default: 0 / pertama)
            $primaryIndex = $request->input('primary_index', 0);

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    // Cek apakah index ini sama dengan yang dipilih admin
                    'is_primary' => ($index == $primaryIndex),
                    'position' => $index + 1
                ]);
            }
        }

        return redirect()->route('dashboard.cars.index')->with('success', 'Unit berhasil ditambahkan!');
    }

    // 4. Hapus Mobil
    public function destroy(Car $car)
    {
        // Hapus file gambar fisik dari storage
        foreach ($car->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $car->delete(); // Hapus data di DB (Cascade delete akan hapus data gambar di tabel car_images)

        return redirect()->back()->with('success', 'Unit berhasil dihapus.');
    }

    // 4. TAMPILKAN FORM EDIT
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // 5. PROSES UPDATE DATA
    public function update(Request $request, Car $car)
    {
        // 1. Validasi Data Mobil (Code lama tetap sama)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'transmission' => 'required|in:Manual,Automatic',
            'body_type' => 'required|string',
            'row_type' => 'required|in:2 baris,3 baris,Lebih dari 3 baris',
            'mileage' => 'required|numeric',
            'price' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'installment' => 'required|numeric',
            'description' => 'required|string',
            'video_link' => 'nullable|url',
            // Validasi tambahan untuk manajemen foto
            'primary_image_id' => 'nullable|exists:car_images,id',
            'image_order' => 'nullable|string', // Dikirim sebagai string "id,id,id"
            'images.*' => 'image|mimes:jpeg,png,jpg,webp'
        ]);

        // 2. Update Data Text
        $car->update($validated);

        // 3. LOGIC BARU: Update Foto Utama (Cover)
        if ($request->has('primary_image_id')) {
            // Set semua jadi false dulu
            $car->images()->update(['is_primary' => false]);
            // Set yang dipilih jadi true
            $car->images()->where('id', $request->primary_image_id)->update(['is_primary' => true]);
        }

        // 4. LOGIC BARU: Update Urutan Foto (Reorder)
        if ($request->has('image_order')) {
            $orderIds = explode(',', $request->image_order); // "5,3,4" -> [5, 3, 4]
            foreach ($orderIds as $index => $id) {
                $car->images()->where('id', $id)->update(['position' => $index + 1]);
            }
        }

        // 5. Upload Foto Baru (Jika ada)
        if ($request->hasFile('images')) {
            // Cek urutan terakhir
            $lastPosition = $car->images()->max('position') ?? 0;

            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    // Jika belum ada foto sama sekali, jadikan primary. Jika sudah ada, false.
                    'is_primary' => $car->images()->count() == 0,
                    'position' => $lastPosition + 1
                ]);
                $lastPosition++;
            }
        }

        return redirect()->route('dashboard.cars.index')->with('success', 'Data mobil & posisi foto berhasil diperbarui!');
    }

    // 6. FITUR HAPUS SATU FOTO (Opsional, dipanggil via fetch/ajax atau form kecil)
    public function destroyImage($id)
    {
        $image = CarImage::findOrFail($id);

        // Hapus file fisik
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
