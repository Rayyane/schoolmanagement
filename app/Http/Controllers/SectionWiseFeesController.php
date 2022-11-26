<?php

namespace App\Http\Controllers;

use App\BusinessMonth;
use App\FeesType;
use App\Level;
use App\Section;
use App\SectionWiseFees;
use App\Session;
use Illuminate\Http\Request;
use Validator;

class SectionWiseFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_wise_fees = SectionWiseFees::all();

        return view('admin.section_wise_fees.index', ['section_wise_fees' => $section_wise_fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        //dd($sessions);
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        $fees_types = FeesType::pluck('fees_type_name', 'id');
        $business_months = BusinessMonth::pluck('month_name', 'id');

        return view('admin.section_wise_fees.create', ['sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections,
            'fees_types' => $fees_types, 'business_months' => $business_months, ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $session_id = $request->session_id;
        //$level_id = $request->level_id;
        $section_id = $request->section_id;
        $fees_type_id = $request->fees_type_id;
        $business_month_id = $request->business_month_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        $data = ['session_id' => $session_id,
            'section_id' => $section_id,
            'fees_type_id' => $fees_type_id,
            'business_month_id' => $business_month_id,
            'amount' => $amount,
            'user_id' => $user_id,
        ];
        //dd($data);
        $validation = Validator::make([$session_id = $request->session_id,
            $section_id = $request->section_id,
            $fees_type_id = $request->fees_type_id,
            $business_month_id = $request->business_month_id,
            $amount = $request->amount,
            $user_id = $request->user_id,
        ], [], []);
        //dd($validation);
        $validation->after(function ($validation) use ($session_id, $section_id, $fees_type_id, $business_month_id
                 ) {
            $checkCombination = SectionWiseFees::where('session_id', $session_id)
                                                   ->where('section_id', $section_id)
                                                   ->where('fees_type_id', $fees_type_id)
                                                   ->where('business_month_id', $business_month_id)
                                                   ->get();
            //dd(count($checkCombination));
            if (count($checkCombination) > 0) {
                $validation->errors()->add('session_id', 'Data already exists');
            }
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            //dd($data);
            $section_wise_fees = SectionWiseFees::create($data);

            return redirect('/section_wise_fees')->with('message', 'fee details added');
        }

        return redirect('/section_wise_fees')->with('message', 'fee details could not be added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section_wise_fees = SectionWiseFees::find($id);

        return view('admin.section_wise_fees.show', ['section_wise_fees' => $section_wise_fees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section_wise_fees = SectionWiseFees::find($id);
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        //dd($sessions);
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        $fees_types = FeesType::pluck('fees_type_name', 'id');
        $business_months = BusinessMonth::pluck('month_name', 'id');

        return view('admin.section_wise_fees.edit', ['section_wise_fees' => $section_wise_fees,
            'sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections,
            'fees_types' => $fees_types, 'business_months' => $business_months, ]);
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
        $section_wise_fees = SectionWiseFees::find($id);
        $session_id = $request->session_id;
        //$level_id = $request->level_id;
        $section_id = $request->section_id;
        $fees_type_id = $request->fees_type_id;
        $business_month_id = $request->business_month_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        $data = [$session_id = $request->session_id,
            $section_id = $request->section_id,
            $fees_type_id = $request->fees_type_id,
            $business_month_id = $request->business_month_id,
            $amount = $request->amount,
            $user_id = $request->user_id,
        ];

        $validation = Validator::make([$session_id = $request->session_id,
            $section_id = $request->section_id,
            $fees_type_id = $request->fees_type_id,
            $business_month_id = $request->business_month_id,
            $amount = $request->amount,
            $user_id = $request->user_id,
        ], [], []);

        $validation->after(function ($validation) use ($session_id, $section_id, $fees_type_id, $business_month_id
                 ) {
            $checkCombination = SectionWiseFees::where('session_id', $session_id)
                                                   ->where('section_id', $section_id)
                                                   ->where('fees_type_id', $fees_type_id)
                                                   ->where('business_month_id', $business_month_id)
                                                   ->get();
            if (count($checkCombination) > 0) {
                $validation->errors()->add('session_id', 'Data already exists');
            }
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            $section_wise_fees->update($data);

            return redirect('/section_wise_fees')->with('message', 'fee details updated');
        }

        return redirect('/section_wise_fees')->with('message', 'fee details could not be updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section_wise_fees = SectionWiseFees::find($id);
        try {
            $section_wise_fees->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete this year');

            return redirect('/section_wise_fees')->with('message', 'This data cannot be deleted');
        }

        return redirect('/section_wise_fees')->with('message', 'data deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $section_wise_fees = new SectionWiseFees();

        return $section_wise_fees->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
