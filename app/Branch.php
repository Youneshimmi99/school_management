<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table='branchs';

    public function Classe()
    {
        return $this->hasMany(Classe::class);
    }
}
