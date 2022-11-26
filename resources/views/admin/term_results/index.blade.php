@section('heading')
    Term Report
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $url = Session::get('viewSubjectsURL');
        
        ?>
        <br>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <?php
                    //dd($term_results);
                    $section_student_id = $term_results->first()->section_student_id;
                    $section_student = \App\Models\SectionStudent::find($section_student_id);
                    $student = \App\Models\Student::find($section_student->student_id);
                    $term = \App\Models\Term::find($term_results->first()->term_id);
                    $section = \App\Models\Section::find($section_student->section_id);
                    $level_enroll = \App\Models\LevelEnroll::find($section->level_enroll_id);
                    $level = \App\Models\Level::find($level_enroll->level_id);
                    $session = \App\Models\Session::find($level_enroll->session_id);

                    ?>
                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Showing {{$term->term_name}} Result of <br>


                            <p>{{$student->name}}</p>
                            <p>{{ "Roll no: " }} {{ $student->roll_no }}

                        </h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                <div class="row" style="align-content: center">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            
                                            {!! Form::open(['method' => 'GET', 'url' => ['/pdf/report-weekly-test/'.$term->id]]) !!}
                                            {!! Form::submit('Download PDF', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            {!! Form::hidden('section_student_id', $section_student_id, ['class'=> 'form-control']) !!}
                                            {!! Form::close() !!}
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="align-content: center">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            {{"Session:"}}
                                            {{$session->name}}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            {{"Class:"}}
                                            {{$level->class_name}}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            {{"Section:"}}
                                            {{$section->section_name}}
                                        </div>
                                    </div>


                                </div>


                                <div class="content table-responsive table-full-width">

                                    <table class="table table-striped">

                                        <thead>
                                        <th>Subjects</th>
                                        <th>Weekly Test Marks<br>(converted to 20)</th>
                                        <th>Term Marks<br>(in 100)</th>
                                        <th>Term Marks<br>(converted to 80)</th>
                                        <th>Term Total</th>
                                        <th>Letter Grade</th>
                                        <th>Points</th>

                                        </thead>


                                        @foreach($term_results as $term_result)

                                            <?php

                                            $section_subject_teacher =
                                                \App\Models\SectionSubjectTeacher::find($term_result->section_subject_teacher_id);

                                            $subject =
                                                \App\Models\Subject::find($section_subject_teacher->subject_id);

                                            $term_adjusted = (($term_result->term_marks) * 80) / 100;

                                            $letter_grade = "";
                                            $points = "0.0";
                                            $i = $term_result->total_marks;

                                            if ($i >= 80 && $i <= 100) {
                                                $letter_grade = "A+";
                                                $points = "5.0";
                                            } elseif ($i >= 70 && $i <80) {
                                                $letter_grade = "A";
                                                $points = "4.0";
                                            } elseif ($i >= 60 && $i <70) {
                                                $letter_grade = "A-";
                                                $points = "3.5";
                                            } elseif ($i >= 50 && $i <60) {
                                                $letter_grade = "B";
                                                $points = "3.0";
                                            } elseif ($i >= 40 && $i <50) {
                                                $letter_grade = "C";
                                                $points = "2.0";
                                            } elseif ($i >= 00 && $i <40) {
                                                $letter_grade = "F";
                                                $points = "0.0";
                                            }

                                            ?>


                                            <tr>
                                                <td>
                                                    {{$subject->subject_name}}
                                                </td>

                                                <td>
                                                    {{$term_result->weekly_avg}}

                                                </td>

                                                <td>
                                                    {{$term_result->term_marks}}
                                                </td>

                                                <td>
                                                    {{$term_adjusted}}
                                                </td>

                                                <td>
                                                    {{$term_result->total_marks}}
                                                </td>

                                                <td>
                                                    {{$letter_grade}}
                                                </td>

                                                <td>
                                                    {{$points}}
                                                </td>

                                            </tr>

                                        @endforeach

                                    </table>

                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        {!! link_to($url, 'View/Generate more', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection