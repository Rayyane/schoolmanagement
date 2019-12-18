<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        return view('admin.terms.index', ['terms' => $terms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['term_name' => 'required|unique:terms']);
        $data = $request->only('term_name');
        $term = Term::create($data);
        //Session:flash('message', 'Area added');
        return redirect('/terms')->with('message', 'term added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Term::find($id);
        return view ('admin.terms.edit', ['term' => $term]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $data = $request->only('term_name');
        $term -> update($data);
        //Session:flash('message', 'Area added');
        return redirect('/terms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::find($id);
        try {
            $term->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/terms')->with('message', 'This term cannot be deleted');
        }
        
        //Session::flash('message', " $name Has been deleted");
        return redirect('/terms')->with('message', 'Term deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $term = new Term();
        return $term->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
