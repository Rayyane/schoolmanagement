<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['class_name', 'num_of_sub'];

    public function level_enroll()
    {
        return $this->hasMany(\App\Models\LevelEnroll::class);
    }

    /*public function session() {
        return $this->belongsTo('App\Session');
    }*/

    /*public function shift() {
        return $this->belongsTo('App\Shift');
    }*/

    /* public function section() {
          return $this->hasMany('App\Section');
     }

     public function subject() {
         return $this->hasMany('App\Subject');
     }

     public function teacher()
     {
         return $this->belongsTo('App\Teacher');
     }

     public function student() {
         return $this->hasMany('App\Student');
     }*/

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
            'data' => $totalData->where('class_name', 'like', '%'.$search.'%')/*->with('teacher')->with('shift')*/
                ->orwhere('num_of_sub', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('class_name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
