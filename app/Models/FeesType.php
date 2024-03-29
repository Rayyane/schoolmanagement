<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    protected $fillable = [
        'user_id', 'fees_type_name',
    ];

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
            'data' => $totalData->where('fees_type_name', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('fees_type_name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
