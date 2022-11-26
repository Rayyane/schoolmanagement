<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'contact_no', 'email', 'area_id',
    ];

    public function area()
    {
        return $this->belongsTo(\App\Area::class);
    }

    public function shift()
    {
        return $this->hasMany(\App\Shift::class);
    }

    public function level_enroll()
    {
        return $this->hasMany(\App\LevelEnroll::class);
    }

    public function fiscal_year()
    {
        return $this->hasMany(\App\FiscalYear::class);
    }

    public function fees_book()
    {
        return $this->hasMany(\App\FeesBook::class);
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
                ->orwhere('email', 'like', '%'.$search.'%')
                ->orwhere('contact_no', 'like', '%'.$search.'%')
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
