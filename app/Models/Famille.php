<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    protected $table = 'famille';
    protected $primaryKey = 'id_famille';
    public $timestamps = false;


    public function medicaments()
    {
        return $this->hasMany(Medicament::class, 'id_famille');
    }
}
