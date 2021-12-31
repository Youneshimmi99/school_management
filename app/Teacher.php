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

    public function Courses()
    {
        return $this->hasMany(Course::class);
    }

    public function Exams()
    {
        return $this->hasMany(Exam::class);
    }
}
