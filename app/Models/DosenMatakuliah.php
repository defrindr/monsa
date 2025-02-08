<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenMatakuliah extends Model
{
    use HasFactory;
    protected $table = 'dosen_matakuliahs';
    protected $fillable = ['dosen_id', 'matkul_id', 'kelas_id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
