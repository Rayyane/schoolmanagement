<?php

namespace App\Http\Controllers;

use App\Models\SectionStudent;
use Illuminate\Http\Request;

class SectionStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_students = SectionStudent::all();

        return view('admin.section_students.index', ['section_students' => $section_students]);
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
        $section_id = $id;
        $section_students = SectionStudent::where('section_id', $section_id)->get();

        return view('admin.section_students.index', ['section_students' => $section_students]);
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
        $section_students = SectionStudent::find($id);

        try {
            $section_students->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete section');

            return redirect('/sectionStudents')->with('message', 'Section cannot be deleted');
        }

        return redirect('/sectionStudents')->with('message', 'Section deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $section_student = new SectionStudent();

        return $section_student->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
