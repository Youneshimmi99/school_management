<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
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
}
