<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('subject_name','Name of Subject') !!}
            {!! Form::text('subject_name', isset($subject->subject_name) ? $subject->subject_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    
</div>