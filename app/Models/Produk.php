<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_produk
 * @property string $nm_produk
 * @property int $id_kategori
 * @property string|null $foto
 * @property string|float $harga
 * @property-read Kategori|null $kategori
 * @mixin \Eloquent
 */
class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; 

    protected $fillable = [
        'nm_produk',
        'id_kategori',
        'foto',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}