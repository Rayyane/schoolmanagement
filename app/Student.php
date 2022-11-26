<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'roll_no', 'fathers_name', 'mothers_name', 'date_of_birth', 'admission_date',
        'nationality', 'religion', 'gender', 'present_address', 'permanent_address', 'mothers_cell',
        'contact_no', 'fathers_cell', 'student_photo',
    ];

    public function section_student()
    {
        return $this->hasOne('App\SectionStudent');
    }

    public function weekly_test_result()
    {
        return $this->hasMany('App\Weekly_Test_Result');
    }

    public function final_report()
    {
        return $this->hasMany('App\FinalReport');
    }

    public function collected_fees()
    {
        return $this->hasMany('App\CollectedFees');
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
                ->orwhere('roll_no', 'like', '%'.$search.'%')
                ->orwhere('contact_no', 'like', '%'.$search.'%')
                ->orwhere('fathers_name', 'like', '%'.$search.'%')
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
