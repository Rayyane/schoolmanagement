<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{
	protected $fillable= ['section_id', 'student_id'];

	public function section() {
		return $this->belongsTo('App\Section');
	}

	public function student() {
		return $this->belongsTo('App\Student');
	}

    public function term_result() {
        return $this->hasMany('App\TermResult');
    }

    public function collected_fees() {
        return $this->hasMany('App\CollectedFees');
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
            'data'   =>   $totalData->with('student')->with('section.level_enroll.level')
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
