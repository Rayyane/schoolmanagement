<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionSubjectTeacher extends Model
{
    protected $fillable = ['subject_id', 'teacher_id', 'section_id'];

    public function subject()
    {
        return $this->belongsTo(\App\Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Teacher::class);
    }

    public function section()
    {
        return $this->belongsTo(\App\Section::class);
    }

    public function term_result()
    {
        return $this->hasMany(\App\TermResult::class);
    }

    public function student_subject_result()
    {
        return $this->hasOne(\App\StudentSubjectResult::class);
    }

    public function weekly_test()
    {
        return $this->hasMany(\App\Weekly_Test::class);
    }

    public function final_report()
    {
        return $this->hasMany(\App\FinalReport::class);
    }

    public function countRow()
    {
        $totalData = $this::query();

        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = '', $status = 0)
    {
        $totalData = $this::query();
        $filterData = $this::query();

        if ($status == 1) {
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1) {
            $limit = 999999;
        }

        return [
            'data' => $totalData->with('subject')->with('section.level_enroll.level')
                ->with('teacher')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->count(),
        ];
    }
}
