@section('heading')
    Results
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif

                    <div class="header">
                        <h4 class="title">Results</h4>
                        <p class="category">Result section</p>
                        <br>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/result/add']) !!}
                            <div class="row" style="align-content: center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="text-align: center">
                                        {!! Form::label('levels','Choose class:') !!}
                                        {!! Form::select('level_id', $levels, null, ['class'=> 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    {!! Form::submit('Search', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection