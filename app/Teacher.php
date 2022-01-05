<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Authenticatable
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
