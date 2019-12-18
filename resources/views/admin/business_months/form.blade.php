<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('month_name','Month:') !!}
            {!! Form::text('month_name', isset($business_month->month_name) ? $business_month->month_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('fiscal_years','Choose Fiscal Year:') !!}
            {!! Form::select('fiscal_year_id', $fiscal_years, isset($business_month->fiscal_year_id) ? $business_month->fiscal_year_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('starts_from','Month start date:') !!}
            {!! Form::date('starts_from', isset($business_month->starts_from) ? $business_month->starts_from : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('ends_on','Month end date:') !!}
            {!! Form::date('ends_on', isset($business_month->ends_on) ? $business_month->ends_on : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('last_payment_date','Last payment date:') !!}
            {!! Form::date('last_payment_date', isset($business_month->last_payment_date) ? $business_month->last_payment_date : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('user_id', request()->user()->id, ['class'=> 'form-control']) !!}