<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function medicaments(): BelongsToMany
    {
        return $this->belongsToMany(Rapport::class,
            'offrir',
            'id_rapport',
            'id_medicament')
            ->withPivot('qte_offerte');
    }

}
