<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeesBook extends Model
{
    protected $fillable = [
        'branch_id', 'creator_user_id', 'teacher_id', 'total_leaf', 'leaf_start_number',
        'leaf_end_number', 'prefix_id',
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Branch::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Teacher::class);
    }

    public function prefix()
    {
        return $this->belongsTo(\App\Prefix::class);
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
            'data' => $totalData->where('total_leaf', 'like', '%'.$search.'%')
                ->orwhere('leaf_start_number', 'like', '%'.$search.'%')
                ->orwhere('leaf_end_number', 'like', '%'.$search.'%')->with('branch')->with('teacher')
                ->with('prefix')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('total_leaf', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
