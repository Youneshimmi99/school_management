<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    protected $table='teachers';

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
