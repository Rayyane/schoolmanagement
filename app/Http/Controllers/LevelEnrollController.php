<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use Illuminate\Http\Request;


class LevelEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level_enrolls = LevelEnroll::all();

        return view ('admin.level_enrolls.index', ['level_enrolls' => $level_enrolls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $level_enroll = LevelEnroll::find($id);
        
        //return redirect('/levelEnrolls')->with('message', 'class deleted');
        try{
            $level_enroll->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete class');
            return redirect('/levelEnrolls')->with('message', 'Class cannot be deleted');
        }
        return redirect('/levelEnrolls')->with('message', 'Class deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $level_enroll = new LevelEnroll();
        return $level_enroll->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
