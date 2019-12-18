<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TermResult;

class ReportController extends Controller
{
    public function weeklyTest($id, Request $request){
        //dd($id);
    	$term_id = $id;
        $section_student_id = $request->section_student_id;
    	//dd($section_student_id);
    	$term_results = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->get();
        //dd($term_results);
    	$section_student = \App\SectionStudent::find($section_student_id);
        $student = \App\Student::find($section_student->student_id);
        $term = \App\Term::find($term_id);
        //dd($term);
        $section = \App\Section::find($section_student->section_id);
        $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
        $level = \App\Level::find($level_enroll->level_id);
        $session = \App\Session::find($level_enroll->session_id);
    	//dd(count($term_results));
    	$mpdf = new \Mpdf\Mpdf();

    	$html = view('admin.report.termReport')
    	->with(['term_results' => $term_results, 'section_student' => $section_student, 
    		'student' => $student, 'term' => $term, 'section' => $section, 'level' => $level,
    		'session' => $session]);
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
