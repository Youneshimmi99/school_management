<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table='courses';

    public function Exercices()
    {
        return $this->hasMany(Exercice::class);
    }

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
