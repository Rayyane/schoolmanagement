@section('heading')
    Term Result
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-11">
                <div class="card card-plain">

                    <div class="panel-body">
                        <div class="header">
                        	<?php
                            
                        	$term_result_id = $term_results->first()->id;
                            $term_id = App\Models\TermResult::find($term_result_id)->term_id;
                        	$term = App\Models\Term::find($term_id);
                        	//dd($term);
                        	?>
                            <h4 class="title">{{$term->term_name}} Information</h4>
                            <p class="category">All Class of all branches</p>
                            <br>
                        </div>
                        <div class="content table-responsive table-full-width">
                        	<div class="row">
                                    <div class="col-md-4">
                                       <div class="title">
                                       	{!! Form::open(['method' => 'GET', 'url' => ['/view_report']]) !!}
                                        {{"Student Result already generated! View report card here:"}}
                                        @foreach($term_results as $term_result)
                                        {!! Form::hidden('term_result_id[]', $term_result->id, ['class'=> '']) !!}
                                        @endforeach
                                        <div class="form-group">
				                            <div class="text-center">
				                                {!! Form::submit('View', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
				                            </div>
				                        </div>
				                        {!! Form::close() !!}
                                    </div>

                                </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

