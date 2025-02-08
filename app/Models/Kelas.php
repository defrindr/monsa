<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kelas';
    protected $fillable = ['prodi_id', 'name', 'year'];
    protected $casts = ['deleted_at' => 'datetime'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function kelasMahasiswas()
    {
        return $this->hasMany(KelasMahasiswa::class);
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'kelas_mahasiswas',
            'kelas_id',
            'mahasiswa_id'
        );
    }

    public function matkuls()
    {
        return $this
            ->belongsToMany(
                Matkul::class,
                'dosen_matakuliahs',
                'kelas_id',
                'matakuliah_id',
            )
            ->withPivot('dosen_id')
            ->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->prodi->name} | {$this->name} {$this->year}";
    }
}
