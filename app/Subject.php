<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table='subjects';

    public function Teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
