<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('starts_from','Start date:') !!}
            {!! Form::date('starts_from', null, ['class'=> 'form-control']) !!}
            </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('ends_on','End date:') !!}
            {!! Form::date('ends_on', null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>