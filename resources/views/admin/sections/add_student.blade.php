@section('heading')
Sections
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

	<?php
		$url = Session::get('sectionIndexURL');
		//dd($url);
		$section = \App\Models\Section::find($section->id);
	?>


	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading"  style="background-color: #f2f2f2;">
					<h4 class="title" align="center">Assign students to section</h4>
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

					<div class="header">
						<h4 class="title">Add Student</h4>
					</div>
					


					<div class="form-group text-left">
						
						{!! Form::open(['method' => 'POST', 'url' => '/section/save_student']) !!}
						@include('admin.sections.add_student_form')
						{!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						{!! Form::close() !!}

					</div>

					<div class="form-group text-left">
						{!! Form::open(['method' => 'GET', 'url' => ['/sectionStudents/'.$section->id]]) !!}
						{!! Form::submit('View Students', array('class'=> 'btn btn-primary btn-fill btn-wd')) !!}
						
						{!! Form::close() !!}
					</div>

					<div class="form-group text-left">
						{!! link_to($url, 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}

					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection





