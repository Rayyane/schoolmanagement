<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalReport extends Model
{
    protected $fillable = ['subject_marks', 'student_id', 'final_result_id', 'section_subject_teacher_id'];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function final_result()
    {
        return $this->belongsTo(\App\Models\FinalResult::class);
    }

    public function section_subject_teacher()
    {
        return $this->belongsTo(\App\Models\SectionSubjectTeacher::class);
    }
}
