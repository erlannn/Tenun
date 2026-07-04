<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_bahan
 * @property string $nm_bahan
 * @property int $id_satuan
 * @property string|float $harga
 * @property int $stok
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DetailBahan> $detailBahan
 * @property-read Satuan|null $satuan
 * @mixin \Eloquent
 */
class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahan';
    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'nm_bahan',
        'id_satuan',
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

    public function satuan()
    {
        return $this->belongsTo(
            Satuan::class,
            'id_satuan',
            'id_satuan'
        );
    }

}