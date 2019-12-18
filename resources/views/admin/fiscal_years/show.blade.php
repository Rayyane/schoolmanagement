@section('heading')
    Fiscal Year
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $branch = \App\Branch::find($fiscal_year->branch_id);
    $user = \App\User::find($fiscal_year->user_id);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Fiscal Year Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('year','Fiscal Year') !!}
                                            {!! Form::label('year', isset($fiscal_year->year) ?  $fiscal_year->year : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                            {!! Form::label('starts_from','Starts From:') !!}
                                            {!! Form::label('starts_from', isset($fiscal_year->starts_from) ?  $fiscal_year->starts_from : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                            {!! Form::label('ends_on','Ends On:') !!}
                                            {!! Form::label('ends_on', isset($fiscal_year->ends_on) ?  $fiscal_year->ends_on : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('branch_id','Branch:') !!}
                                            {!! Form::label('branch_id', isset($branch->name) ? $branch->name : null, ['class'=> 'form-control']) !!}
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
