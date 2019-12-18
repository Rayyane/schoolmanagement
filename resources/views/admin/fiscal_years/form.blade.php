<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('year','Year:') !!}
            {!! Form::text('year', isset($fiscal_year->year) ? $fiscal_year->year : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('branches','Choose branch:') !!}
            {!! Form::select('branch_id', $branches, isset($fiscal_year->branch_id) ? $fiscal_year->branch_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('starts_from','Fiscal year start date:') !!}
            {!! Form::date('starts_from', isset($fiscal_year->starts_from) ? $fiscal_year->starts_from : null, ['class'=> 'form-control']) !!}
            </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('ends_on','Fiscal year end date:') !!}
            {!! Form::date('ends_on', isset($fiscal_year->ends_on) ? $fiscal_year->ends_on : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('user_id', request()->user()->id, ['class'=> 'form-control']) !!}