<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'created_by', 'category_id', 'supplier_id', 'action_date', 'account_name',
        'description', 'amount',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class);
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
            'data' => $totalData->where('account_name', 'like', '%'.$search.'%')
                ->with('category')->with('supplier')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('account_name', 'like', '%'.$search.'%')
                ->count(),
        ];
    }
}
