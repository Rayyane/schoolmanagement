@section('heading')
    Weekly Result
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Student Information Details</h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                {{--<div class="row">
                                    <div class="form-group">
                                        <p><label class="text-left">Student Name:{{ $student->name }}</label>
                                            <label class="text-center">Roll no.:{{ $student->roll_no }}</label>
                                            <label class="text-right">Class:{{ $level->class_name }}</label></p>
                                    </div>
                                </div>--}}
                                <div class="content table-responsive table-full-width">

                                    {!! Form::open(['method' => 'POST', 'url' => '/results']) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('student_name', 'Name: ') !!}<br>
                                                {!! Form::label('student_name', $student->name) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('roll_no', 'Roll no. ') !!}<br>
                                                {!! Form::label('roll_no', $student->roll_no) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('student_level', 'Class: ') !!}<br>
                                                {!! Form::label('student_level', $level->class_name) !!}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::hidden('student_id', $student->id) }}
                                    <br>
                                    <table class="table table-bordered" style="background-color: lavender">
                                        <th>Subject Name</th>
                                        <th>Marks</th>
                                        @foreach($subjects as $subject)
                                            <tr>
                                                <td>{!! Form::text('subject_name[]', $subject->subject_name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('subject_id', $subject->id, ['class'=> 'form-control']) !!}
                                                </td>
                                                <td> {!! Form::number('subject_marks', null, ['class'=> 'form-control']) !!} </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
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
