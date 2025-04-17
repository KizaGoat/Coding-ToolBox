<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date', 'teacher_id'];

    public function userSchools()
    {
        return $this->belongsToMany(UserSchool::class, 'cohort_user_school');
    }

}
