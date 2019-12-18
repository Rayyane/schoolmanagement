<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('subject_name','Name of Subject') !!}
            {!! Form::text('subject_name', isset($subject->subject_name) ? $subject->subject_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('levels','Choose class:') !!}

            {!! Form::select('level_id', $levels, isset($subject->level_id) ? $subject->level_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('teachers','Choose Subject Teacher:') !!}

            {!! Form::select('teacher_id', $teachers, isset($subject->teacher_id) ? $subject->teacher_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>