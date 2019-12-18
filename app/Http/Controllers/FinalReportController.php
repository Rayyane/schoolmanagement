<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use App\Level;
use App\Session;
use App\Section;
use App\SectionStudent;
use App\TermResult;
use App\FinalResult;
use App\FinalReport;
use App\Student;
use Validator;
use Illuminate\Http\Request;

class FinalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        
        return view('admin.final_reports.index', [
            'sections' => $sections, 'sessions' => $sessions, 'levels' => $levels]);
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
        $section_students = SectionStudent::where('section_id', $id)->get();
        //dd($section_students);
        return view('admin.final_report_view.view_students', ['section_students' => $section_students]);
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
        //
    }

    public function viewStudents(Request $request) {
        $section_id = $request->section_id;
        $processor = request()->user()->name;
        //dd($section_id);
        $section_students = SectionStudent::where('section_id', $section_id)->get();
        $final_result = FinalResult::where('section_id', $section_id)
                                    ->where('processor', $processor)
                                    ->get();

        if(count($final_result) > 0) {
            return view('admin.final_reports.view_students', ['section_id' => $section_id,
            'section_students' => $section_students]);
        }
        else {
            return view('admin.final_reports.generate_students_result', ['section_id' => $section_id,
            'section_students' => $section_students]);
        }
        
    }

    public function processStudents(Request $request) {
        $section_id = $request->section_id;
        //dd($request);
        for ($i = 0; $i < count($request->student_id); $i++) {
            $student_id = $request->student_id[$i];
            $section_student = SectionStudent::where('section_id', $section_id)
            ->where('student_id', $student_id)
            ->get()->first();
            $section_student_id = $section_student->id;
            $processor = request()->user()->name;
            $data = ['section_id' => $section_id, 'processor' => $processor];
            //$this->validate($request, ['section_id' => 'unique:final_results']);
            //add validation here
            //$final_result = FinalResult::create($data);
            $final_result = FinalResult::where('section_id', $section_id)
                                        ->where('processor', $processor)
                                        ->get();
            //dd(count($final_result));
            if(count($final_result) == 0) {
                $final_result = FinalResult::create($data);
            }
            
            else{
                $final_result = $final_result->first();
            }

            $term_results = TermResult::where('section_student_id', $section_student_id)->get();
            $subject_wise_result = [];
            $term_id = $term_results
            ->pluck('term_id');
            $array = $term_id->toArray();
            $term_id_array = array_unique($array);
            //repeat
            $section_subject_teacher_id = $term_results
            ->pluck('section_subject_teacher_id');
            $array_subject = $section_subject_teacher_id->toArray();
            $section_subject_teacher_id_array = array_unique($array_subject);
            //print (sizeof($term_id_array));
            for ($j = 0; $j < count($term_results); $j++) {
                $section_subject_teacher_id = $term_results[$j]->section_subject_teacher_id;
                $marks = $term_results[$j]->total_marks;
                //$subject_wise_result[$section_subject_teacher_id] = 
                //$marks + $subject_wise_result[$section_subject_teacher_id];
                $previousMarks =  isset($subject_wise_result[$section_subject_teacher_id]) ? $subject_wise_result[$section_subject_teacher_id] : 0;

                $subject_wise_result[$section_subject_teacher_id] = $marks + $previousMarks;
                //dd($subject_term_result[1]);
                /*echo "term_results index: ".$j." section_subject_teacher_id: ".$section_subject_teacher_id." ";
                echo $subject_term_result[$section_subject_teacher_id];
                echo "<br>";*/
            }

            for ($k = 0; $k < sizeof($section_subject_teacher_id_array); $k++) {
                $section_subject_teacher_id = $section_subject_teacher_id_array[$k];
                //dd($subject_wise_result[$section_subject_teacher_id]);
                $subject_wise_result[$section_subject_teacher_id] = $subject_wise_result[$section_subject_teacher_id]/
                sizeof($term_id_array);
                $this_subject_result = $subject_wise_result[$section_subject_teacher_id];
                /*echo $subject_wise_result[$section_subject_teacher_id];
                echo " ";*/
                $final_result_id = $final_result->id;
                //dd($student_id);
                $report_data = ['section_subject_teacher_id' => $section_subject_teacher_id, 'subject_marks' => $subject_wise_result[$section_subject_teacher_id], 'student_id' => $student_id, 'final_result_id' => $final_result_id];
                /*******************/
                $validation = Validator::make(['section_subject_teacher_id' => $section_subject_teacher_id, 'subject_marks' => $this_subject_result, 'student_id' => $student_id], [], []);
                $validation->after(function ($validation) use($section_subject_teacher_id, $this_subject_result, $student_id)  {
                        $checkCombination = FinalReport::where('section_subject_teacher_id', $section_subject_teacher_id)
                                                        ->where('subject_marks', $this_subject_result)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                        if (count($checkCombination) > 0) {
                                $validation->errors()->add('section_subject_teacher_id', 'Class already exists, please choose another class.')
                                                    ->add('subject_marks', 'Session already exists, please choose another session.')
                                                    ->add('student_id', 'Shift already exists, please choose another shift.');
                                                    }                                

                           });

                if ($validation->fails()) {
                        foreach ($validation->errors()->all() as $error) {
                            //dd($error);
                            $message = $error;
                            return redirect('/final_reports/'.$section_id);
                        }
                        
                } else {
                    //dd($data);
                    $final_report = FinalReport::create($report_data);
                    //return redirect('/final_reports/'.$section_id);
                }
                /*******************/
                //$final_report = FinalReport::create($report_data);
                /*for ($z = 0; $z<sizeof($data); $z++) {
                    echo $data[$z];
                    echo " ";
                }*/
                
            }
        }
        return redirect('/final_reports/'.$section_id);
    }

    //reProcessStudents

    public function reProcessStudents(Request $request) {
        $section_id = $request->section_id;
        $processor = request()->user()->name;
        $data = ['section_id' => $section_id, 'processor' => $processor];
        $final_results = FinalResult::where('section_id', $section_id)->get();
        foreach ($final_results as $final_result) {
                $final_result->delete();
        }
        $final_result = FinalResult::create($data);
        $final_result_id = $final_result->id;
        $final_reports = FinalReport::where('final_result_id', $final_result_id)->get();
        foreach ($final_reports as $final_report) {
                $final_report->delete();
        }
        //dd($request);
        for ($i = 0; $i < count($request->student_id); $i++) {
            $student_id = $request->student_id[$i];
            $section_student = SectionStudent::where('section_id', $section_id)
            ->where('student_id', $student_id)
            ->get()->first();
            $section_student_id = $section_student->id;
            
            

            $term_results = TermResult::where('section_student_id', $section_student_id)->get();
            $subject_wise_result = [];
            $term_id = $term_results
            ->pluck('term_id');
            $array = $term_id->toArray();
            $term_id_array = array_unique($array);
            //repeat
            $section_subject_teacher_id = $term_results
            ->pluck('section_subject_teacher_id');
            $array_subject = $section_subject_teacher_id->toArray();
            $section_subject_teacher_id_array = array_unique($array_subject);
            //print (sizeof($term_id_array));
            for ($j = 0; $j < count($term_results); $j++) {
                $section_subject_teacher_id = $term_results[$j]->section_subject_teacher_id;
                $marks = $term_results[$j]->total_marks;
                //$subject_wise_result[$section_subject_teacher_id] = 
                //$marks + $subject_wise_result[$section_subject_teacher_id];
                $previousMarks =  isset($subject_wise_result[$section_subject_teacher_id]) ? $subject_wise_result[$section_subject_teacher_id] : 0;

                $subject_wise_result[$section_subject_teacher_id] = $marks + $previousMarks;
                //dd($subject_term_result[1]);
                /*echo "term_results index: ".$j." section_subject_teacher_id: ".$section_subject_teacher_id." ";
                echo $subject_term_result[$section_subject_teacher_id];
                echo "<br>";*/
            }

            for ($k = 0; $k < sizeof($section_subject_teacher_id_array); $k++) {
                $section_subject_teacher_id = $section_subject_teacher_id_array[$k];
                //dd($subject_wise_result[$section_subject_teacher_id]);
                $subject_wise_result[$section_subject_teacher_id] = $subject_wise_result[$section_subject_teacher_id]/
                sizeof($term_id_array);
                $this_subject_result = $subject_wise_result[$section_subject_teacher_id];
                /*echo $subject_wise_result[$section_subject_teacher_id];
                echo " ";*/
                $final_result_id = $final_result->id;
                //dd($student_id);
                $report_data = ['section_subject_teacher_id' => $section_subject_teacher_id, 'subject_marks' => $subject_wise_result[$section_subject_teacher_id], 'student_id' => $student_id, 'final_result_id' => $final_result_id];
                /*******************/
                
                /*******************/
                
                $final_report = FinalReport::create($report_data);
            }
        }
        return redirect('/final_reports/'.$section_id);
    }

    public function processSpecificStudents($id) {
        $student_id = $id;
        $student = Student::find($student_id);
        $section_student_id = SectionStudent::where('student_id', $student_id)->get()->first()->id;
        //dd($section_student_id);
        $section = Section::find(SectionStudent::find($section_student_id)->section_id);
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $level = Level::find($level_enroll->level_id);
        $session = Session::find($level_enroll->session_id);
        $final_reports = FinalReport::where('student_id', $student_id)->get();
        return view('admin.final_report_view.view_student_final_report', 
        [
        'final_reports' => $final_reports, 'student' => $student, 'section' => $section, 'session' => $session,
        'level' => $level
        ]);
    }

    public function pdfReportFinal($id) {
        $student_id = $id;
        $student = Student::find($student_id);
        $section_student_id = SectionStudent::where('student_id', $student_id)->get()->first()->id;
        //dd($section_student_id);
        $section = Section::find(SectionStudent::find($section_student_id)->section_id);
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $level = Level::find($level_enroll->level_id);
        $session = Session::find($level_enroll->session_id);
        $final_reports = FinalReport::where('student_id', $student_id)->get();
        /********************/
        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.final_report_view.view_student_pdf_final_report')
        ->with(['final_reports' => $final_reports, 'student' => $student, 'section' => $section, 'session' => $session,
        'level' => $level]);
        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="33%">{DATE j-m-Y H:i:s}</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">'.request()->user()->name.'</td>
            </tr>
        </table>');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    
}
