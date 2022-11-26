<?php

namespace App\Http\Controllers;

use App\Branch;
use App\FiscalYear;
use Illuminate\Http\Request;

class FiscalYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiscal_year = FiscalYear::all();

        return view('admin.fiscal_years.index', ['fiscal_year' => $fiscal_year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.fiscal_years.create', ['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, ['year' => 'required',
            'starts_from' => 'required',
            'ends_on' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required',
        ]);
        $data = $request->only('year', 'starts_from', 'ends_on', 'branch_id', 'user_id');
        //dd($data);
        //$user = request()->user()->name;
        $fiscal_year = FiscalYear::create($data);

        return redirect('/fiscal_years')->with('message', 'year added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiscal_year = FiscalYear::find($id);

        return view('admin.fiscal_years.show', ['fiscal_year' => $fiscal_year]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fiscal_year = FiscalYear::find($id);
        $branches = Branch::pluck('name', 'id');

        return view('admin.fiscal_years.edit', ['branches' => $branches, 'fiscal_year' => $fiscal_year]);
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
        $fiscal_year = FiscalYear::find($id);
        $data = $request->only('year', 'starts_from', 'ends_on', 'branch_id', 'user_id');
        $fiscal_year->update($data);

        return redirect('/fiscal_years')->with('message', 'data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $fiscal_year = FiscalYear::find($id);
        try {
            $fiscal_year->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete this year');

            return redirect('/fiscal_years')->with('message', 'This year cannot be deleted');
        }

        return redirect('/fiscal_years')->with('message', 'year deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $fiscal_year = new FiscalYear();

        return $fiscal_year->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
