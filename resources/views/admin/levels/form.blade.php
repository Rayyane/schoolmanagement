

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('class_name','Class Name') !!}
            {!! Form::text('class_name', isset($level->class_name) ? $level->class_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"> 
            {!! Form::label('num_of_sub','Number of Subjects') !!}
            {!! Form::number('num_of_sub', isset($level->num_of_sub) ? $level->num_of_sub : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

