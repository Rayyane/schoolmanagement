<div class="row">
    <div class="col-md-6">
		<div class="form-group">
		    {!! Form::label('name','Name of area') !!}
		    {!! Form::text('name', isset($areas->name) ? $areas->name : null, ['class'=> 'form-control']) !!}
		</div>
	</div>
</div>
