<div class="form-group">
    {!! Form::label('name','Accounts Title') !!}
    {!! Form::text('name', isset($account->name) ? $account->name : null, ['class'=> 'form-control']) !!}
</div>