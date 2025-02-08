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

    public function getFullNameAttribute()
    {
        return "{$this->prodi->name} | {$this->name} {$this->year}";
    }
}
