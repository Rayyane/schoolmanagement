<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermResult extends Model
{
    protected $fillable = ['term_marks', 'weekly_avg', 'total_marks', 'section_student_id',
        'section_subject_teacher_id', 'term_id', ];

    public function section_student()
    {
        return $this->belongsTo(\App\Models\SectionStudent::class);
    }

    public function section_subject_teacher()
    {
        return $this->belongsTo(\App\Models\SectionSubjectTeacher::class);
    }

    public function selected_id()
    {
        return $this->hasMany(\App\Models\SelectedId::class);
    }

    public function term()
    {
        return $this->belongsTo(\App\Models\Term::class);
    }
}
