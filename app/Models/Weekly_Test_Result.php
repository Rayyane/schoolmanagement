<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weekly_Test_Result extends Model
{
    protected $fillable = ['weekly_test_id', 'student_id', 'teacher_id', 'weekly_test_marks'];

    public function weekly_test()
    {
        return $this->belongsTo(\App\Models\Weekly_Test::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class);
    }
}
