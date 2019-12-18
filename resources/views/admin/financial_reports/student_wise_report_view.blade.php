@section('heading')
    Payment Details
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Payment Information Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">
                                <div class="row" style="align-content: center">
                                    <div class="col-md-8">
                                        <div class="form-group" style="text-align: center">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            
                                            {!! Form::open(['method' => 'GET', 'url' => ['/pdf/student-financial-history/'.$collected_fees->id]]) !!}
                                            {!! Form::hidden('student_id', $student->id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('level_id', $level->id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('business_month_id', $business_month->id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('collector_id', $user->id, ['class'=> 'form-control']) !!}
                                            {!! Form::submit('Download PDF', array('class'=> 'btn btn-info btn-wd')) !!}
                                            
                                            {!! Form::close() !!}
                                                
                                        </div>
                                    </div>
                                </div>
                                <br>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            {!! Form::label('name','Student Name') !!}
                                            {!! Form::label('name', $student->name, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('roll_no','Roll no.') !!}
                                            {!! Form::label('roll_no', $student->roll_no, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('level','Class:') !!}
                                            {!! Form::label('level', $level->class_name, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('section','Section:') !!}
                                            {!! Form::label('section', $section->section_name, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('month','Payment for month') !!}
                                            {!! Form::label('month', $business_month->month_name, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('collection_date','Collection Date:') !!}
                                            {!! Form::label('collection_date', $collected_fees->collection_date, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('collected_amount','Collected Amount') !!}
                                            {!! Form::label('collected_amount', $collected_fees->total_collected, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('total_due','Dues Kept:') !!}
                                            {!! Form::label('total_due', $collected_fees->total_due, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('total_advanced','Advance Paid:') !!}
                                            {!! Form::label('total_advanced', $collected_fees->total_advanced, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('discount_amount','Discount Given') !!}
                                            {!! Form::label('discount_amount', $collected_fees->discount_amount, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('collector','Collector:') !!}
                                            {!! Form::label('collector', $user->name, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Created') !!}
                                            {!! Form::label('name', $collected_fees->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $collected_fees->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
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
</div>

@endsection
