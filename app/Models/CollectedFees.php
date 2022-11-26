<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectedFees extends Model
{
    protected $fillable = [
        'collector_id', 'section_student_id', 'payment_method_id', 'fees_book_leaf_number',
        'collection_date', 'total_collected', 'total_advanced', 'total_due', 'student_id',
    ];

    public function section_student()
    {
        return $this->belongsTo(\App\Models\SectionStudent::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function countRow()
    {
        $totalData = $this::query();

        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = '', $status = 0, $where = [])
    {
        $totalData = $this::query();
        $filterData = $this::query();
        //dd($totalData);
        if ($status == 1) {
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1) {
            $limit = 999999;
        }

        return [
            'data' => $totalData->where('fees_book_leaf_number', 'like', '%'.$search.'%')
                ->with('section_student.section')->with('section_student.student')
                ->with('section_student.section.level_enroll.level')
                ->with('payment_method')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('fees_book_leaf_number', 'like', '%'.$search.'%')
                ->count(),
        ];
    }

    public function GetListForStudentDataTable($table, $limit = 20, $offset = 0, $search = [], $where = [], $join = false, $joinKey = false)
    {
        $totalData = $this->db;
        $filterData = $this->load->database('default', true);

        if (count($where) > 0) {
            foreach ($where as $keyW => $valueW) {
                if (strpos($keyW, ' and') === false) {
                    $totalData->or_where($keyW, $valueW);
                    $filterData->or_where($keyW, $valueW);
                } else {
                    $keyW = str_replace(' and', '', $keyW);
                    $totalData->where($keyW, $valueW);
                    $filterData->where($keyW, $valueW);
                }
            }
        }

        if (count($search) > 0) {
            foreach ($search as $keyS => $valueS) {
                if ($keyS == 'collected_fee') {
                    $totalData->like('collected_fees.fees_book_leaf_number', $valueS, 'after');
                    $filterData->like('collected_fees.fees_book_leaf_number', $valueS, 'after');
                } else {
                    if (strpos($keyS, ' and') === false) {
                        $totalData->or_like($keyS, $valueS, 'after');
                        $filterData->or_like($keyS, $valueS, 'after');
                    } else {
                        $keyS = str_replace(' and', '', $keyS);
                        $totalData->like($keyS, $valueS, 'after');
                        $filterData->like($keyS, $valueS, 'after');
                    }
                }
            }
        }

        if ($limit > 0) {
            $totalData->limit($limit)->offset($offset);
        }

        /*$totalData->join('working_papers_data wpd', 'wpd.member_id = '.$table.'.id')
        ->join('circulars_data cdata', 'cdata.member_id = '.$table.'.id')
        ->join('circulars cre', 'cre.id = cdata.circular_id')
        ->select('wpd.circular_date, wpd.working_papers_id as working_paper_id');
        $filterData->join('working_papers_data wpd', 'wpd.member_id = '.$table.'.id')
        ->join('circulars_data cdata', 'cdata.member_id = '.$table.'.id')
        ->join('circulars cre', 'cre.id = cdata.circular_id')
        ->select('wpd.circular_date, wpd.working_papers_id as working_paper_id');*/

        $totalData->group_by($table.'.id');
        $filterData->group_by($table.'.id');

        $totalData->order_by($table.'.id', 'DESC');

        $totalData = $totalData->select($table.'.*')->get($table)->result_array();
        $filterData = $filterData->get($table)->num_rows();

        return [
            'data' => $totalData,
            'draw' => 0,
            'recordsTotal' => $this->db->get($table)->num_rows(),
            'recordsFiltered' => $filterData,
        ];
    }
}
