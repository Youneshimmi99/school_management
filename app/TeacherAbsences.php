<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAbsences extends Model
{
    protected $table='teacher_absences';

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
