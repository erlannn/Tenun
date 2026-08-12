<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_motif
 * @property string $nm_motif
 * @property-read \Illuminate\Database\Eloquent\Collection<int, DetailTransaksi> $detailTransaksi
<<<<<<< HEAD
 * @mixin \Illuminate\Database\Eloquent\Builder
=======
 * @mixin \Eloquent
>>>>>>> 8c89cb9596ac0defa5eadc7b25660d01146aa6e5
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
