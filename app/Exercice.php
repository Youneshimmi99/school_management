<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercice extends Model
{
    use SoftDeletes;

    protected $table='exercices';

    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
