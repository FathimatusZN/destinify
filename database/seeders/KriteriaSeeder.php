<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_kriteria' => 'C1', 'nama_kriteria' => 'Biaya',        'atribut' => 'Cost'],
            ['kode_kriteria' => 'C2', 'nama_kriteria' => 'Aksesibilitas', 'atribut' => 'Benefit'],
            ['kode_kriteria' => 'C3', 'nama_kriteria' => 'Fasilitas',    'atribut' => 'Benefit'],
            ['kode_kriteria' => 'C4', 'nama_kriteria' => 'Jarak',       'atribut'  => 'Cost'],
            ['kode_kriteria' => 'C5', 'nama_kriteria' => 'Rating',       'atribut' => 'Benefit'],
        ];

        foreach ($data as $item) {
            Kriteria::updateOrCreate(['kode_kriteria' => $item['kode_kriteria']], $item);
        }
    }
}
