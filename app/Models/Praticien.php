<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Praticien extends Model
{
    protected $table = 'praticien';
    protected $primaryKey = 'id_praticien';
    public $timestamps = false;

    public function rapports(): hasMany
    {
        return $this->hasMany(Rapport::class, 'id_rapport');
    }

}
