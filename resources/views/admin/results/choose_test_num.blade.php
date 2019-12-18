@section('heading')
Results
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card card-plain">

                @if(Session::has('message'))
                {{ Session::get('message') }}
                @endif

                <div class="header">
                    <h4 class="title">Results section</h4>
                    <p class="category">Choose weekly test number of the student</p>
                    <br>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/results/'.$student->id]) !!}
                        <div class="row" style="align-content: center">
                            <div class="col-md-5">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('test_number','View marks for Weekly test no.?:') !!}
                                    {{--{{dd($student)}}--}}
                                    {!! Form::hidden('student_id', $student->id, ['class'=> 'form-control']) !!}
                                    {!! Form::select('test_number', $results, null, ['class'=> 'form-control']) !!}<br>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection