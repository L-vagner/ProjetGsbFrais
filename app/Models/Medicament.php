<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicament extends Model
{
    protected $table = 'medicament';
    protected $primaryKey = 'id_medicament';
    public $timestamps = false;

    public function composants():BelongsToMany
    {
        return $this->belongsToMany(Composant::class,
            'constituer',
            'id_medicament',
            'id_composant')
            ->withPivot('qte_composant');
    }

    public function updateQteComposant($composants)
    {
        foreach ($composants as $composant  => $qteComposant) {
            $this->composants()->updateExistingPivot($composant, ['qte_composant' => $qteComposant]);
        }
    }
}
