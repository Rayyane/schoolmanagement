<?php

namespace App\Http\Controllers;

use App\Level;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();

        return view('admin.subjects.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$levels = Level::pluck('class_name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');*/
        return view('admin.subjects.create'/*, ['levels' => $levels, 'teachers' => $teachers]*/);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['subject_name' => 'required|unique:subjects']);
        $data = $request->only('subject_name');
        //dd($data);
        $subject = Subject::create($data);

        return redirect('/subjects')->with('message', 'subject added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        /*$levels = Level::pluck('class_name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');*/
        return view('admin.subjects.edit', ['subject' => $subject/*, 'levels' => $levels, 'teachers' => $teachers*/]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->only('subject_name');

        $subject->update($data);

        return redirect('/subjects')->with('message', 'subject updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        try {
            $subject->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/subjects')->with('message', 'This subject cannot be deleted');
        }

        return redirect('/subjects')->with('message', 'Subject deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $subject = new Subject();

        return $subject->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
