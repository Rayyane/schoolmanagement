<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubjectResult extends Model
{
    protected $fillable = [
    'student_id', 'section_subject_teacher_id', 'term_id' ,'weekly_test_number', 'weekly_test_marks'
    ];

    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function section_subject_teacher() {
    	return $this->belongsTo('App\SectionSubjectTeacher');
    }

    public function term_result() {
    	return $this->hasMany('App\TermResult');
    }

    public function selected_id() {
        return $this->belongsTo('App\SelectedId');
    }

    public function term() {
        return $this->belongsTo('App\Term');
    }
}
