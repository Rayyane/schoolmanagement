<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelEnroll extends Model
{
    protected $fillable= ['level_id', 'session_id', 'branch_id', 'shift_id'];

    public function level() {
    	return $this->belongsTo('App\Level');
    }

    public function session() {
    	return $this->belongsTo('App\Session');
    }

    public function branch() {
    	return $this->belongsTo('App\Branch');
    }

    public function shift() {
    	return $this->belongsTo('App\Shift');
    }

    public function section() {
    	return $this->hasMany('App\Section');
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
            'data'   =>   $totalData
                ->with('level')
                ->with('session')
                ->with('branch')
                ->with('shift')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->count(),
        );

    }
}
