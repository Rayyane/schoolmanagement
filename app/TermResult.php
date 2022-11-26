<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermResult extends Model
{
    protected $fillable = ['term_marks', 'weekly_avg', 'total_marks', 'section_student_id',
        'section_subject_teacher_id', 'term_id', ];

    public function section_student()
    {
        return $this->belongsTo(\App\SectionStudent::class);
    }

    public function section_subject_teacher()
    {
        return $this->belongsTo(\App\SectionSubjectTeacher::class);
    }

    public function selected_id()
    {
        return $this->hasMany(\App\SelectedId::class);
    }

    public function term()
    {
        return $this->belongsTo(\App\Term::class);
    }
}
