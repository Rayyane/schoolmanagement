<?php

namespace App\Http\Controllers;

use App\Category;
use App\Supplier;
use App\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucher = Voucher::all();

        return view('admin.vouchers.index', ['voucher' => $voucher]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('supplier')->get();
        $suppliers = Supplier::pluck('supplier_name', 'id');

        return view('admin.vouchers.create', ['categories' => $categories, 'suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['created_by' => 'required',
            'category_id' => 'required',
            'action_date' => 'required',
            'account_name' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ]);
        $data = $request->only('created_by', 'category_id', 'supplier_id', 'action_date',
            'account_name', 'description', 'amount'
        );
        $voucher = Voucher::create($data);

        return redirect('/vouchers')->with('message', 'Voucher created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);

        return view('admin.vouchers.show', ['voucher' => $voucher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::find($id);
        $categories = Category::pluck('category_name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');

        return view('admin.vouchers.edit', ['categories' => $categories, 'suppliers' => $suppliers,
            'voucher' => $voucher, ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);
        $this->validate($request, ['created_by' => 'required',
            'category_id' => 'required',
            'action_date' => 'required',
            'account_name' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ]);
        $data = $request->only('created_by', 'category_id', 'supplier_id', 'action_date',
            'account_name', 'description', 'amount'
        );
        $voucher->update($data);

        return redirect('/vouchers')->with('message', 'voucher updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        try {
            $voucher->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete this voucher');

            return redirect('/vouchers')->with('message', 'This voucher cannot be deleted');
        }

        return redirect('/vouchers')->with('message', 'voucher deleted!');
    }

    public function GetDataForDataTable(Request $request)
    {
        $voucher = new Voucher();

        return $voucher->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
