<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::with('branch')->get();
        //$area = Area::all();
        return view('admin.shifts.index', ['shifts' => $shifts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');

        return view('admin.shifts.create', ['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['shift_name' => 'required']);
        $data = $request->only('branch_id', 'shift_name');
        $shift = Shift::create($data);

        return redirect('/shifts')->with('message', 'shift added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        $branches = Branch::find($shift->branch_id);
        //dd($branches);
        return view('admin.shifts.show', ['shift' => $shift, 'branches' => $branches]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shift = Shift::find($id);
        $branches = Branch::pluck('name');

        return view('admin.shifts.edit', ['shift' => $shift, 'branches' => $branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $data = $request->only('shift_name', 'branch_id');
        $shift->update($data);
        //Session:flash('message', 'Area added');
        return redirect('/shifts')->with('message', 'shift updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);
        try {
            $shift->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/shifts')->with('message', 'This shift cannot be deleted');
        }

        return redirect('/shifts')->with('message', 'Shift deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $shift = new Shift();

        return $shift->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
