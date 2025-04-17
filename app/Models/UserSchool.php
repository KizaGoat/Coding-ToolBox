<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSchool extends Model
{
    // Table name
    protected $table        = 'users_schools';

    // Mass assignable attributes
    protected $fillable     = ['user_id', 'school_id', 'role', 'active'];

    // User relationship (belongs to User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Cohorts relationship (many-to-many)
    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'cohort_user_school');
    }

}
