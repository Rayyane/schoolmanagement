<?php

namespace App\Http\Controllers;

use App\Branch;
use App\level;
use App\Shift;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::all();

        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'teacher_name' => 'required|unique:teachers',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'spouse_name' => 'required',
            'teacher_photo' => 'required|mimes:jpeg,bmp,png|unique:teachers',
        ]);
        $teacher_name = $request->input('teacher_name');
        $contact_no = $request->input('contact_no');
        $date_of_birth = $request->input('date_of_birth');
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $spouse_name = $request->input('spouse_name');
        $fathers_name = $request->input('fathers_name');
        $mothers_name = $request->input('mothers_name');
        $present_address = $request->input('present_address');
        $permanent_address = $request->input('permanent_address');
        $salary = $request->input('salary');
        $marital_status = $request->input('marital_status');
        $image = $request->file('teacher_photo');
        $destinationPath = 'public/img/';
        $originalFile = $image->getClientOriginalName();
        $uniqueName = time().$originalFile;
        $image->move($destinationPath, $uniqueName);
        $originalPath = $destinationPath.$uniqueName;
        //dd($originalPath);
        $data = [
            'teacher_name' => $teacher_name, 'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
            'marital_status' => $marital_status, 'spouse_name' => $spouse_name, 'religion' => $religion,
            'nationality' => $nationality, 'contact_no' => $contact_no, 'date_of_birth' => $date_of_birth,
            'teacher_photo' => $originalPath, 'present_address' => $present_address, 'permanent_address' => $permanent_address,
            'salary' => $salary, ];
        $teacher = Teacher::create($data);

        return redirect('/teachers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        /*$levels = $teacher->level()->get();
        $level = $levels->first();
        $shift = Shift::find($level->shift_id);
        $branch = Branch::find($shift->branch_id);*/
        //dd($branch);

        return view('admin.teachers.show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return view('admin.teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $this->validate($request, ['teacher_name' => 'required']);
        $teacher_name = $request->input('teacher_name');
        $contact_no = $request->input('contact_no');
        $date_of_birth = $request->input('date_of_birth');
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $spouse_name = $request->input('spouse_name');
        $fathers_name = $request->input('fathers_name');
        $mothers_name = $request->input('mothers_name');
        $present_address = $request->input('present_address');
        $permanent_address = $request->input('permanent_address');
        $marital_status = $request->input('marital_status');
        $salary = $request->input('salary');
        $image = $request->file('teacher_photo');

        //dd($originalPath);

        if (is_null($image)) {
            //dd($image);
            $data = [
                'teacher_name' => $teacher_name, 'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
                'marital_status' => $marital_status, 'spouse_name' => $spouse_name, 'religion' => $religion,
                'nationality' => $nationality, 'contact_no' => $contact_no, 'date_of_birth' => $date_of_birth,
                'present_address' => $present_address, 'permanent_address' => $permanent_address,
                'salary' => $salary, ];
            $teacher->update($data);

            return redirect('/teachers');
        } else {
            unlink($teacher->teacher_photo);
            //dd($image);
            $destinationPath = 'public/img/';
            $originalFile = $image->getClientOriginalName();
            $uniqueName = time().$originalFile;
            $image->move($destinationPath, $uniqueName);
            $originalPath = $destinationPath.$uniqueName;
            $data = [
                'teacher_name' => $teacher_name, 'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
                'marital_status' => $marital_status, 'spouse_name' => $spouse_name, 'religion' => $religion,
                'nationality' => $nationality, 'contact_no' => $contact_no, 'date_of_birth' => $date_of_birth,
                'teacher_photo' => $originalPath, 'present_address' => $present_address, 'permanent_address' => $permanent_address,
                'salary' => $salary, ];
            $teacher->update($data);

            return redirect('/teachers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        try {
            $teacher->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/teachers')->with('message', 'This teacher cannot be removed');
        }

        return redirect('/teachers')->with('message', 'Teacher removed');
    }

    public function GetDataForDataTable(Request $request)
    {
        $teacher = new Teacher();

        return $teacher->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
