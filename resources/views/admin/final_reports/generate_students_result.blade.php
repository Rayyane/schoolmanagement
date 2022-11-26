@section('heading')
    Final Result
@endsection


@extends('layouts.app')

@section('content')
    <?php
    $viewFinalStudentURL = \Request::fullUrl();
    Session::put('viewFinalStudentURL', $viewFinalStudentURL);
    //dd(Session::get('viewFinalStudentURL'));
    $url = Session::get('finalReportIndexURL');
    //dd($url);
    
    ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #e6e6e6;">
                    <h4 class="title" align="center">Student List for chosen section</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            
                            <div class="content table-responsive table-full-width">
                                
                                <table id="sectionStudentDataTable"  class="table table-striped">
                                    {!! Form::open(['method' => 'GET', 'url' => '/final_report/process_students/']) !!}
                                    {!! Form::hidden('section_id', $section_id, ['class'=> '']) !!} 
                                    <thead>
                                    <th>Student Name</th>
                                    <th> Roll no. </th>
                                    </thead>


                                    @foreach($section_students as $section_student)
                                        <tbody>

                                            <?php
                                            $student = \App\Models\Student::find($section_student->student_id);
                                            ?>
                                            
                                        <tr>
                                            
                                            <td>
                                                
                                                {!! Form::label('Student Name', $student->name, ['class'=> 'form-control']) !!}
                                                {!! Form::hidden('student_id[]', $student->id, ['class'=> '']) !!}
                                                
                                            </td>

                                            <td>
                                                
                                                {!! Form::label('', $student->roll_no, ['class'=> 'form-control']) !!}
                                                
                                            </td>
                                            
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="form-group" style="text-align: center">
                                            {!! Form::submit('Generate Final Result', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            {!! Form::close() !!}
                                            {!! link_to($url, 'Cancel', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
                                        </div>
                                    </div>
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
