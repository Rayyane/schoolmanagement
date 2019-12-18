<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $fillable = ['year', 'branch_id', 'user_id', 'starts_from', 'ends_on'];

    public function branch() {
    	return $this->belongsTo('App\Branch');
    }

    public function business_month() {
    	return $this->hasMany('App\BusinessMonth');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = "", $status = 0){
        $totalData = $this::query();
        $filterData = $this::query();

        if ($status == 1){
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1)
            $limit = 999999;

        return array(
            'data'   =>   $totalData->where('year', 'like', '%'.$search.'%')
                ->with('branch')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('year', 'like', '%'.$search.'%')
                ->count(),
        );

    }
}
