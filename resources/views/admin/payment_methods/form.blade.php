<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('method_name','Method:') !!}
            {!! Form::text('method_name', isset($payment_method->method_name) ? $payment_method->method_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('created_by', request()->user()->id, ['class'=> 'form-control']) !!}
