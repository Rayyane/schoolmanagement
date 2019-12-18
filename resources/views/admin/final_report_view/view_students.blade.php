@section('heading')
    Final Result
@endsection


@extends('layouts.app')

@section('content')
<?php
    $viewFinalReportURL = \Request::fullUrl();
    Session::put('viewFinalReportURL', $viewFinalReportURL);
    //dd(Session::get('viewFinalStudentURL'));
    $url = Session::get('viewFinalStudentURL');
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
                                        
                                        
                                        <thead>
                                        <th>Student Name</th>
                                        <th> Roll no. </th>
                                        </thead>


                                        @foreach($section_students as $section_student)
                                            <tbody>

                                                <?php
                                                $student = \App\Student::find($section_student->student_id);
                                                ?>
                                                
                                            <tr>
                                                
                                                
                                                <td>
                                                    {!! Form::open(['method' => 'GET', 'url' => '/final_report_view/process_student/'.$student->id]) !!}
                                                    {!! Form::label('Student Name', $student->name, ['class'=> 'form-control']) !!}
                                                    
                                                    
                                                </td>

                                                <td>
                                                    
                                                    {!! Form::label('', $student->roll_no, ['class'=> 'form-control']) !!}
                                                    
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <div class="form-group" style="text-align: center">
                                                                {!! Form::submit('View Final Result', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                                {!! Form::close() !!}
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach

                                        
                                    </table>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! link_to($url, 'Back', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
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
