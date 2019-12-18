@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<?php
	$viewStudentResultURL = \Request::fullUrl();
    Session::put('viewStudentResultURL', $viewStudentResultURL);
    //dd(Session::get('viewStudentResultURL'));
	$url = Session::get('viewSubjectsURL');
	$term = \App\Term::find($term_id);
	//dd($isGenerated);
	?>
	<br>
	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #e6e6e6;">
					<h4 class="title" align="center">Showing Weekly Result of <br><br>
						<p>{{ $student->name }}</p>
						<p>{{ "Roll no: " }} {{ $student->roll_no }}
						</h4>

						<div class="panel-body">
							<div style="padding-top: 25px;">

								<div class="row" style="align-content: center">
									<div class="col-md-2">
										<div class="form-group" style="text-align: center">
											{{"Session:"}}
											{{$session->name}}({{$term->term_name}})
										</div>
									</div> 

									<div class="col-md-3">
									</div>

									<div class="col-md-2">
										<div class="form-group" style="text-align: center">
											{{"Class:"}}
											{{$level->class_name}}
										</div>
									</div> 

									<div class="col-md-3">
									</div>

									<div class="col-md-2">
										<div class="form-group" style="text-align: center">
											{{"Section:"}}
											{{$section->section_name}}
										</div>
									</div> 


								</div>



								<div class="content table-responsive table-full-width">
									{!! Form::open(['method' => 'GET', 'url' => ['/weekly_test/generate_term_result']]) !!}
									{!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
									{!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
									<table class="table table-striped">

										<thead>
											<th>Test no.</th>
											<th>Subjects</th>
											<th>Marks</th>
										</thead>


										@foreach($student_subject_results as $student_subject_result)

										<?php
										
										$section_subject_teacher = 
										\App\SectionSubjectTeacher::find($student_subject_result->section_subject_teacher_id);

										$subject = 
										\App\Subject::find($section_subject_teacher->subject_id);

										?>


										<tr>
											<td>
												{{$student_subject_result->weekly_test_number}}
											</td>

											<td>
												{{$subject->subject_name}}
											</td>

											<td>
												{{$student_subject_result->weekly_test_marks}}
											</td>

										</tr>

										@endforeach

									</table>
									<div class="form-group">
										<div class="text-center">


											{!! Form::submit('Generate Term Result', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}

											{!! link_to($url, 'Back', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
									
											{!! Form::close() !!}
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