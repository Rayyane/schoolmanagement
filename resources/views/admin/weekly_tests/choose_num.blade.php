@section('heading')
Weekly Test
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $url = Session::get('viewSubjectsURL');
    $chooseNumURL = \Request::fullUrl();
    Session::put('chooseNumURL', $chooseNumURL);

    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card card-plain">

                @if(Session::has('message'))
                {{ Session::get('message') }}
                @endif

                
                <div class="panel panel-default">
                    <div class="header">
                        <h4 class="title text-center">Results</h4>
                        <p class="category text-center">Result section: Choose weekly test number</p>
                        <br>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/mark']) !!}
                        {!! Form::hidden('term_id', $term_id, ['class'=> 'form-control']) !!}
                        <div class="row" style="align-content: center">
                            <div class="col-md-4">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('weekly_test_number','Add marks for Weekly test no.?:') !!}
                                    {!! Form::number('weekly_test_number', null, ['class'=> 'form-control']) !!}
                                    {!! Form::hidden('sec_sub_teach_id', $sec_sub_teach->id, ['class'=> 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! link_to($url, 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                            </div>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>

                <br>

                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/view_by_number']) !!}
                        {!! Form::hidden('term_id', $term_id, ['class'=> 'form-control']) !!}
                        <div class="row" style="align-content: center">
                            <div class="col-md-4">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('weekly_test_number','View marks for Weekly test no.:') !!}
                                    {!! Form::select('student_subject_result_id', $student_subject_result, null, ['class'=> 'form-control']) !!}
                                    {!! Form::hidden('sec_sub_teach_id', $sec_sub_teach->id, ['class'=> 'form-control']) !!}
                                </div>
                                
                                     
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! link_to($url, 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
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
