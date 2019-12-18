<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('fees_type_name','Fees Type:') !!}
            {!! Form::text('fees_type_name', isset($fees_type->fees_type_name) ? $fees_type->fees_type_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

{!! Form::hidden('user_id', request()->user()->id, ['class'=> 'form-control']) !!}