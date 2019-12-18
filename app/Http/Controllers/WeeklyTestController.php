<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use App\Level;
use App\Session;
use App\Section;
use App\Subject;
use App\Student;
use App\WeeklyTest;
use App\SectionSubjectTeacher;
use App\StudentSubjectResult;
use App\SectionStudent;
use App\TermResult;
use App\SelectedId;
use App\FinalResult;
use Validator;
use App\Term;
use PDF;

use Illuminate\Http\Request;

class WeeklyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$level_enroll = LevelEnroll::with('level', 'session')->get();
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        //dd($sessions);
        $levels = Level::with('level_enroll.section')->get();
        //dd($levels);
        $sections = Section::pluck('section_name', 'id');
        $terms = Term::pluck('term_name', 'id');
        //dd($sessions);
        //$psections = $sections->pluck('section_name', 'id');
        return view('admin.weekly_tests.index', [
            'sections' => $sections, 'sessions' => $sessions, 'levels' => $levels,
            'terms' => $terms
            ]);
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
     * @param  \App\WeeklyTest  $weeklyTest
     * @return \Illuminate\Http\Response
     */
    public function show(WeeklyTest $weeklyTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request) {
        $student_subject_result = StudentSubjectResult::find($id);
        $term_id = $student_subject_result->term_id;
        $section_subject_teacher_id = $request->section_subject_teacher_id;
        return view('admin.weekly_tests.edit', 
            ['student_subject_result' => $student_subject_result, 'term_id' => $term_id,
            'section_subject_teacher_id' => $section_subject_teacher_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $data = $request->only('weekly_test_marks');
        $weekly_test_number = $request->weekly_test_number;
        $term_id = $request->term_id;
        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get();
        //$student_subject_result_id = $request->student_subject_result_id;
        $student_subject_result = StudentSubjectResult::find($id);
        $student_subject_result -> update($data);

        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get();
        return redirect('/weekly_test/view_by_number',
            ['student_subject_results' => $student_subject_results, 'weekly_test_number' => $weekly_test_number,
            'sec_sub_teach_id' => $section_subject_teacher_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request) {

        $student_subject_result_id = $id;
        $ekta_habijabi = StudentSubjectResult::find($student_subject_result_id);
        
        $weekly_test_number = $ekta_habijabi->weekly_test_number;
        $section_subject_teacher_id = $request->sec_sub_teach_id;
        //dd($section_subject_teacher_id);
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get(); 
        $ekta_habijabi->delete();  
        //$section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
        //$weekly_test_number = $student_subject_result->weekly_test_number;
        /*$student_subject_results = StudentSubjectResult::where('weekly_test_number', $weekly_test_number)
        ->where('section_subject_teacher_id', $student_subject_result->section_subject_teacher_id)
        ->get();*/

        
        return view('admin.weekly_tests.number_wise_result', 
            ['student_subject_results' => $student_subject_results, 'weekly_test_number' => $weekly_test_number,
            'sec_sub_teach_id' => $section_subject_teacher_id]);
    }

    public function showSubjects(Request $request) {

        $section_id = $request->section_id;
        //dd($section_id);
        $section_students = SectionStudent::where('section_id', $section_id)->get();
        $section_subject_teachers = SectionSubjectTeacher::where('section_id', $section_id)
        ->get();
        $term_id = $request->term_id;
        //$subjects = Subject::all();
        //dd($section_subject_teachers);
        return view('admin.weekly_tests.subjectList', [
            'section_subject_teachers' => $section_subject_teachers, 'section_students' => $section_students, 
            'term_id' => $term_id
            ]);
    }


    public function proceedWithSubject(Request $request) {

        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $term_id = $request->term_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $student_subject_results = StudentSubjectResult::where('section_subject_teacher_id', 
            $section_subject_teacher_id)
            ->where('term_id', $term_id)
            ->get();
        $student_subject_results_test_num = $student_subject_results->pluck('weekly_test_number', 'id');
        $array = $student_subject_results_test_num->toArray();
        $student_subject_result = array_unique($array);
        //dd($unique_array);
        asort($student_subject_result);
        //dd($section_subject_teacher_id);
        return view('admin.weekly_tests.choose_num', 
            ['sec_sub_teach' => $section_subject_teacher, 'student_subject_result' => $student_subject_result, 
            'term_id' => $term_id]);
    }

    public function proceedWithTestNumber(Request $request) {

        $section_subject_teacher_id = $request->sec_sub_teach_id;
        $term_id = $request->term_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $section_id = $section_subject_teacher->section_id;
        $section_students = SectionStudent::where('section_id', $section_id)->get();
        //dd($section_students);
        request()->validate(['weekly_test_number' => 'required'],
            ['weekly_test_number.required' => 'You have to enter weekly test number!']);
        
        $weekly_test_number = $request->weekly_test_number;
        return view('admin.weekly_tests.mark', [
            'sec_sub_teach' => $section_subject_teacher, 'weekly_test_number' => $weekly_test_number,
            'section_students' => $section_students, 'term_id' => $term_id
            ]);
    }

    public function subjectWiseResult() {

        $student_subject_result = StudentSubjectResult::all();
        $section_subject_teacher_id = $student_subject_result->first()->section_subject_teacher_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $section_id = $section_subject_teacher->section_id;
        $section_subject_teacher = SectionSubjectTeacher::where('section_id', $section_id)->get();
        //dd($section_subject_teacher);
        return view('admin.weekly_tests.subject_wise_result',
            ['section_subject_teacher' => $section_subject_teacher]);
    }

    public function viewSubjectWiseResult(Request $request) {

        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $subject = Subject::find($section_subject_teacher->subject_id);
        //dd($subject);
        $student_subject_result = StudentSubjectResult::where
        ('section_subject_teacher_id', $section_subject_teacher_id)
        ->get();
        //dd($student_subject_result);
        return view('admin.weekly_tests.view_subject_wise_result',
            ['student_subject_result' => $student_subject_result, 'subject' => $subject]);
    }

    public function viewNumberWiseResult(Request $request) {

        
        $student_subject_result_id = $request->student_subject_result_id;
        //dd($student_subject_result_id);
        if ($student_subject_result_id != null) {
            $student_subject_result = StudentSubjectResult::find($student_subject_result_id);
            $weekly_test_number = $student_subject_result->weekly_test_number;
        
            
            $term_id = $request->term_id;
            $term = Term::find($term_id);
            $section_subject_teacher_id = $request->sec_sub_teach_id;
            //dd($section_subject_teacher_id);
            
            $student_subject_results = 
            StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('weekly_test_number', $weekly_test_number)
            ->where('term_id', $term_id)
            ->get();

            return view('admin.weekly_tests.number_wise_result', 
            ['student_subject_results' => $student_subject_results, 'weekly_test_number' => $weekly_test_number, 'term' => $term,
            'sec_sub_teach_id' => $section_subject_teacher_id]);
        }

        else {

        }
        
        
        
           
        //$section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
        //$weekly_test_number = $student_subject_result->weekly_test_number;
        /*$student_subject_results = StudentSubjectResult::where('weekly_test_number', $weekly_test_number)
        ->where('section_subject_teacher_id', $student_subject_result->section_subject_teacher_id)
        ->get();*/

        
    }

    public function updateMarks(Request $request) {

        $data = $request->only('weekly_test_marks');
        $student_subject_result_id = $request->student_subject_result_id;
        $term_id = $request->term_id;
        $term = Term::find($term_id);
        $weekly_test_number = $request->weekly_test_number;
        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get();
        //$student_subject_result_id = $request->student_subject_result_id;
        $student_subject_result = StudentSubjectResult::find($student_subject_result_id);
        $student_subject_result -> update($data);

        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->where('term_id', $term_id)
        ->get();
        return view('admin.weekly_tests.number_wise_result',
            ['student_subject_results' => $student_subject_results, 
            'weekly_test_number' => $weekly_test_number, 'term' => $term,
            'sec_sub_teach_id' => $section_subject_teacher_id]);

    }

    public function deleteResult(Request $request) {

        $student_subject_result_id = $request->student_subject_result_id;
        $ekta_habijabi = StudentSubjectResult::find($student_subject_result_id);
        $weekly_test_number = $ekta_habijabi->weekly_test_number;
        $section_subject_teacher_id = $request->sec_sub_teach_id;
        //dd($section_subject_teacher_id);
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get(); 
        $ekta_habijabi->delete();  
        //$section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
        //$weekly_test_number = $student_subject_result->weekly_test_number;
        /*$student_subject_results = StudentSubjectResult::where('weekly_test_number', $weekly_test_number)
        ->where('section_subject_teacher_id', $student_subject_result->section_subject_teacher_id)
        ->get();*/

        return view('admin.weekly_tests.number_wise_result', 
            ['student_subject_results' => $student_subject_results, 
            'weekly_test_number' => $weekly_test_number,
            'sec_sub_teach_id' => $section_subject_teacher_id]);
    }


    public function storeMarks(Request $request) {

        for ($i = 0; $i < count($request->student_id); $i++) {

            $student_id = $request->student_id[$i];
            $weekly_test_number = $request->weekly_test_number[$i];
            $section_subject_teacher_id = $request->section_subject_teacher_id[$i];
            $marks = $request->marks[$i];
            $term_id = $request->term_id;
            $data = ['student_id' => $student_id, 'weekly_test_number' => $weekly_test_number,
            'section_subject_teacher_id' => $section_subject_teacher_id, 'weekly_test_marks'
            => $marks, 'term_id' => $term_id];

            /**********/

            $validation = Validator::make([
                'student_id' => $student_id, 
                'weekly_test_number' => $weekly_test_number,
                'section_subject_teacher_id' => $section_subject_teacher_id,
                'term_id' => $term_id
                ], [], []);
            $validation->after(function ($validation) 
                use($student_id, $weekly_test_number, $section_subject_teacher_id, $term_id) {
            $checkCombination = StudentSubjectResult::where('student_id', $student_id)
            ->where('weekly_test_number', $weekly_test_number)
            ->where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('term_id', $term_id)
            ->get();

            if (count($checkCombination) > 0) {
                    $validation->errors()
                    ->add('student_id', 'Student result already exists')
                    ->add('weekly_test_number', 'Test already exists')
                    ->add('section_subject_teacher_id', 'Subject already exists');
                }                                
            });

            if ($validation->fails()) {


                foreach ($validation->errors()->all() as $error) {
                    //dd($error);
                    $message = $error;
                }
            
            }   
            else {
                $student_subject_result = StudentSubjectResult::create($data); 
            }

            /**********/
            
            
        }

        $section_subject_teacher_id = $request->section_subject_teacher_id[0];
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $subject = Subject::find($section_subject_teacher->subject_id);
        //dd($subject);
        $student_subject_result = StudentSubjectResult::where
        ('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($student_subject_result);
        return view('admin.weekly_tests.view_subject_wise_result',
            [
            'student_subject_result' => $student_subject_result, 'subject' => $subject
            ]);
    }

    public function viewStudentWiseResult(Request $request) {
        //dd($request);
        $student_id = $request->student_id;
        $term_id = $request->term_id;
        $student = Student::find($student_id);
        $student_subject_results = StudentSubjectResult::where('student_id', $student_id)
        ->where('term_id', $term_id)
        ->get();
        // regeneration code testing starts after this line 
        $section_students = SectionStudent::where('student_id', $student_id)->get();

        $section_student = $section_students->first();
        $section_id = $section_student->section_id;
        $section_student = SectionStudent::where('student_id', $student_id)
                                        ->where('section_id', $section_id)
                                        ->get()
                                        ->first();
        $section_student_id = $section_student->id;
        $checkCombination = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($checkCombination);
        $term_results = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->get();
        //dd($term_results);
        $isGenerated = false;
        if (count($term_results) > 0) {
            $isGenerated = true;
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.view_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id, 'isGenerated' => $isGenerated
                ]);
        }
        else {
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.generate_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id, 'isGenerated' => $isGenerated
                ]);
        }
        //dd($student_subject_results);
        if (count($student_subject_results) > 0) {
            //dd($isGenerated);
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.view_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id, 'isGenerated' => $isGenerated
                ]);
        }
        else {
            
        }
        
    }

    public function generateTermResult(Request $request) {
        //dd($request);
        $student_id = $request->student_id;
        
        $term_id = $request->term_id;
        //dd($term_id);
        $student = Student::find($student_id);
        $student_subject_results = StudentSubjectResult::where('student_id', $student_id)
        ->where('term_id', $term_id)
        ->get();
        $section_subject_teacher_id = $student_subject_results
        ->pluck('section_subject_teacher_id', 'id');
        
        $array = $section_subject_teacher_id->toArray();
        $section_subject_teacher_id = array_unique($array);
        //dd($unique_array);
        asort($section_subject_teacher_id);
        $section_students = SectionStudent::where('student_id', $student_id)->get();

        $section_student = $section_students->first();
        $section_id = $section_student->section_id;
        $section_student = SectionStudent::where('student_id', $student_id)
                                        ->where('section_id', $section_id)
                                        ->get()
                                        ->first();
        $section_student_id = $section_student->id;
        $checkCombination = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($checkCombination);
        $term_results = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->get();
        //dd($term_results);
        
        //dd($isGenerated);

        if(count($checkCombination) > 0) {
            return view('admin.term_results.index', ['term_results' => $term_results]);
        }

        else{
            return view('admin.weekly_tests.generate_term_result', [
            'section_subject_teacher_ids' => $section_subject_teacher_id,
            'student' => $student, 'term_id' => $term_id
            ]);
        }

        //$section_subject_teachers = SectionSubjectTeacher::where('id', $section_subject_teacher_id)->get();
        //dd($section_subject_teacher_id);
        
        //dd($student_subject_results);
    }

    public function reGenerateTermResult(Request $request) {
        //dd($request);

        $student_id = $request->student_id;
        
        $term_id = $request->term_id;
        //dd($term_id);
        $student = Student::find($student_id);
        $student_subject_results = StudentSubjectResult::where('student_id', $student_id)
        ->where('term_id', $term_id)
        ->get();
        $section_subject_teacher_id = $student_subject_results
        ->pluck('section_subject_teacher_id', 'id');
        
        $array = $section_subject_teacher_id->toArray();
        $section_subject_teacher_id = array_unique($array);
        //dd($unique_array);
        asort($section_subject_teacher_id);
        $section_students = SectionStudent::where('student_id', $student_id)->get();

        $section_student = $section_students->first();
        $section_id = $section_student->section_id;
        $section_student = SectionStudent::where('student_id', $student_id)
                                        ->where('section_id', $section_id)
                                        ->get()
                                        ->first();
        $section_student_id = $section_student->id;
        $checkCombination = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($checkCombination);
        $check_final = FinalResult::where('section_id', $section_id)->get();
        //dd(count($check_final));
        $term_results = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->get();
        //dd($term_results);
        if(count($check_final) == 0) {
            foreach ($term_results as $term_result) {
            $selected_ids = SelectedId::where('term_result_id', $term_result->id)->get();
            foreach ($selected_ids as $selected_id) {
                $selected_id->delete();
            }
            $term_result->delete();
            /*try{
            $term_result->delete();
            }
            catch (\Illuminate\Database\QueryException $e) {
            dd($term_result);
            //return redirect('/levels')->with('message', 'This class cannot be deleted');
            }*/
            
        }
        
        //dd($isGenerated);

        
        return view('admin.weekly_tests.generate_term_result', [
        'section_subject_teacher_ids' => $section_subject_teacher_id,
        'student' => $student, 'term_id' => $term_id
        ]);
        }

        else{
            return view('admin.term_results.index', ['term_results' => $term_results])->with('message', 'This term result cannot be regenerated because final result is already generated');
        }
        
        

        //$section_subject_teachers = SectionSubjectTeacher::where('id', $section_subject_teacher_id)->get();
        //dd($section_subject_teacher_id);
        
        //dd($student_subject_results);
    }

    public function viewTermResult(Request $request) {
        //dd($request);
        $this_term_marks = [];
        $term_id = $request->term_id;
        //dd($term_id);
        //dd(count($request->section_subject_teacher_idRes));
        for ($i = 0; $i < count($request->section_subject_teacher_idRes); $i++) {
            
            $section_subject_teacher_id = $request->section_subject_teacher_idRes[$i];
            $term_marks = $request->term_marks[$section_subject_teacher_id];
            $this_term_marks[$i] = $term_marks;
            //dd($this_term_marks);
            $marks_array = [];
            $student_subject_result_id_array = [];
            
            for ($j = 0; $j < count($request->student_subject_result_id[$section_subject_teacher_id]); $j++) {

                //print("new: ".count($request->student_subject_result_id[$section_subject_teacher_id]) .'<br>');
                
                $something = $request->student_subject_result_id[$section_subject_teacher_id][$j];
                $id_n_marks = explode("_", $something);
                $student_subject_result_id = $id_n_marks[0];
                $weekly_test_marks = $id_n_marks[1];
                $student_subject_result_id_array[$j] = $student_subject_result_id;
                $converted_weekly_marks = ($weekly_test_marks*20)/25;
                $marks_array[$j] = $converted_weekly_marks;
                //$student_subject_result_id_array[0] = $student_subject_result_id;
                //break
            }

            $student_subject_result_id = $student_subject_result_id_array[0];
            $student_subject_result = StudentSubjectResult::find($student_subject_result_id);
            $student_id = $student_subject_result->student_id;
            $section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section_id = $section_subject_teacher->section_id;
            $section_student = SectionStudent::where('section_id', $section_id)
            ->where('student_id', $student_id)->get()->first();
            $section_student_id = $section_student->id;
                        //dd($student_subject_result_id);
            $average = array_sum($marks_array)/count($marks_array);
            $term_adjusted = ($this_term_marks[$i] * 80)/ 100;
            $term_total = $term_adjusted + $average;
                        //var_dump($marks_array);
            $data = ['term_marks' => $this_term_marks[$i], 'weekly_avg' => $average, 
            'total_marks' => $term_total, 'section_student_id' => $section_student_id,
            'section_subject_teacher_id' => $section_subject_teacher_id, 
            'term_id' => $term_id
            ];
            /*print("this term marks: ".$this_term_marks[$i].", Average: ".$average.
                ", Total: ".$term_total.", section_student_id: ".$section_student_id.
                ", section_subject_teacher_id: ".$section_subject_teacher_id.", term_id: ".
                $term_id);
            print('\n');*/
            
            
            /*for ($k = 0; $k < count($student_subject_result_id_array); $k++) {
                    $term_result_id = $term_result->id;
                    $student_subject_result_id = $student_subject_result_id_array[$k];
                    $selected_data = ['student_subject_result_id' => $student_subject_result_id, 
                    'term_result_id' => $term_result_id];
                    $selected_id = SelectedId::create($selected_data);
            }*/

            $validation = Validator::make([
                'section_student_id' => $section_student_id, 
                'section_subject_teacher_id' => $section_subject_teacher_id,
                'term_id' => $term_id
                ], [], []);
            $validation->after(function ($validation) use($section_student_id, $section_subject_teacher_id, $term_id) {
            $checkCombination = TermResult::where('section_student_id', $section_student_id)
            ->where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('term_id', $term_id)
            ->get();

            if (count($checkCombination) > 0) {
                    $validation->errors()
                    ->add('section_student_id', 'Student result already exists')
                    ->add('section_subject_teacher_id', 'Subject already exists');
                }                                
            });

            if ($validation->fails()) {
                foreach ($validation->errors()->all() as $error) {
                    //dd($error);
                    $message = $error;
                    $term_results = TermResult::where('section_student_id', $section_student_id)
                                                ->where('term_id', $term_id)
                                                ->get();
                    //dd($term_results);
                    return view('admin.term_results.index', ['term_results' => $term_results]);
                }
            
            }   
            else {
                //dd($data);
                /*print("this term marks: ".$this_term_marks[$i].", Average: ".$average.
                ", Total: ".$term_total.", section_student_id: ".$section_student_id.
                ", section_subject_teacher_id: ".$section_subject_teacher_id.", term_id: ".
                $term_id);*/
                
                $term_result = TermResult::create($data);
                for ($k = 0; $k < count($student_subject_result_id_array); $k++) {
                    $term_result_id = $term_result->id;
                    $student_subject_result_id = $student_subject_result_id_array[$k];
                    $selected_data = ['student_subject_result_id' => $student_subject_result_id, 
                    'term_result_id' => $term_result_id];
                    $selected_id = SelectedId::create($selected_data);
                }
            }
        }

        $term_results = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($term_results);
        return view('admin.term_results.index', ['term_results' => $term_results]);
    }

    public function viewTermReport(Request $request) {
        $term_result_ids = $request->term_result_id;
        //$term_result = TermResult::find($term_result_id);
        $term_results = TermResult::find($term_result_ids);
        //dd($term_results);
        return view('admin.term_results.index', ['term_results' => $term_results]);
    }

    public function downloadPDF() {
        $pdf = PDF::loadView('admin.term_results.index'); //load view page
        return $pdf->download('admin.term_results.index.pdf'); // download pdf file
    }
}
