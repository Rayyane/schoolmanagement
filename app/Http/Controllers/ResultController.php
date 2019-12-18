<?php

namespace App\Http\Controllers;

use App\Level;
use App\Result;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Runner\ResultCacheExtensionTest;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::pluck('class_name', 'id');
        return view('admin.results.index', ['levels' => $levels]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->only('student_id[]', 'subject_id[]', 'test_number[]', 'subject_marks[]');

        //$data = $request->student_id[0];
        //$result = Request::create($data);
        //dd($data);
        //dd(count($request->student_id));
        for ($i = 0; $i < count($request->student_id); $i++) {
            $student_id = $request->student_id[$i];
            $subject_id = $request->subject_id[$i];
            $test_number = $request->test_number[$i];
            $subject_marks = $request->subject_marks[$i];
            $data = ['student_id' => $student_id, 'subject_id' => $subject_id, 'test_number' => $test_number, 'subject_marks'
            => $subject_marks];
            //Result::all();
            $result = Result::create($data);
            //dd($result);
        }

        return redirect('weekly_result');
    }

    /**
     * Display the specified resource.
     *
     * @param  Result $id
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $student = Student::find($id);

        $result_id = $request->only('test_number');
        $results = Result::find($result_id);
        $result = $results->first();
        $test_num = $result->test_number;
        //dd($test_num);
        $test = Result::all();
        $thisResult = $test->where('test_number', $test_num)
        ->where('student_id', $student->id);
        //dd($thisResult);
        //$result = Result::where('student_id', $id);
        //$results = $student->result()->get();
        //dd($result);
        return view('admin.results.student_individual', ['student' => $student, 'results' => $thisResult]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showSubjects(Request $request)
    {
        $level_id = $request->only('level_id');
        $level = Level::find($level_id);
        /*$students = $level->student()->get();
        $student = $students->first();
        $id = $student->id;*/
        $this->validate($request, [
            'test_number' => ['required','bail',Rule::unique('results')->where(function ($query) {
                    return $query->where([
                        /*['student_id', $id],*/
                        /*['subject_id', 1],
                        ['test_number', 1],
                        ['subject_marks', 1],*/
                        ]);
                })]
            ]);
        
        $test_number = $request->only('test_number');
        $testNumber = $test_number['test_number'];
        $levels = Level::find($level_id);
        $level = $levels->first();
        //$subjects = Subject::all();
        $subjects = $level->subject()->get();
        //dd($testNumber);

        return view('admin.results.list', ['subjects' => $subjects, 'level' => $level, 'test_number' => $testNumber]);

    }

    public function showResult(Request $request)
    {
        $subject_id = $request->only('subject_id');
        $subjects = Subject::find($subject_id);
        $subject = $subjects->first();
        //dd($subject);
        $level = Level::find($subject->level_id);
        $students = $level->student()->get();
        $test_number = $request->only('test_number');
        $testNumber = $test_number['test_number'];
        //dd($test_number);
        return view('admin.results.mark', ['students' => $students, 'subject' => $subject, 'level' => $level, 'testNumber' => $testNumber]);

    }

    public function chooseTestNumber(Request $request)
    {
        $level_id = $request->only('level_id');
        $levels = Level::find($level_id);
        $level = $levels->first();
        $students = $level->student()->get();
        $student = $students->first();
        //dd($students);
        //$results = Result::all();
        $results = $student->result()->get()->pluck('test_number', 'id');
        //dd($results);

        $array = $results->toArray();
        $result = array_unique($array);
        //dd($unique_array);
        asort($result);
        //$students = $level->student()->get();
        //dd($students);
        /*$number = 0;
        $filled[0] = 0;
        $empty[0] = 0;
        $j = 0;
        $k = 0;
        foreach ($results as $result) {
            $number++;
        }

        foreach ($results as $result) {
            $filled[$j] = $result;
            //echo $empty[$j];
            $j++;
        }

        for ($i1 = 0; $i1 < $number; $i1++) {
            for ($j1 = 0; $j1 < $number; $j1++) {
                if ($empty[$j1] == $filled[$i1]) {
                    $k++;
                }
            }
            if ($k == 0) {}
        }*/
        //dd($empty);
        return view('admin.results.choose_num', ['level' => $level, 'results' => $result, 'students' => $students]);
    }

    public function weeklyResult()
    {
        $result = Result::with('student')->get();
        //dd($result);
        /*$students = Student::all();
        $subjects = Subject::all();*/
        return view('admin.results.show', ['results' => $result/*, 'students'=>$students, 'subjects'=>$subjects*/]);
    }

    public function GetDataForDataTable(Request $request)
    {
        $result = new Result();
        return $result->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }

    public function viewByNumber(Request $request)
    {
        $id = $request->only('test_number');
        $results = Result::find($id);
        $result = $results->first();
        $test_number = $result->test_number;
        $result_set = Result::where('test_number', $test_number)->get();
        /*$result = $resulted->with('student');*/
        //dd($result_set);
        return view('admin.results.show_by_number', ['results' => $result_set]);
    }

    public function chooseNumber($id)
    {
        $student = Student::find($id);
        //dd($student);
        //$result = Result::where('student_id', $id);
        $results = $student->result()->get()->pluck('test_number', 'id');
        //$results = Result::pluck('test_number', 'id');
        //dd($results);
        $array = $results->toArray();
        $result = array_unique($array);
        asort($result);
        return view ('admin.results.choose_test_num', ['student'=>$student, 'results'=>$result]);
    }
}
