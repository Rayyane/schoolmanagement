<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedId extends Model
{
    protected $fillable = [
        'student_subject_result_id', 'term_result_id',
    ];

    public function term_result()
    {
        return $this->belongsTo(\App\TermResult::class);
    }

    public function student_subject_result()
    {
        return $this->hasMany(\App\StudentSubjectResult::class);
    }
}
