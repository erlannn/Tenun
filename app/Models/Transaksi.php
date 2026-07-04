<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_transaksi
 * @property int $id_pelanggan
 * @property \Illuminate\Support\Carbon|null $tanggal_pesan
 * @property \Illuminate\Support\Carbon|null $tanggal_selesai
 * @property string $jenis_transaksi
 * @property string $status
 * @property-read Pelanggan|null $pelanggan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DetailTransaksi> $detailTransaksi
 * @mixin \Eloquent
 */
class Transaksi extends Model
{
    use HasFactory;

    public const JENIS_PREORDER = 'PreOrder';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_SELESAI = 'selesai';

    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_pelanggan',
        'tanggal_pesan',
        'tanggal_selesai',
        'jenis_transaksi',
        'status',
    ];

    protected $casts = [
        'tanggal_pesan' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function detailTransaksi()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }
}