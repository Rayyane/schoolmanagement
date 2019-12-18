@section('heading')
    Voucher
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    //$branch = \App\Branch::find($fiscal_year->branch_id);
    $user = \App\User::find($voucher->created_by);
    $supplier = \App\Supplier::find($voucher->supplier_id);
    $category = \App\Category::find($voucher->category_id);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Voucher Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('account_name','Account Name') !!}
                                            {!! Form::label('account_name', isset($voucher->account_name) ? $voucher->account_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('created_by','Created by') !!}
                                            {!! Form::label('created_by', isset($user->name) ? $user->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('category_id','Category') !!}
                                            {!! Form::label('category_id', isset($category->category_name) ? $category->category_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('supplier_id','Supplier') !!}
                                            {!! Form::label('supplier_id', isset($supplier->supplier_name) ? $supplier->supplier_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('description','Description') !!}
                                            {!! Form::label('description', isset($voucher->description) ? $voucher->description : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('amount','Amount') !!}
                                            {!! Form::label('amount', isset($voucher->amount) ? $voucher->amount : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('action_date','Action Date') !!}
                                            {!! Form::label('action_date', isset($voucher->action_date) ? $voucher->action_date : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Created') !!}
                                            {!! Form::label('name', $voucher->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $voucher->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
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
