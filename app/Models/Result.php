<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'test_number', 'subject_marks', 'session_id'];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    public function session()
    {
        return $this->belongsTo(\App\Models\Session::class);
    }

    public function countRow()
    {
        $totalData = $this::query();

        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 0, $offset = 0, $search = '', $status = 0)
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
            'data' => $totalData->where('test_number', 'like', '%'.$search.'%')->with('student')->with('subject')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('test_number', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
