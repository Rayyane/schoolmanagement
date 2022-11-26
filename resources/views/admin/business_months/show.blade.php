@section('heading')
    Business Month
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $fiscal_year = \App\Models\FiscalYear::find($business_month->fiscal_year_id);
    $user = \App\Models\User::find($business_month->user_id);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Business Month Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('month_name','Business Month') !!}
                                            {!! Form::label('month_name', isset($business_month->month_name) ?  $business_month->month_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                            {!! Form::label('starts_from','Starts From:') !!}
                                            {!! Form::label('starts_from', isset($business_month->starts_from) ?  $business_month->starts_from : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                            {!! Form::label('ends_on','Ends On:') !!}
                                            {!! Form::label('ends_on', isset($business_month->ends_on) ?  $business_month->ends_on : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('fiscal_year_id','Year:') !!}
                                            {!! Form::label('fiscal_year_id', isset($fiscal_year->year) ? $fiscal_year->year : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('user_id','Created by:') !!}
                                            {!! Form::label('user_id', isset($user->name) ?  $user->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Created') !!}
                                            {!! Form::label('name', $fiscal_year->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $fiscal_year->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        {!! link_to(URL::previous(), 'Back', ['class' => 'btn btn-info btn-fill btn-wd']) !!}
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
