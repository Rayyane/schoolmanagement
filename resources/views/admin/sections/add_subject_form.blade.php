<div class="row">
	<div class="col-md-6">
		<div class="form-group"> 
			{!! Form::label('subjects','Choose subject:') !!}

			{!! Form::select('subject_id', $subjects, isset($subject->id) ? $subject->id :null, ['class'=> 'form-control']) !!}
			{!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group"> 
			{!! Form::label('teachers','Choose subject teacher:') !!}

			{!! Form::select('teacher_id', $teachers, isset($teacher->id) ? $teacher->id :null, ['class'=> 'form-control']) !!}
			
		</div>
	</div>
</div>