@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<?php
	$url = Session::get('chooseNumURL');
	?>
	
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #f2f2f2;">
					<h4 class="title" align="center">Showing Weekly Result of {{$subject->subject_name}}</h4>

					<div class="panel-body">
						<div style="padding-top: 25px;">

							<div class="content table-responsive table-full-width">
								<table class="table table-striped">

									<thead>
										<th>Test no.</th>
										<th>Student Name</th>
										<th>Marks</th>
									</thead>


									@foreach($student_subject_result as $student_subject_result)
									

										<?php
										$student = \App\Student::find($student_subject_result->student_id);
            
										?>

										<tr>
											<td>
												{{$student_subject_result->weekly_test_number}}
											</td>

											<td>
												{{$student->name}}
											</td>

											<td>
												{{$student_subject_result->weekly_test_marks}}
											</td>
											
										</tr>
									
									@endforeach

								</table>
								<div class="form-group">
                                    <div class="text-center">
										{!! link_to($url, 'Add/View more', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
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