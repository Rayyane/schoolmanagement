@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #f2f2f2;">
					<h4 class="title" align="center">View Subject-wise Result</h4>

					<div class="panel-body">
						<div style="padding-top: 25px;">

							<div class="content table-responsive table-full-width">
								<table class="table table-striped">

									<thead>
										<th>Subject Name</th>

										<th>Action</th>
									</thead>


									@foreach($section_subject_teacher as $sec_sub_teach)
									<tbody>

										<?php
										$subject = \App\Subject::find($sec_sub_teach->subject_id);
            
										?>

										<tr>
											{!! Form::open(['method' => 'GET', 'url' => '/weekly_test/view_subject_wise_result/']) !!}
											<td>

												{!! Form::label('Subject Name', $subject->subject_name, ['class'=> 'form-control']) !!}
												{!! Form::hidden('section_subject_teacher_id', $sec_sub_teach->id, ['class'=> '']) !!} 

											</td>



											<td>
												{!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
											</td>
											{!! Form::close() !!}
										</tr>
									</tbody>
									@endforeach

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection