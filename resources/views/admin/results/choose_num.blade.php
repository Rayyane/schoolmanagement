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
                        <h4 class="title">Results</h4>
                        <p class="category">Result section: Choose weekly test number</p>
                        <br>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/result/mark']) !!}
                            <div class="row" style="align-content: center">
                                <div class="col-md-5">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="text-align: center">
                                        {!! Form::label('test_number','Add marks for Weekly test no.?:') !!}
                                        {!! Form::number('test_number', null, ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('level_id', $level->id, ['class'=> 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        </div>
                                    </div>
                                    {{ Form::close() }}

                                    {!! Form::open(['method' => 'GET', 'url' => '/result/view_by_test_number']) !!}
                                    {{--{{dd($results)}}--}}
                                    {{--asd--}}
                                    <div class="form-group" style="text-align: center">
                                        {!! Form::label('test_number','View marks for Weekly test no.?:') !!}
                                        {!! Form::select('test_number', $results, null, ['class'=> 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>

                        </div>


                    </div>
                    <br>
                    <div class="header">
                        <h4 class="title">Students</h4>
                        <p class="category">Click on result button to see result</p>
                        <br>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="content table-responsive table-full-width">
                                <table id="resultDataTable" class="table table-striped">
                                    <thead>
                                    <th> Student name</th>
                                    <th> Action</th>
                                    </thead>
                                    @foreach($students as $student)
                                        <tr>
                                            <td> {{$student->name}} </td>
                                            <td>{!! Form::open(['method' => 'GET', 'url' => '/result/get_student/'.$student->id]) !!}
                                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
