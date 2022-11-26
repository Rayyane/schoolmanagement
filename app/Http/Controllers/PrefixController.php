<?php

namespace App\Http\Controllers;

use App\Prefix;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prefix = Prefix::all();

        return view('admin.prefixes.index', ['prefix' => $prefix]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prefixes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['prefix' => 'required|unique:prefixes',
            'created_by' => 'required', ]);
        $data = $request->only('prefix', 'created_by');
        $prefix = Prefix::create($data);

        return redirect('/prefixes')->with('message', 'prefix added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prefix = Prefix::find($id);

        return view('admin.prefixes.show', ['prefix' => $prefix]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prefix = Prefix::find($id);

        return view('admin.prefixes.edit', ['prefix' => $prefix]);
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
        $prefix = Prefix::find($id);
        $this->validate($request, ['prefix' => 'required|unique:prefixes',
            'created_by' => 'required', ]);
        $data = $request->only('prefix', 'created_by');
        $prefix->update($data);

        return redirect('/prefixes')->with('message', 'prefix updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prefix = Prefix::find($id);
        $prefix->delete();

        return redirect('/prefixes')->with('message', 'prefix deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $prefixes = new Prefix();

        return $prefixes->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
