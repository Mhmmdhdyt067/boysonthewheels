<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

class Car extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                // Mengambil sumber dari 3 kolom agar unik dan deskriptif
                // Hasil: toyota-avanza-g-matic-2022
                'source' => ['brand', 'name', 'year']
            ]
        ];
    }

    // 4. Route Model Binding
    // Memberitahu Laravel: "Kalau cari mobil di URL, pakai kolom 'slug', bukan 'id'"
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke Foto
    public function images()
    {
        // Tambahkan ->orderBy('position') agar di frontend & admin urutannya benar
        return $this->hasMany(CarImage::class)->orderBy('position', 'asc');
    }

    // Ambil foto utama saja (untuk thumbnail katalog)
    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }

    // --- SEARCH ENGINE LOGIC (SCOPE) ---
    // Pastikan ini ada di paling atas file

    public function scopeFilter(Builder $query, array $filters)
    {
        // 1. Filter Search Engine Utama (Mencakup Nama & MEREK)
        // Ini menjawab request: "user bisa mencari berdasarkan merek di search engine utama"
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%');
            });
        });

        // 2. Filter Row Type (PENGGANTI Filter Merek)
        $query->when($filters['row_type'] ?? false, function ($query, $row) {
            if ($row == "") return $query;
            return $query->where('row_type', $row);
        });

        // 3. Filter Model (Body Type) - Diperbaiki
        $query->when($filters['model'] ?? false, function ($query, $model) {
            if ($model == "") return $query;
            return $query->where('body_type', $model);
        });

        // 4. Filter TAHUN (Year Range) - Diperbaiki
        $query->when($filters['year_range'] ?? false, function ($query, $range) {
            return match ($range) {
                'below_2000' => $query->where('year', '<', 2000), // 2000 Kebawah (sebelum 2000)
                '2000_2010'  => $query->whereBetween('year', [2000, 2010]),
                '2010_2020'  => $query->whereBetween('year', [2010, 2020]),
                'above_2020' => $query->where('year', '>', 2020), // 2020 ke atas
                default      => $query // PENTING: Mencegah error jika value tidak dikenali
            };
        });

        // 5. Filter HARGA (Price Range) - Diperbaiki
        $query->when($filters['price_range'] ?? false, function ($query, $range) {
            return match ($range) {
                'under_100' => $query->where('price', '<', 100000000),
                '100_range' => $query->whereBetween('price', [100000000, 199999999]),
                '200_range' => $query->whereBetween('price', [200000000, 299999999]),
                'above_300' => $query->where('price', '>=', 300000000),
                default     => $query
            };
        });

        // 6. Filter DP (UPDATED: Logic Budget Maksimal & Cash Only)
        $query->when($filters['dp_range'] ?? false, function ($query, $range) {
            return match ($range) {
                // Filter Khusus: Cash Only (DP dianggap 0)
                'cash_only' => $query->where('down_payment', 0),

                // Logic: Mencari dari 0 sampai Nilai Maksimal (<=)
                'max_5'     => $query->where('down_payment', '<=', 5000000),  // 0 - 5 Juta
                'max_10'    => $query->where('down_payment', '<=', 10000000), // 0 - 10 Juta
                'max_20'    => $query->where('down_payment', '<=', 20000000), // 0 - 20 Juta
                'max_50'    => $query->where('down_payment', '<=', 50000000), // 0 - 50 Juta
                'above_50'  => $query->where('down_payment', '>', 50000000),  // Khusus > 50 Juta (Opsional, buat sultan)
                default     => $query
            };
        });

        // 7. Filter ANGSURAN (UPDATED: Logic Kemampuan Bayar Maksimal)
        $query->when($filters['installment_range'] ?? false, function ($query, $range) {
            return match ($range) {
                'max_2'     => $query->where('installment', '<=', 2000000), // 0 - 2 Juta
                'max_4'     => $query->where('installment', '<=', 4000000), // 0 - 4 Juta
                'max_8'     => $query->where('installment', '<=', 8000000), // 0 - 8 Juta
                'above_8'   => $query->where('installment', '>', 8000000),  // Di atas 8 Juta
                default     => $query
            };
        });
    }
}
