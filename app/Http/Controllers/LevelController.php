<?php

namespace App\Http\Controllers;

use App\Level;
use App\Session;
use App\Shift;
use App\Teacher;
use App\Branch;
use App\LevelEnroll;
use Illuminate\Http\Request;
use Validator;
use Helpers;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();

        return view ('admin.levels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::pluck('class_name', 'id');
        $sessions = Session::pluck('name', 'id');
        $shifts = Shift::pluck('shift_name', 'id');
        $branches = Branch::pluck('name', 'id');
        return view('admin.levels.create', [
            'levels' => $levels, 'sessions' => $sessions, 'shifts' => $shifts, 'branches' => $branches
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['class_name' => 'required|unique:levels',
                                   'num_of_sub' => 'required']);
        $levelData = $request->only('class_name', 'num_of_sub');
        $level = Level::create($levelData);
        
        //$level_enrollData = $request->only('session_id', 'shift_id', 'branch_id');
        
        //$level_enroll = LevelEnroll::create($level_enrollData);
        return redirect('/levels')->with('message', 'Class added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        /*$sections = $level->section()->get();
        $shift = Shift::find($level->shift_id);
        $shift_name = $shift->shift_name;
        $teachers = Teacher::find($level->teacher_id);
        $teacher = $teachers->teacher_name;*/
        //dd($shifts->shift_name);
        return view('admin.levels.show', ['level'=>$level/*, 'sections'=>$sections, 'shift'=>$shift_name, 'teacher'=>$teacher*/]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::find($id);
        /*$level_enroll = LevelEnroll::where('level_id', $id);
        $sessions = Session::pluck('name', 'id');
        $shifts = Shift::pluck('shift_name', 'id');
        $branches = Branch::pluck('name', 'id');*/
        return view ('admin.levels.edit', ['level' => $level/*, 'level_enroll' => $level_enroll, 'sessions' => $sessions, 'shifts' => $shifts, 'branches' => $branches*/]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $data = $request->only('class_name', 'num_of_sub');
        $level->update($data);
        return redirect('/levels')->with('message', 'Class updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::find($id);
        try{
            $level->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/levels')->with('message', 'This class cannot be deleted');
        }
        
        return redirect('/levels')->with('message', 'Class deleted');
    }

    public function enrollment(Request $request) {
        $level_id = $request->level_id;
        $session_id = $request->session_id;
        $shift_id = $request->shift_id;
        $branch_id = $request->branch_id;
        $data = ['level_id' => $level_id, 'session_id' => $session_id,
                 'shift_id' => $shift_id, 'branch_id' => $branch_id];
        //dd($data);
        //$validationRule = [];
        //$validationMsg =[];
        $validation = Validator::make(['level_id' => $level_id, 'session_id' => $session_id, 'shift_id' => $shift_id, 'branch_id' => $branch_id], [], []);
        $validation->after(function ($validation) use($level_id, $session_id, $shift_id, $branch_id)  {
                $checkCombination = LevelEnroll::where('level_id', $level_id)
                                                ->where('session_id', $session_id)
                                                ->where('shift_id', $shift_id)
                                                ->where('branch_id', $branch_id)
                                                ->get();
                if (count($checkCombination) > 0) {
                        $validation->errors()->add('level_id', 'Class already exists, please choose another class.')
                                            ->add('session_id', 'Session already exists, please choose another session.')
                                            ->add('shift_id', 'Shift already exists, please choose another shift.')
                                            ->add('branch_id', 'Branch already exists, please choose another branch.');

                    }                                

                   });

        if ($validation->fails()) {
                foreach ($validation->errors()->all() as $error) {
                    //dd($error);
                    $message = $error;
                    return redirect('/levelEnrolls');
                }
                
        } else {
            //dd($data);
            $level_enroll = LevelEnroll::create($data);
            return redirect('/levelEnrolls');
        }
        
    }

    public function GetDataForDataTable(Request $request) {
        $level = new Level();
        return $level->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
