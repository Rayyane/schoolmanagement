<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'branch_id', 'shift_name',
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Branch::class);
    }

    public function level_enroll()
    {
        return $this->hasMany(\App\LevelEnroll::class);
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
            'data' => $totalData->where('shift_name', 'like', '%'.$search.'%')->with('branch')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('shift_name', 'like', '%'.$search.'%')
                ->count(),
            'draw' => 0,
        ];
    }
}
