<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Level;
use App\Result;
use App\Section;
use App\Shift;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('admin.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$levels = Level::with('section')->get();
        $sections = Section::pluck('section_name', 'id');*/
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',
            'roll_no' => 'required',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'date_of_birth' => 'required',
            'admission_date' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'contact_no' => 'required|numeric|unique:students',

            'student_photo' => 'required|mimes:jpeg,bmp,png|unique:students',
        ]);
        $name = $request->input('name');
        $roll_no = $request->input('roll_no');
        $date_of_birth = $request->input('date_of_birth');
        $admission_date = $request->input('admission_date');
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $gender = $request->input('gender');
        $fathers_name = $request->input('fathers_name');
        $mothers_name = $request->input('mothers_name');
        $present_address = $request->input('present_address');
        $permanent_address = $request->input('permanent_address');

        $contact_no = $request->input('contact_no');
        $fathers_cell = $request->input('fathers_cell');
        $mothers_cell = $request->input('mothers_cell');

        /*******/
        $image = $request->file('student_photo');
        $destinationPath = 'public/img/';
        $originalFile = $image->getClientOriginalName();
        $uniqueName = date('Y-m-d').$originalFile;
        $image->move($destinationPath, $uniqueName);
        $originalPath = $destinationPath.$uniqueName;
        $data = ['name' => $name, 'roll_no' => $roll_no,
            'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
            'date_of_birth' => $date_of_birth, 'admission_date' => $admission_date,
            'nationality' => $nationality, 'religion' => $religion, 'gender' => $gender,
            'present_address' => $present_address, 'permanent_address' => $permanent_address,
            'mothers_cell' => $mothers_cell,
            'contact_no' => $contact_no, 'fathers_cell' => $fathers_cell, 'student_photo' => $originalPath, ];
        $student = Student::create($data);

        return redirect('/students')->with('message', 'New Student Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        /*$level = Level::find($student->level_id);
        $shift = Shift::find($level->shift_id);
        $branches = Branch::find($shift->branch_id);*/
        //dd($shift);
        return view('admin.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $levels = Level::pluck('class_name', 'id');
        $sections = Section::pluck('section_name', 'id');

        return view('admin.students.edit', ['student' => $student, 'levels' => $levels, 'sections' => $sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $name = $request->input('name');
        $roll_no = $request->input('roll_no');
        $date_of_birth = $request->input('date_of_birth');
        $admission_date = $request->input('admission_date');
        $nationality = $request->input('nationality');
        $religion = $request->input('religion');
        $gender = $request->input('gender');
        $fathers_name = $request->input('fathers_name');
        $mothers_name = $request->input('mothers_name');
        $present_address = $request->input('present_address');
        $permanent_address = $request->input('permanent_address');

        $contact_no = $request->input('contact_no');
        $fathers_cell = $request->input('fathers_cell');
        $mothers_cell = $request->input('mothers_cell');
        /*******/
        $image = $request->file('student_photo');

        if (is_null($image)) {
            $data = ['name' => $name, 'roll_no' => $roll_no,
                'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
                'date_of_birth' => $date_of_birth, 'admission_date' => $admission_date,
                'nationality' => $nationality, 'religion' => $religion, 'gender' => $gender,
                'present_address' => $present_address, 'permanent_address' => $permanent_address,
                'mothers_cell' => $mothers_cell,
                'contact_no' => $contact_no, 'fathers_cell' => $fathers_cell, ];

            $student->update($data);

            return redirect('/students')->with('message', 'Student updated');
        } else {
            unlink($student->student_photo);
            $destinationPath = 'public/img/';
            $originalFile = $image->getClientOriginalName();
            $uniqueName = date('Y-m-d').$originalFile;
            $image->move($destinationPath, $uniqueName);
            $originalPath = $destinationPath.$uniqueName;
            $data = ['name' => $name, 'roll_no' => $roll_no,
                'fathers_name' => $fathers_name, 'mothers_name' => $mothers_name,
                'date_of_birth' => $date_of_birth, 'admission_date' => $admission_date,
                'nationality' => $nationality, 'religion' => $religion, 'gender' => $gender,
                'present_address' => $present_address, 'permanent_address' => $permanent_address,
                'mothers_cell' => $mothers_cell,
                'contact_no' => $contact_no, 'fathers_cell' => $fathers_cell, 'student_photo' => $originalPath, ];

            $student->update($data);

            return redirect('/students')->with('message', 'Student updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        try {
            $student->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/students')->with('message', 'This student cannot be deleted');
        }

        return redirect('/students')->with('message', 'Student deleted');
    }

    public function showResult($id)
    {
        /*Subject::all();
        Result::all();*/
        $student = Student::find($id);

        $level = Level::find($student->level_id);
        /*$result = $student->result()->get();
        dd($result);*/
        $subjects = $level->subject()->get();
        dd($subjects);

        //dd($result);
        //$className = $level->class_name;

        return view('admin.weeklytests.index', ['student' => $student, 'level' => $level, 'subjects' => $subjects/*'result'=>$result*/]);
    }

    public function saveResult(Request $request)
    {
    }

    public function GetDataForDataTable(Request $request)
    {
        $student = new Student();

        return $student->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
