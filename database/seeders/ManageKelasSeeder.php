<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManageKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listKelas = Kelas::get();
        foreach ($listKelas as $kelas) {
            $mataKuliah = Matkul::inRandomOrder()->limit(4)->get();
            foreach ($mataKuliah as $matkul) {
                $dosen = Dosen::inRandomOrder()->first();

                $kelas->matkuls()->attach($matkul->id, [
                    'dosen_id' => $dosen->id,
                ]);
            }

            $mahasiswa = Mahasiswa::inRandomOrder()->limit(10)->get();
            foreach ($mahasiswa as $m) {
                $kelas->mahasiswas()->attach($m->id);
            }
        }
    }
}
