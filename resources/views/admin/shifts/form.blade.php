<div class="form-group">
    {!! Form::label('shift_name','Name of Shift') !!}
    {!! Form::text('shift_name', isset($shift->shift_name) ? $shift->shift_name : null, ['class'=> 'form-control']) !!}



    {!! Form::label('branches','Choose Branch:') !!}


    {!! Form::select('branch_id', $branches, isset($shift->branch_id) ? $shift->branch_id :null, ['class'=> 'form-control']) !!}

</div>