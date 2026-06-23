<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nm_pelanggan',
        'no_hp',
    ];

    public function transaksi()
    {
        return $this->hasMany(
            Transaksi::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }
}
