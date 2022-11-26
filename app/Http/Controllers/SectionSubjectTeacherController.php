<?php

namespace App\Http\Controllers;

use App\Models\SectionSubjectTeacher;
use Illuminate\Http\Request;

class SectionSubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_subject_teacher = SectionSubjectTeacher::all();

        return view('admin.section_subject_teachers.index', ['section_subject_teachers' => $section_subject_teacher]);
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
    public function destroy($id)
    {
        $section_subject_teacher = SectionSubjectTeacher::find($id);
        try {
            $section_subject_teacher->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sectionSubjectTeachers')->with('message', 'This subject cannot be deleted');
        }

        return redirect('/sectionSubjectTeachers')->with('message', 'Subject deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $section_subject_teacher = new SectionSubjectTeacher();

        return $section_subject_teacher->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
