<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'name', 'starts_from', 'ends_to',
    ];

    public function level_enroll()
    {
        return $this->hasMany(\App\Models\LevelEnroll::class);
    }

    public function section()
    {
        return $this->hasMany(\App\Models\Section::class);
    }

    public function result()
    {
        return $this->hasMany(\App\Models\Result::class);
    }

    public function section_wise_fees()
    {
        return $this->hasMany(\App\Models\SectionWiseFees::class);
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
            'data' => $totalData->where('name', 'like', '%'.$search.'%')
                ->orwhere('starts_from', 'like', '%'.$search.'%')
                ->orwhere('ends_to', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
