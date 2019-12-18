<div class="row">
	<div class="col-md-4">
        <div class="form-group">
            
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('prefix','Prefix:') !!}
            {!! Form::text('prefix', isset($prefix->prefix) ? $prefix->prefix : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('created_by', request()->user()->id, ['class'=> 'form-control']) !!}
