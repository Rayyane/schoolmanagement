@section('heading')
    Section wise Fees
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $session = \App\Models\Session::find($section_wise_fees->session_id);
    $section = \App\Models\Section::find($section_wise_fees->section_id);
    $level_enroll = \App\Models\LevelEnroll::find($section->level_enroll_id);
    $level = App\Models\Level::find($level_enroll->level_id);
    $fees_type = \App\Models\FeesType::find($section_wise_fees->fees_type_id);
    $business_month = \App\Models\BusinessMonth::find($section_wise_fees->business_month_id);
    $user = \App\Models\User::find($section_wise_fees->user_id);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Section wise Fees Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('level_id','Class') !!}
                                            {!! Form::label('level_id', isset($level->class_name) ?  $level->class_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                       <div class="form-group">
                                            {!! Form::label('section_id','Section') !!}
                                            {!! Form::label('section_id', isset($section->section_name) ?  $section->section_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group">
                                            {!! Form::label('session_id','Session') !!}
                                            {!! Form::label('session_id', isset($session->name) ?  $session->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('bussiness_month_id','Month') !!}
                                            {!! Form::label('bussiness_month_id', isset($business_month->month_name) ? $business_month->month_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('fees_type_id','Fees Type') !!}
                                            {!! Form::label('fees_type_id', isset($fees_type->fees_type_name) ? $fees_type->fees_type_name : null, ['class'=> 'form-control']) !!}
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
                                            {!! Form::label('name', $section_wise_fees->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $section_wise_fees->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
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
