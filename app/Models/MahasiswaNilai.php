<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaNilai extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_nilais';
    protected $fillable = ['kelas_id', 'matkul_id', 'mahasiswa_id', 'nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
