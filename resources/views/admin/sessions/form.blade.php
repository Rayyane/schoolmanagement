<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name','Name of Session') !!}
            {!! Form::text('name', isset($session->name) ? $session->name : null, ['class'=> 'form-control']) !!}

            {!! Form::label('starts_from','Session starts on:') !!}
            {!! Form::date('starts_from', isset($session->starts_from) ? $session->starts_from : null, ['class'=> 'form-control']) !!}

            {!! Form::label('ends_to','Session ends on:') !!}
            {!! Form::date('ends_to', isset($session->ends_to) ? $session->ends_to : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>