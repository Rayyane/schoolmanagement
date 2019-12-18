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
                        <h4 class="title" align="center">Assign marks to students</h4>

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
                                    <table class="table table-striped">

                                        <thead>
                                        <th>Student Name</th>
                                        <th>Marks</th>
                                        </thead>


                                        @foreach($students as $student)
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {!! Form::label('student_name[]', $student->name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('student_id[]', $student->id, ['class'=> '']) !!}
                                                    {!! Form::hidden('subject_id[]', $subject->id, ['class'=> '']) !!}
                                                    {!! Form::hidden('test_number[]',$testNumber, ['class'=> '']) !!}
                                                </td>

                                                <td>
                                                    {!! Form::number('subject_marks[]', null, ['class'=> 'form-control']) !!}
                                                </td>

                                            </tr>
                                            </tbody>
                                        @endforeach

                                    </table>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
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
