<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\CollectedFees;
use App\Branch;
use App\FiscalYear;
use App\BusinessMonth;
use App\Session;
use App\Level;
use App\Section;
use App\SectionStudent;
use App\Student;
use App\LevelEnroll;
use App\Prefix;
use App\User;


class FinancialReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$business_months = BusinessMonth::pluck('month_name', 'id');
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        $students = SectionStudent::with('student')->get();
        $fiscal_years = FiscalYear::with('business_month')->get();
        $business_months = BusinessMonth::all();
        $fiscal_years_plucked = FiscalYear::pluck('year', 'id');
        return view ('admin.financial_reports.index', ['fiscal_years' => $fiscal_years, 
            'business_months' => $business_months, 'fiscal_years_plucked' => $fiscal_years_plucked,
            'sessions' => $sessions, 'levels' => $levels, 'sections' => $sections, 'students' => $students
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
        dd($request);
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $collected_fees = CollectedFees::find($id);
        $student = Student::find($collected_fees->student_id);
        $section_student = SectionStudent::where('student_id', $student->id)->get()->first();
        $section = Section::find($section_student->section_id);
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $level = Level::find($level_enroll->level_id);
        $business_month = BusinessMonth::find($collected_fees->business_month_id);
        $prefix = Prefix::find($collected_fees->prefix_id);
        $user = User::find($collected_fees->collector_id);
        //dd($user);
        return view('admin.financial_reports.student_wise_report_view', ['collected_fees' => $collected_fees,
            'student' => $student, 'section_student' => $section_student, 'section' => $section, 
            'level' => $level, 'business_month' => $business_month, 'prefix' => $prefix, 'user' => $user
        ]);
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

    public function dateWiseReport(Request $request) 
    {
        $this->validate($request, ['starts_from' => 'required',
                                   'ends_on' => 'required',
                                   ]);
        $starts_from = $request->starts_from;
        $ends_on = $request->ends_on;
        $collected_fees = CollectedFees::whereBetween('collection_date', [$starts_from, $ends_on])
        ->sum('total_collected');
        $vouchers = Voucher::whereBetween('action_date', [$starts_from, $ends_on])->sum('amount');
        //$data = $request->only('starts_from', 'ends_on');
        $sum = $collected_fees - $vouchers;
        //dd($vouchers);
        return view('admin.financial_reports.report', ['collected_fees' => $collected_fees,
        'vouchers' => $vouchers, 'sum' => $sum, 'starts_from' => $starts_from, 'ends_on' => $ends_on]);
    }

    public function monthWiseReport(Request $request) 
    {
        $this->validate($request, ['business_month_id' => 'required',
                                   'fiscal_year_id' => 'required'
                                   ]);

        $business_month = BusinessMonth::find($request->input('business_month_id'));
        //dd($business_month);
        $starts_from = $business_month->starts_from;
        //dd($starts_from);
        $ends_on = $business_month->ends_on;
        $collected_fees = CollectedFees::whereBetween('collection_date', [$starts_from, $ends_on])
        ->sum('total_collected');
        $vouchers = Voucher::whereBetween('action_date', [$starts_from, $ends_on])->sum('amount');
        $sum = $collected_fees - $vouchers;
        return view('admin.financial_reports.report', ['collected_fees' => $collected_fees,
        'vouchers' => $vouchers, 'sum' => $sum, 'starts_from' => $starts_from, 'ends_on' => $ends_on]);
    }

    public function yearWiseReport(Request $request) 
    {
        $this->validate($request, ['fiscal_year_id' => 'required'
                                   ]);
        $fiscal_year = FiscalYear::find($request->input('fiscal_year_id'));
        //dd($fiscal_year);
        $starts_from = $fiscal_year->starts_from;
        //dd($starts_from);
        $ends_on = $fiscal_year->ends_on;
        $collected_fees = CollectedFees::whereBetween('collection_date', [$starts_from, $ends_on])
        ->sum('total_collected');
        $vouchers = Voucher::whereBetween('action_date', [$starts_from, $ends_on])->sum('amount');
        $sum = $collected_fees - $vouchers;
        return view('admin.financial_reports.report', ['collected_fees' => $collected_fees,
        'vouchers' => $vouchers, 'sum' => $sum, 'starts_from' => $starts_from, 'ends_on' => $ends_on]);

    }

    public function studentWiseReport(Request $request) 
    {
        $student = Student::find($request->input('student_id'));
        //dd($student);
        //$section_student = SectionStudent::where('student_id', $student->id)->get()->first();
        $collected_fees = CollectedFees::where('student_id', $student->id)->get();
        //dd($collected_fees);
        return view('admin.financial_reports.student_wise_report', ['student' => $student, 
            'collected_fees' => $collected_fees]);
    }

    public function studentWiseReportView($id, Request $request) {
        $collected_fees = CollectedFees::find($id);
        $student = Student::find($request->input('student_id'));
        $level = Level::find($request->input('level_id'));
        $section = Section::find($request->input('section_id'));
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $branch = Branch::find($level_enroll->branch_id);
        $business_month = BusinessMonth::find($request->input('business_month_id'));
        $collector = User::find($request->input('collector_id'));
        //dd($student);
        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.financial_reports.student_wise_pdf')
        ->with(['collected_fees' => $collected_fees, 'student' => $student, 
            'level' => $level, 'section' => $section, 'section' => $section, 'business_month' => $business_month,
            'collector' => $collector, 'branch' => $branch]);
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

    public function GetDataForDataTable(Request $request) {
        $collected_fees = new CollectedFees();
        return $collected_fees->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }

    public function GetStudentDataForDataTable(Request $request) {
        //dd($request);
        $limit = 20;
        $offset = 0;
        $search = [];
        $where = [];        
        $join = '';        
        $joinKey = '';        
        if($this->input->get('length')){
            $limit = $this->input->get('length',1);
        }       

        if($this->input->get('start')){
            $offset = $this->input->get('start',1);
        }


        $srchInput = $this->input->get('search',1);
        if(is_array($srchInput) && $srchInput['value'] != ""){
            $search = [
            'fees_book_leaf_number' => $srchInput['value'],

            ];
        }

        if($colInput = $this->input->get('columns',1)){
            foreach ($colInput as $keyC => $valueC) {
                if($valueC['searchable'] && $valueC['search']['value'] != ""){
                    $search[$valueC['data']] = $this->security->xss_clean($valueC['search']['value']);
                }
            }
        }

        if(isset($_REQUEST['where'])){
            $where = $this->security->xss_clean($_REQUEST['where']);
        }

        $where['collected_fees.student_id'] = 2;       
        $where[' and members.section_student_id'] = 1;
        //$where[' and cre.circular_type_id'] = 1;
         
        echo json_encode($this->ajax_model->GetListForStudentDataTable('collected_fees',$limit, $offset, $search, $where, $join, $joinKey));
        }
}
