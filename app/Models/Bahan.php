<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahan';

    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'nm_bahan',
        'harga',
        'stok',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function detailBahan()
    {
        return $this->hasMany(
            DetailBahan::class,
            'id_bahan',
            'id_bahan'
        );
    }
}