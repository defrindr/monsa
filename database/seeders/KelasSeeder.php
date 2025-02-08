<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['prodi_id' => 1, 'name' => 'TI-1', 'year' => '2022'],
            ['prodi_id' => 2, 'name' => 'TI-2', 'year' => '2022'],
            ['prodi_id' => 3, 'name' => 'TI-3', 'year' => '2022'],

            ['prodi_id' => 1, 'name' => 'TI-1', 'year' => '2023'],
            ['prodi_id' => 2, 'name' => 'TI-2', 'year' => '2023'],
            ['prodi_id' => 3, 'name' => 'TI-3', 'year' => '2023'],
        ];

        Kelas::insert($kelas);
    }
}
