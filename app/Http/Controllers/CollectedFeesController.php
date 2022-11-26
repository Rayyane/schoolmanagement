<?php

namespace App\Http\Controllers;

use App\BusinessMonth;
use App\CollectedFees;
use App\Level;
use App\PaymentMethod;
use App\Prefix;
use App\Section;
use App\SectionStudent;
use App\SectionWiseFees;
use App\Session;
use App\Student;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class CollectedFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collected_fees = CollectedFees::all();

        return view('admin.collected_fees.index');
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
        $section_wise_fees = Level::with('level_enroll.section')->get();
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        $fees_types = SectionWiseFees::with('fees_type')->get();
        $business_months = BusinessMonth::pluck('month_name', 'id');
        $students = SectionStudent::with('student')->get();
        $payment_methods = PaymentMethod::pluck('method_name', 'id');

        return view('admin.collected_fees.create', ['sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections,
            'fees_types' => $fees_types, 'business_months' => $business_months, 'students' => $students, 'payment_methods' => $payment_methods, ]);
    }

    /**
     * Store a newly created fees and adjust previous.
     * version 1.0 (2019)
     * Author: Md Abdullah (Systech Digital Limited)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['student_id' => 'required',
            'payment_method_id' => 'required',
            'fees_book_leaf_number' => 'required',
            'total_collected' => 'required',
            'total_due' => 'required',
            'fees_book_leaf_prefix' => 'required',
            'total_advanced' => 'required',
            'collector_id' => 'required',
            'business_month_id' => 'required',
        ]);

        /*setting up fees types*/
        $fees_types = ($request->input('fees_type')) ? $request->input('fees_type') : [];
        $section_wise_fees_ids = '';
        $numItems = count($fees_types);
        $i = 0;
        foreach ($fees_types as $value) {
            if (++$i === $numItems) {
                $arr = explode('-', $value);
                $section_wise_fees_ids .= $arr[0];
            } else {
                $arr = explode('-', $value);
                $section_wise_fees_ids .= $arr[0].',';
            }
        }

        $cf = new CollectedFees();
        $cf->collector_id = $request->input('collector_id');
        $cf->student_id = $request->input('student_id');
        $section_student = SectionStudent::where('student_id', $request->input('student_id'))->get()->first();
        $cf->section_student_id = $section_student->id;
        $cf->payment_method_id = $request->input('payment_method_id');
        $cf->prefix_id = $request->input('fees_book_leaf_prefix');
        $cf->fees_book_leaf_number = $request->input('fees_book_leaf_number');
        $cf->collection_date = $request->input('collection_date');
        $cf->total_collected = $request->input('total_collected');
        $cf->discount_amount = ($request->input('discount_amount')) ? $request->input('discount_amount') : 0;
        $cf->total_due = $request->input('total_due');
        $cf->total_advanced = $request->input('total_advanced');
        $cf->business_month_id = $request->input('business_month_id');
        $cf->section_wise_fees_ids = $section_wise_fees_ids;
        $cf->save();

        /*Adjust previous due and advanced*/
        $old_fees = CollectedFees::where('section_student_id', $cf->student_id)->orderBy('created_at', 'desc')->first();
        $old_fees->total_due = 0;
        $old_fees->total_advanced = 0;
        $old_fees->save();

        return redirect('collected_fees/create')->with('success', '<a href="'.url('collected_fee/invoice/'.$cf->id).'"> Successfully add fees. Please download invoice from here</a>');
    }

    /**
     * Generate Pdf for specific fees
     * version 1.0 (2019)
     * Author: Md. Abdullah (Systech Digital Limited)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdfInvoice($id)
    {
        /*Getting data for pdf invoice*/
        $cf = CollectedFees::findOrFail($id);
        $collected = $cf;

        $f = new NumberToWords();
        $numberTransformer = $f->getNumberTransformer('en');
        $collected->total_collected_word = ucwords($numberTransformer->toWords($cf->total_collected));

        $payment_method = PaymentMethod::findOrFail($cf->payment_method_id);
        $business_month = BusinessMonth::findOrFail($cf->business_month_id)->pluck('month_name', 'id')->first();
        $section_student = SectionStudent::where('student_id', $cf->student_id)->with('student')->with('section')->with('section.level_enroll.level')->with('section.level_enroll.branch')->with('section.level_enroll.level')->with('section.level_enroll.shift')->first();
        $section_wise_fees = SectionWiseFees::whereIn('id', explode(',', $cf->section_wise_fees_ids))->with('fees_type')->get();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('admin.collected_fees.invoice_pdf', compact('collected', 'payment_method', 'business_month', 'section_student', 'section_wise_fees'));
        $mpdf->AddPage('L');
        $mpdf->SetFooter('');
        $mpdf->SetHTMLFooter('
            <div width="50%" style="float:left; font-size:10px; text-align:center;">powered by: Systech Digital Limited | PH:02-48951636 | Email:info@systechdigital.com
            </div>
            <div width="50%" style="float:left; font-size:10px; text-align:center;">powered by: Systech Digital Limited | PH:02-48951636 | Email:info@systechdigital.com
            </div>');
        $mpdf->SetTitle('Invoice of Fees');
        $mpdf->WriteHTML($html);
        $mpdf->Output($cf->id.'-fees.pdf', 'D');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collected_fees = CollectedFees::find($id);
        $students = Student::pluck('name', 'id');
        $payment_methods = PaymentMethod::pluck('method_name', 'id');

        return view('admin.collected_fees.edit', ['collected_fees' => $collected_fees, 'students' => $students,
            'payment_methods' => $payment_methods, ]);
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
        $collected_fees = CollectedFees::find($id);

        $this->validate($request, ['student_id' => 'required',
            'payment_method_id' => 'required',
            'fees_book_leaf_number' => 'required',
            'total_collected' => 'required',
            'total_due' => 'required',
            'total_advanced' => 'required',
            'collector_id' => 'required',
        ]);
        $student_id = $request->input('student_id');
        $section_student = SectionStudent::where('student_id', $student_id)->get()->first();
        //dd($section_student);
        $section_student_id = $section_student->id;
        $collection_date = $request->input('collection_date');
        $payment_method_id = $request->input('payment_method_id');
        $fees_book_leaf_number = $request->input('fees_book_leaf_number');
        $total_collected = $request->input('total_collected');
        $total_due = $request->input('total_due');
        $total_advanced = $request->input('total_advanced');
        $collector_id = $request->input('collector_id');
        $data = ['student_id' => $student_id, 'section_student_id' => $section_student_id,
            'collection_date' => $collection_date, 'payment_method_id' => $payment_method_id,
            'fees_book_leaf_number' => $fees_book_leaf_number, 'total_collected' => $total_collected,
            'total_due' => $total_due, 'total_advanced' => $total_advanced, 'collector_id' => $collector_id,
        ];
        $collected_fees->update($data);

        return redirect('/collected_fees')->with('message', 'data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collected_fees = CollectedFees::find($id);
        $collected_fees->delete();

        return redirect('/collected_fees')->with('message', 'Data Deleted!');
    }

    /**
     * get old fees data and get data in second form for fees collection and calcuation
     * Version : 1.0 (2019)
     * Author: Md. Abdullah (Systech Digital Limited)
     *
     * @param  Request  $input
     * @return \Illuminate\Http\Response
     */
    public function calculateFees(Request $request)
    {
        $session_id = $request->input('session_id');
        $student_id = $request->input('student_id');
        $section_id = $request->input('section_id');
        $business_month_id = $request->input('business_month_id');
        $section_student_id = $request->input('section_student_id');

        $session = Session::findOrFail($session_id)->pluck('name', 'id')->first();
        $business_month = BusinessMonth::findOrFail($business_month_id)->pluck('month_name', 'id')->first();
        $section_student = SectionStudent::where('student_id', $student_id)->with('student')->with('section')->with('section.level_enroll.level')->first();

        $old_fees = CollectedFees::where('section_student_id', $section_student->id)->orderBy('created_at', 'desc')->first();

        $leaf_prefix = Prefix::pluck('prefix', 'id');

        $section_wise_fees = SectionWiseFees::where([['session_id', $session_id], ['section_id', $section_id], ['business_month_id', $business_month_id]])->with('fees_type')->get();

        $payment_methods = PaymentMethod::pluck('method_name', 'id');

        return view('admin.collected_fees.form2', compact('payment_methods', 'section_wise_fees', 'section_student', 'business_month', 'session', 'old_fees', 'leaf_prefix', 'student_id', 'business_month_id'));
    }

    public function GetDataForDataTable(Request $request)
    {
        $collected_fees = new CollectedFees();

        return $collected_fees->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
