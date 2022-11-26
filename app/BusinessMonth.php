<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessMonth extends Model
{
    protected $fillable = [
        'user_id', 'fiscal_year_id', 'month_name', 'starts_from', 'ends_on', 'last_payment_date',
    ];

    public function fiscal_year()
    {
        return $this->belongsTo(\App\FiscalYear::class);
    }

    public function section_wise_fees()
    {
        return $this->hasMany(\App\SectionWiseFees::class);
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
            'data' => $totalData->where('month_name', 'like', '%'.$search.'%')
                ->with('fiscal_year')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('month_name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
