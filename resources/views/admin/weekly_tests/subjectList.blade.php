@section('heading')
    Weekly Result
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $viewSubjectsURL = \Request::fullUrl();
        Session::put('viewSubjectsURL', $viewSubjectsURL);
        //dd($viewSubjectsURL);
        
        ?>
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Subject List for chosen section</h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                
                                <div class="content table-responsive table-full-width">
                                    
                                    <table class="table table-striped">

                                        <thead>
                                        <th>Subject Name</th>
                                        
                                        <th>Action</th>
                                        </thead>


                                        @foreach($section_subject_teachers as $sec_sub_teach)
                                            <tbody>

                                                <?php
                                                $subject = \App\Models\Subject::find($sec_sub_teach->subject_id);
                                                //dd($subject);
                                                ?>
                                                
                                            <tr>
                                                {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/proceed/']) !!}
                                                {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                                                <td>
                                                    
                                                    {!! Form::label('Subject Name', $subject->subject_name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('section_subject_teacher_id', $sec_sub_teach->id, ['class'=> '']) !!} 
                                                    
                                                </td>

                                                

                                                <td>
                                                    {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                </td>
                                                {!! Form::close() !!}
                                            </tr>
                                            </tbody>
                                        @endforeach

                                    </table>
                                    <!-- <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
 
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Student List for chosen section to view results</h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                
                                <div class="content table-responsive table-full-width">
                                    
                                    <table id="sectionStudentDataTable"  class="table table-striped">
                                        <thead>
                                        <th>Student Name</th>
                                        <th> Roll no. </th>
                                        <th>Action</th>
                                        </thead>


                                        @foreach($section_students as $section_student)
                                            <tbody>

                                                <?php
                                                $student = \App\Models\Student::find($section_student->student_id);
                                                
                                                //dd($subject);
                                                ?>
                                                
                                            <tr>
                                                {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/proceed_with_student_id/']) !!}
                                                
                                                <td>
                                                    
                                                    {!! Form::label('Student Name', $student->name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
                                                    {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!} 
                                                        
                                                </td>

                                                <td>
                                                    
                                                    {!! Form::label('', $student->roll_no, ['class'=> 'form-control']) !!}
                                                    
                                                    
                                                </td>
                                                

                                                <td>
                                                    {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                </td>
                                                {!! Form::close() !!}
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
