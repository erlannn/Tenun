<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_detail
 * @property int $id_transaksi
 * @property int $id_produk
 * @property int $jumlah
 * @property string|null $motif
 * @property-read Transaksi|null $transaksi
 * @property-read Produk|null $produk
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DetailBahan> $detailBahan
 * @mixin \Eloquent
 */
class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jumlah',
        'motif',
    ];

    public function transaksi()
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'id_produk',
            'id_produk'
        );
    }

    public function detailBahan()
    {
        return $this->hasMany(
            DetailBahan::class,
            'id_detail',
            'id_detail'
        );
    }
}