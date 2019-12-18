<?php

namespace App\Http\Controllers;

use App\Level;
use App\Section;
use App\Session;
use App\LevelEnroll;
use App\Teacher;
use App\Student;
use App\SectionStudent;
use App\Subject;
use App\SectionSubjectTeacher;
use Illuminate\Http\Request;
use Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::with('level_enroll', 'teacher');
        return view ('admin.sections.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$sections = Section::with('level', 'session')->get();
        $level_enroll = Session::with('level_enroll.level')->get();
        //dd($level_enroll);
        $teachers = Teacher::pluck('teacher_name', 'id');
        //$level_id = $level_enroll->first()->level_id;
        //dd($level_enroll);
        //$level = Level::where('id', $level_id)->first();
        //dd($level_enroll);
        //$levels = Level::pluck('class_name', 'id');
        //$sessions = Session::pluck('name', 'id');
        return view ('admin.sections.create', ['levels' => $level_enroll, 'teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['section_name' => 'required']);
        $data = $request->only('section_name', 'teacher_id', 'level_enroll_id');
        $section = Section::create($data);
        return redirect('/sections')->with('message', 'New Section Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)

    {

        $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
        //dd($level);
        $teacher = Teacher::find($section->teacher_id);
        
        //dd($session);
        return view('admin.sections.show', ['section' => $section, 'level'=>$level,'teacher'=>$teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::find($id);
        $level_enroll = Session::with('level_enroll.level')->get();
        //dd($level_enroll);
        $teachers = Teacher::pluck('teacher_name', 'id');
        return view ('admin.sections.edit', ['section' => $section, 'levels' => $level_enroll, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $data = $request->only('section_name');
        $section->update($data);
        return redirect('/sections')->with('message', 'Section updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        try{
            $section->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sections')->with('message', 'This section cannot be deleted');
        }
        
        return redirect('/sections')->with('message', 'Section deleted');
    }

    public function assignStudent($id) {
        $section = Section::find($id);
        $students = Student::pluck('name', 'id');
        return view('admin.sections.add_student', ['students' => $students, 'section' => $section]);
    }

    public function saveStudents(Request $request) {
        /*$data = $request->student_id;
        $section_id = $request->section_id;*/
        //dd($section_id);

        for ($i = 0; $i < count($request->student_id); $i++) {
            $this->validate($request, ['student_id' => 'required|unique:section_students']);
            $student_id = $request->student_id[$i];
            $section_id = $request->section_id;
            $data = ['student_id' => $student_id, 'section_id' => $section_id];
            $section_student = SectionStudent::create($data);
        }
        return redirect('/sectionStudents');
    }

    public function assignSubject($id) {
        $section = Section::find($id);
        $subjects = Subject::pluck('subject_name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');
        return view('admin.sections.add_subject', ['subjects' => $subjects, 'section' => $section,
        'teachers' => $teachers]);
    }

    public function saveSubject(Request $request) {
        $subject_id = $request->input('subject_id');
        $teacher_id = $request->input('teacher_id');
        $section_id = $request->input('section_id');
        $data = ['subject_id' => $subject_id, 'teacher_id' => $teacher_id, 
            'section_id' => $section_id];
        

        $validation = Validator::make([
                'subject_id' => $subject_id, 
                'teacher_id' => $teacher_id,
                'section_id' => $section_id
                ], [], []);
            $validation->after(function ($validation) use($subject_id, $teacher_id, $section_id) {
            $checkCombination = SectionSubjectTeacher::where('subject_id', $subject_id)
            ->where('teacher_id', $teacher_id)
            ->where('section_id', $section_id)
            ->get();

            if (count($checkCombination) > 0) {
                    $validation->errors()->add('subject_id', 'Subject result already exists')
                                        ->add('teacher_id', 'Teacher already exists')
                                        ->add('section_id', 'Section already exists');
                }                                
            });

            if ($validation->fails()) {
                foreach ($validation->errors()->all() as $error) {
                    //dd($error);
                    $message = $error;
                    return redirect('/sectionSubjectTeachers')->with('message', 'Subject already exists');
                }
            
            }   
            else {
                //dd($data);
                /*print("this term marks: ".$this_term_marks[$i].", Average: ".$average.
                ", Total: ".$term_total.", section_student_id: ".$section_student_id.
                ", section_subject_teacher_id: ".$section_subject_teacher_id.", term_id: ".
                $term_id);*/
                
                $section_subject_teacher = SectionSubjectTeacher::create($data);
                return redirect('/sectionSubjectTeachers');
            }
    }

    public function GetDataForDataTable(Request $request) {
        $section = new Section();
        return $section->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
