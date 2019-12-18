<div class="row">
    <div class="col-md-4">
        <div class="form-group"> 
            {!! Form::label('levels','Choose class:') !!}
            {!! Form::select('level_id', $levels, isset($level_enroll->level_id) ? $level_enroll->level_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group"> 
            {!! Form::label('sessions','Choose session:') !!}

            {!! Form::select('session_id', $sessions, isset($level_enroll->session_id) ? $level_enroll->session_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('shifts','Choose shift:') !!}

            {!! Form::select('shift_id', $shifts, isset($level_enroll->shift_id) ? $level_enroll->shift_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"> 

            {!! Form::label('branches','Choose Branch:') !!}

            {!! Form::select('branch_id', $branches, isset($level_enroll->branch_id) ? $level_enroll->branch_id :null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>