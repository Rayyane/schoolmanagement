<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSubjectResult extends Model
{
    protected $fillable = [
        'student_id', 'section_subject_teacher_id', 'term_id', 'weekly_test_number', 'weekly_test_marks',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function section_subject_teacher()
    {
        return $this->belongsTo(\App\Models\SectionSubjectTeacher::class);
    }

    public function term_result()
    {
        return $this->hasMany(\App\Models\TermResult::class);
    }

    public function selected_id()
    {
        return $this->belongsTo(\App\Models\SelectedId::class);
    }

    public function term()
    {
        return $this->belongsTo(\App\Models\Term::class);
    }
}
