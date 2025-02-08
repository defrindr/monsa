<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matkuls';
    protected $fillable = ['name'];
    protected $casts = ['deleted_at' => 'datetime'];

    public function dosenMatakuliahs()
    {
        return $this->hasMany(DosenMatakuliah::class, 'matakuliah_id');
    }
}
