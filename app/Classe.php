<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use SoftDeletes;

    protected $table='classes';

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function Option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function Students()
    {
        return $this->hasMany(Student::class);
    }

    public function Teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_classes','class_id','teacher_id');    
    }



}
