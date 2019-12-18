<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessMonth;
use App\FiscalYear;
use Validator;

class BusinessMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_month = BusinessMonth::with('fiscal_year')->get();
        return view('admin.business_months.index', ['business_month' => $business_month]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fiscal_years = FiscalYear::pluck('year', 'id');
        return view('admin.business_months.create', ['fiscal_years' => $fiscal_years]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $month_name = $request->month_name;
        $starts_from = $request->starts_from;
        $ends_on = $request->ends_on;
        $last_payment_date = $request->last_payment_date;
        $fiscal_year_id = $request->fiscal_year_id;
        $user_id = $request->user_id;

        $data = ['month_name' => $month_name, 'starts_from' => $starts_from, 'ends_on' => $ends_on,
                 'last_payment_date' => $last_payment_date, 'fiscal_year_id' => $fiscal_year_id,
                 'user_id' => $user_id];

        $validation = Validator::make(['month_name' => $month_name, 'starts_from' => $starts_from, 
                'ends_on' => $ends_on, 'last_payment_date' => $last_payment_date, 
                'fiscal_year_id' => $fiscal_year_id, 'user_id' => $user_id], [], []);
        

        $validation->after(function ($validation) 
            use($month_name, $starts_from, $ends_on, $last_payment_date, $fiscal_year_id, $user_id) {
        $checkCombination = BusinessMonth::where('fiscal_year_id', $fiscal_year_id)
                                         ->where('month_name', $month_name)
                                         ->get();
        if (count($checkCombination) > 0) {
                $validation->errors()
                ->add('month_name', 'already exists');
            }
        });

        if ($validation->fails()) {


            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        
        }   
        else {
            $business_month = BusinessMonth::create($data);
            return redirect('/business_months')->with('message', 'month added'); 
        }

        //$business_month = BusinessMonth::create($data);
        return redirect('/business_months')->with('message', 'month could not be added');

        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business_month = BusinessMonth::find($id);
        return view('admin.business_months.show', ['business_month' => $business_month]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business_month = BusinessMonth::find($id);
        $fiscal_years = FiscalYear::pluck('year', 'id');
        return view('admin.business_months.edit', ['fiscal_years' => $fiscal_years, 'business_month' => $business_month]);
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
        $business_month = BusinessMonth::find($id);
        $month_name = $request->month_name;
        $starts_from = $request->starts_from;
        $ends_on = $request->ends_on;
        $last_payment_date = $request->last_payment_date;
        $fiscal_year_id = $request->fiscal_year_id;
        $user_id = $request->user_id;

        $data = ['month_name' => $month_name, 'starts_from' => $starts_from, 'ends_on' => $ends_on,
                 'last_payment_date' => $last_payment_date, 'fiscal_year_id' => $fiscal_year_id,
                 'user_id' => $user_id];

        $validation = Validator::make(['month_name' => $month_name, 'starts_from' => $starts_from, 
                'ends_on' => $ends_on, 'last_payment_date' => $last_payment_date, 
                'fiscal_year_id' => $fiscal_year_id, 'user_id' => $user_id], [], []);
        

        $validation->after(function ($validation) 
            use($month_name, $starts_from, $ends_on, $last_payment_date, $fiscal_year_id, $user_id) {
        $checkCombination = BusinessMonth::where('fiscal_year_id', $fiscal_year_id)
                                         ->where('month_name', $month_name)
                                         ->where('starts_from', $starts_from)
                                         ->where('ends_on', $ends_on)
                                         ->where('last_payment_date', $last_payment_date)
                                         ->get();
        if (count($checkCombination) > 0) {
                $validation->errors()
                ->add('month_name', 'already exists');
            }
        });

        if ($validation->fails()) {


            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        
        }   
        else {
            $business_month->update($data);
            return redirect('/business_months')->with('message', 'month Updated'); 
        }

        //$business_month = BusinessMonth::create($data);
        return redirect('/business_months')->with('message', 'month was not updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $business_month = BusinessMonth::find($id);
        try {
            $business_month->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete this business month');
            return redirect('/business_months')->with('message', 'data cannot be deleted');
        }
        return redirect('/business_months')->with('message', 'data deleted');
    
    }

    public function GetMonthDataForDataTable(Request $request) {
        $business_month = new BusinessMonth();
        return $business_month->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
