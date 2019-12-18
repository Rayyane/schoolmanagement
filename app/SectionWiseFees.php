<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionWiseFees extends Model
{
    protected $fillable = [
    	'user_id', 'session_id', 'section_id', 'fees_type_id', 'business_month_id', 'amount'
    ];

    public function session() {
    	return $this->belongsTo('App\Session');
    }

    public function section() {
    	return $this->belongsTo('App\Section');
    }

    public function fees_type() {
    	return $this->belongsTo('App\FeesType');
    }

    public function business_month() {
    	return $this->belongsTo('App\BusinessMonth');
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
            'data'   =>   $totalData->where('amount', 'like', '%'.$search.'%')
                ->with('session')->with('section.level_enroll.level')->with('fees_type')->with('business_month')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('amount', 'like', '%'.$search.'%')
                ->count(),
        );

    }
}
