<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $table='cycles';

    public function Grades(){

        return $this->hasMany(Grade::class); //!!
     }
}
