<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailBahan extends Model
{
    use HasFactory;

    protected $table = 'detail_bahan';

    protected $primaryKey = 'id_detail_bahan';

    protected $fillable = [
        'id_detail',
        'id_bahan',
        'jumlah_bahan',
    ];

    public function detailTransaksi()
    {
        return $this->belongsTo(
            DetailTransaksi::class,
            'id_detail',
            'id_detail'
        );
    }

    public function bahan()
    {
        return $this->belongsTo(
            Bahan::class,
            'id_bahan',
            'id_bahan'
        );
    }
}