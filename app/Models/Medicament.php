<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicament extends Model
{
    protected $table = 'medicament';
    protected $primaryKey = 'id_medicament';
    public $timestamps = false;

    public function composants(): BelongsToMany
    {
        return $this->belongsToMany(Composant::class,
            'constituer',
            'id_medicament',
            'id_composant')
            ->withPivot('qte_composant');
    }

    public function rapports(): BelongsToMany
    {
        return $this->belongsToMany(Rapport::class,
            'offrir',
            'id_medicament',
            'id_rapport')
            ->withPivot('qte_offerte');
    }

    public function famille(): BelongsTo
    {
        return $this->belongsTo(Famille::class, 'id_famille');
    }

    public function updateQteComposant($composants)
    {
        foreach ($composants as $id_compo => $qte) {
            if ($qte <= 0) continue;

            $this->composants()->syncWithoutDetaching([$id_compo => ['qte_composant' => $qte]]);
        }
    }

    public function removeComposant($id_compo)
    {
        $this->composants()->detach([$id_compo]);
    }
}
