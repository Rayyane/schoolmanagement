@section('heading')
Weekly Test
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card card-plain" style="padding-top: 10px">

                @if(Session::has('message'))
                {{ Session::get('message') }}
                @endif

                
                <div class="panel panel-default">
                    <div class="header">
                    <h4 class="title text-center">Results</h4>
                    <p class="category text-center">Weekly test result edit section</p>
                    <br>
                </div>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => ['/weeklytest_updateMarks']]) !!}
                        {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                        <?php
                        $student = \App\Student::find($student_subject_result->student_id);

                        $sec_sub_teacher = 
                        \App\SectionSubjectTeacher::find($student_subject_result->section_subject_teacher_id);

                        $subject = 
                        \App\Subject::find($sec_sub_teacher->subject_id);

                        ?>
                        <div class="row" style="align-content: center">
                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('student_id','Editing mark of student:') !!}<br>>
                                    
                                    {!! Form::label('student_id', $student->name, null, ['class'=> 'form-control']) !!}

                                    
                                </div>

                                <!-- ******************** -->

                            </div>   
                            <div class="col-md-3">

                            </div>   

                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('subject_id','Of Subject:') !!}<br>>
                                    {!! Form::label('subject_id', $subject->subject_name, null, ['class'=> 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">

                            </div>  

                            <!-- ******************** -->

                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('weekly_test_number','Of Weeklytest No:') !!}<br>>
                                    {!! Form::label('weekly_test_number', $student_subject_result->weekly_test_number, null, ['class'=> 'form-control']) !!} 

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                
                            </div>
                            <div class="col-md-2">
                                <div class="text-center">
                                    {!! Form::label('weekly_test_marks', 'Marks') !!}
                                    {!! Form::hidden('section_subject_teacher_id', $section_subject_teacher_id, ['class'=> '']) !!}
                                    {!! Form::hidden('weekly_test_number', $student_subject_result->weekly_test_number, ['class'=> '']) !!}
                                    {!! Form::hidden('student_subject_result_id', $student_subject_result->id, ['class'=> '']) !!}
                                    
                                    {!! Form::number('weekly_test_marks', isset($student_subject_result->weekly_test_marks) ? $student_subject_result->weekly_test_marks : null, ['max'=>'25',
                                    'min'=>'0', 'step'=>'0.5', 'class'=> 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                        <br>
                        
                            

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Update', array('class'=> 'btn btn-primary btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                                {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                            </div>
                        </div>
                        
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection