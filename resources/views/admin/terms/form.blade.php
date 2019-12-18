<div class="form-group">
    {!! Form::label('term_name','Term name:') !!}
    {!! Form::text('term_name', isset($term->term_name) ? $term->term_name : null, ['class'=> 'form-control']) !!}
</div>