@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<?php
    $url = Session::get('chooseNumURL');
    $thisStudentSubjectResult = $student_subject_results->first();
    ?>
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #f2f2f2;">
					<h4 class="title" align="center">Viewing result of weekly test {{$weekly_test_number}}<br>of {{$term->term_name}}</h4>

					<div class="panel-body">
						<div style="padding-top: 25px;">

							<div class="content table-responsive table-full-width">
								<div class="row">
									<div class="col-md-6">
										{!! Form::label('created_at','Created at') !!}
										{!! Form::label('created_at', isset($thisStudentSubjectResult->created_at) ? $thisStudentSubjectResult->created_at : null, ['class'=> 'form-control']) !!}
									</div>

									

									<div class="col-md-6">
										{!! Form::label('updated_at','Updated at') !!}
										{!! Form::label('updated_at', isset($thisStudentSubjectResult->updated_at) ? $thisStudentSubjectResult->updated_at : null, ['class'=> 'form-control']) !!}
									</div>
								</div>
								<table class="table table-striped">

									<thead>
										<th>Student Name</th>
										<th>Subject Name</th>
										<th>Marks</th>
										<th>Action</th>
										
									</thead>


									@foreach($student_subject_results as $student_subject_result)
								
										<?php
										$sec_sub_teacher = 
										\App\Models\SectionSubjectTeacher::find($student_subject_result->section_subject_teacher_id);

										$subject = 
										\App\Models\Subject::find($sec_sub_teacher->subject_id);
            							
            							$student = \App\Models\Student::find($student_subject_result->student_id);
										?>

										<tr>
											
											<td>
												{{$student->name}}
											</td>

											<td>
												{{$subject->subject_name}}
											</td>

											<td>
												{{$student_subject_result->weekly_test_marks}}
											</td>

											<td>
												{!! Form::open(['method' => 'GET', 'url' => ['/weeklytests/'. $student_subject_result->id. '/edit']]) !!}
												{!! Form::hidden('section_subject_teacher_id', $sec_sub_teach_id, ['class'=> '']) !!}
												{!! Form::submit('Edit', array('class'=> 'btn btn-sm btn-info')) !!}
												{!! Form::close() !!}
												
												
												
											</td>
											
										</tr>
									
									@endforeach

								</table>
								<div class="form-group">
                            		<div class="text-center">
										{!! link_to($url, 'Back', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
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