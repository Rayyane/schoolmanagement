<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'level_enroll_id', 'teacher_id', 'section_name',
    ];

    public function level_enroll()
    {
        return $this->belongsTo('App\LevelEnroll');
    }

    public function section_student()
    {
        return $this->hasMany('App\SectionStudent');
    }

    public function section_subject_teacher()
    {
        return $this->hasMany('App\SectionSubjectTeacher');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function final_result()
    {
        return $this->hasMany('App\FinalResult');
    }

    public function section_wise_fees()
    {
        return $this->hasMany('App\SectionWiseFees');
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
            'data' => $totalData->where('section_name', 'like', '%'.$search.'%')
            ->with('level_enroll.level')->with('level_enroll.session')
            ->with('teacher')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('section_name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
