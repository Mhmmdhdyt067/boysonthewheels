<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/migrate-seed', function () {
    Artisan::call('migrate:fresh --seed');
    Artisan::call('storage:link');
    return redirect()->route('home')->with('success', 'Database Fresh & Seeded!');
});

// Route ini menangani homepage sekaligus hasil filter pencarian
Route::get('/', [CatalogController::class, 'index'])->name('home');

// Halaman Detail Mobil
// Perhatikan parameter {car}. Karena kita menggunakan Friendly Slug,
// Laravel otomatis mencari data berdasarkan kolom 'slug', bukan ID.
Route::get('/mobil/{car}', [CatalogController::class, 'show'])->name('cars.show');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // Redirect /dashboard ke daftar mobil
    Route::get('/', [AdminCarController::class, 'index'])->name('index');

    // Route Resource untuk Mobil (Index, Create, Store, Destroy)
    // 1. LIST DATA (Index)
    Route::get('/cars', [App\Http\Controllers\AdminCarController::class, 'index'])->name('cars.index');

    // 2. FORM TAMBAH (Create) - WAJIB DIATAS {car}
    // Jika ditaruh dibawah {car}, Laravel akan mengira kata "create" adalah slug/id mobil
    Route::get('/cars/create', [App\Http\Controllers\AdminCarController::class, 'create'])->name('cars.create');

    // 3. SIMPAN DATA (Store)
    Route::post('/cars', [App\Http\Controllers\AdminCarController::class, 'store'])->name('cars.store');

    // 4. HAPUS FOTO SPESIFIK (Custom Route) - WAJIB DIATAS {car}
    Route::delete('/cars/image/{id}', [App\Http\Controllers\AdminCarController::class, 'destroyImage'])->name('cars.image.destroy');

    // 5. FORM EDIT
    // Menggunakan {car} agar fitur Route Model Binding tetap jalan (Slug/ID)
    Route::get('/cars/{car}/edit', [App\Http\Controllers\AdminCarController::class, 'edit'])->name('cars.edit');

    // 6. UPDATE DATA
    Route::put('/cars/{car}', [App\Http\Controllers\AdminCarController::class, 'update'])->name('cars.update');

    // 7. HAPUS DATA (Destroy)
    Route::delete('/cars/{car}', [App\Http\Controllers\AdminCarController::class, 'destroy'])->name('cars.destroy');

    Route::resource('testimonials', App\Http\Controllers\AdminTestimonialController::class);
});

// Route untuk Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

// Route untuk Logout (Hanya bisa diakses jika sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
