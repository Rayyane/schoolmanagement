@section('heading')
    Fees Book
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $branch = \App\Models\Branch::find($fees_book->branch_id);
    $user = \App\Models\User::find($fees_book->creator_user_id);
    $teacher = \App\Models\Teacher::find($fees_book->teacher_id);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Fees Book Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('branch_id','Branch') !!}
                                            {!! Form::label('branch_id', isset($branch->name) ?  $branch->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('creator_user_id','Created by:') !!}
                                            {!! Form::label('creator_user_id', isset($user->name) ?  $user->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7">
                                       <div class="form-group">
                                            {!! Form::label('teacher_id','Assigned Teacher:') !!}
                                            {!! Form::label('teacher_id', isset($teacher->teacher_name) ?  $teacher->teacher_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            {!! Form::label('total_leaf','Total Leaf:') !!}
                                            {!! Form::label('total_leaf', isset($fees_book->total_leaf) ? $fees_book->total_leaf : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('leaf_start_number','Leaf Start Number:') !!}
                                            {!! Form::label('leaf_start_number', isset($fees_book->leaf_start_number) ?  $fees_book->leaf_start_number : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('leaf_end_number','Leaf End Number:') !!}
                                            {!! Form::label('leaf_end_number', isset($fees_book->leaf_end_number) ?  $fees_book->leaf_end_number : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Created') !!}
                                            {!! Form::label('name', $fees_book->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $fees_book->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
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
