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

    public function Classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function Course()
    {
        return $this->hasMany(Course::class);
    }
}
