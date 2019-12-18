
	<div class="row">
		<div class="col-md-4">
			<div class="form-group text-center"> 
				{!! Form::label('students','Choose students:', ['class'=>'form-control text-center']) !!}

				{!! Form::select('student_id[]', $students, isset($student->id) ? $student->id :null, ['class'=> ' select2 form-control', 'id' => 'student_id', 'multiple'=>"multiple"]) !!}
				{!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#student_id').select2();
	});
</script>