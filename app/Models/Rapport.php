<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rapport extends Model
{
    protected $table = 'rapport_visite';
    protected $primaryKey = 'id_rapport';
    public $timestamps = false;

    public function praticien(): BelongsTo
    {
        return $this->belongsTo(Praticien::class, 'id_praticien', 'id_praticien');
    }

    public function visiteur(): BelongsTo
    {
        return $this->belongsTo(Visiteur::class, 'id_visiteur', 'id_visiteur');
    }

    public function medicaments(): BelongsToMany
    {
        return $this->belongsToMany(
            Rapport::class,
            'offrir',
            'id_rapport',
            'id_medicament'
        )
            ->withPivot('qte_offerte');
    }

    public function updateQteOfferte($medicaments)
    {
        foreach ($medicaments as $id_medoc => $qte) {
            if ($qte <= 0)
                continue;

            $this->medicaments()->syncWithoutDetaching([$id_medoc => ['qte_offerte' => $qte]]);
        }
    }

    public function removeMedocOfferte($id_medoc)
    {
        $this->composants()->detach([$id_medoc]);
    }

}
