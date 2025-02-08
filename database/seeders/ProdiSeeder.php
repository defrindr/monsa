<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            ['name' => 'Teknik Informatika'],
            ['name' => 'Sistem Informasi'],
            ['name' => 'Manajemen Informatika'],
            ['name' => 'Komputer dan Bisnis'],
            ['name' => 'Arsitektur dan Organisasi Komputer'],
            ['name' => 'Teknologi Informasi dan Komunikasi'],
            ['name' => 'Ilmu Komputer'],
            ['name' => 'Ilmu Kedokteran'],
            ['name' => 'Ilmu Sosial'],
            ['name' => 'Ilmu Administrasi'],
            ['name' => 'Ilmu Hukum'],
            ['name' => 'Ilmu Ekonomi'],
            ['name' => 'Ilmu Pendidikan'],
            ['name' => 'Ilmu Agama'],
            ['name' => 'Ilmu Bahasa Inggris'],
            ['name' => 'Ilmu Sejarah'],
            ['name' => 'Ilmu Keperawatan'],
            ['name' => 'Ilmu Kesehatan Masyarakat'],
            ['name' => 'Ilmu Gizi'],
            ['name' => 'Ilmu Matematika'],
            ['name' => 'Ilmu Fisika'],
            ['name' => 'Ilmu Biologi'],
            ['name' => 'Ilmu Kimiya'],
            ['name' => 'Ilmu Geografi'],
            ['name' => 'Ilmu Sejarah Indonesia'],
            ['name' => 'Ilmu Bahasa Jawa'],
            ['name' => 'Ilmu Bahasa Sunda'],
            ['name' => 'Ilmu Bahasa Inggris'],
            ['name' => 'Ilmu Bahasa Rusia'],
            ['name' => 'Ilmu Bahasa Arab'],
            ['name' => 'Ilmu Bahasa Tionghoa'],
            ['name' => 'Ilmu Bahasa Melayu'],
            ['name' => 'Ilmu Bahasa Jepang'],
            ['name' => 'Ilmu Bahasa Korea'],
            ['name' => 'Ilmu Bahasa China'],
        ];

        // Bulk operations
        \App\Models\Prodi::insert($prodis);
    }
}
