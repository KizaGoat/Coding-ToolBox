<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    // Table name
    protected $table        = 'cohorts';

    // Mass assignable attributes
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date', 'teacher_id'];

    // Many-to-many relationship with UserSchool
    public function userSchools()
    {
        return $this->belongsToMany(UserSchool::class, 'cohort_user_school');
    }

}
