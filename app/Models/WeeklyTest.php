<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyTest extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'weekly_test_name'];

    public function student()
    {
        return $this->hasMany(\App\Models\Student::class);
    }

    public function subject()
    {
        return $this->hasMany(\App\Models\Subject::class);
    }
}
