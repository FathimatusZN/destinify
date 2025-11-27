<?php
// database/seeders/AlternatifSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;

class AlternatifSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_alternatif' => 'A1',
                'nama_wisata' => 'Air Terjun Coban Rondo',
                'jenis_wisata' => 'alam',
                'latitude' => -7.8954,
                'longitude' => 112.4832,
                'jarak_default' => 114,
                'biaya_masuk' => 35000,
                'biaya_normalisasi' => 35,
                'aksesibilitas' => 5,
                'fasilitas' => 5,
                'rating' => 4.5,
            ],
            // tambahkan data lainnya...
        ];

        foreach ($data as $item) {
            Alternatif::updateOrCreate(
                ['kode_alternatif' => $item['kode_alternatif']],
                $item
            );
        }
    }
}
