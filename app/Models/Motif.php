<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_motif
 * @property string $nm_motif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DetailTransaksi> $detailTransaksi
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Motif extends Model
{
    use HasFactory;

    protected $table = 'motif';
    protected $primaryKey = 'id_motif';

    protected $fillable = [
        'nm_motif',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_motif', 'id_motif');
    }
}
