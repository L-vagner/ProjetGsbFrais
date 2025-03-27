<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Composant extends Model
{
    protected $table = 'composant';
    protected $primaryKey = 'id_composant';
    public $timestamps = false;
}
