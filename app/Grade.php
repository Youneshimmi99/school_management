<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table='grades';


    public function Cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

    public function Classe()
    {
        return $this->hasMany(Classe::class);
    }
}
