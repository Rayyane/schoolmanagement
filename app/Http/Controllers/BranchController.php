<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::with('area')->get();

        return view('admin.branches.index', ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('name', 'id');

        return view('admin.branches.create', ['areas' => $areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:branches',
            'address' => 'required',
            'contact_no' => 'required|numeric',
            'email' => 'required|email',
        ]);
        $data = $request->only('name', 'address', 'contact_no', 'email', 'area_id');

        $branch = Branch::create($data);

        return redirect('/branches')->with('message', 'branch added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        $shifts = $branch->shift()->get();

        return view('admin.branches.show', ['branch' => $branch, 'shifts' => $shifts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        $areas = Area::pluck('name', 'id');

        return view('admin.branches.edit', ['branch' => $branch, 'areas' => $areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $data = $request->only('name', 'address', 'contact_no', 'email', 'area_id');
        $branch->update($data);

        return redirect('/branches')->with('message', 'branch updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $branch = Branch::find($id);
        try {
            $branch->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete section');

            return redirect('/branches')->with('message', 'This branch cannot be deleted');
        }

        return redirect('/branches')->with('message', 'Branch deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        /*$areas = Area::all();
        $area = $areas->first();
        dd($area);*/
        $branch = new Branch();
        //$branch = $new_branch->where('area_id', $area->id)->get();
        return $branch->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
