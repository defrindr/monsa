<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [
            ['name' => 'Matematika'],
            ['name' => 'Fisika'],
            ['name' => 'Kimia'],
            ['name' => 'GIS'],
            ['name' => 'Pengembangan aplikasi bergerak'],
            ['name' => 'Sistem Informasi'],
            ['name' => 'Ilmu Komputer'],
            ['name' => 'Ilmu Kesehatan'],
            ['name' => 'Ilmu Administrasi'],
            ['name' => 'Ilmu Hukum'],
        ];

        Matkul::insert($list);
    }
}
