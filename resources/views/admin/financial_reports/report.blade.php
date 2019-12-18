@section('heading')
    Financial Report
@endsection

@extends('layouts.app')

@section('content')
<?php

?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Generate Report at Given Time</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('time','Selected time period:') !!}
                                        <br>
                                        {{$starts_from}}{{" to "}} {{$ends_on}}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('collected_fees','Total collected amount in given time:') !!}
                                        {{$collected_fees}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('vouchers','Total expenditure in given time:') !!}
                                        {{$vouchers}}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('sum','Sum of transactions:') !!}
                                        {{$sum}}
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
