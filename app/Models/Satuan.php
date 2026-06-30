<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';

    protected $fillable = [
        'nm_satuan',
    ];

    public function bahan()
    {
        return $this->hasMany(Bahan::class, 'id_satuan', 'id_satuan');
    }
}
