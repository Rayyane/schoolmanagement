<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('teacher_name','Name of Teacher') !!}
            {!! Form::text('teacher_name', isset($teacher->teacher_name) ? $teacher->teacher_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('contact_no','Contact no.') !!}
            {!! Form::text('contact_no', isset($teacher->contact_no) ? $teacher->contact_no : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('date_of_birth','Date of Birth') !!}
            {!! Form::date('date_of_birth', isset($teacher->date_of_birth) ? $teacher->date_of_birth : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('nationality', 'Nationality') !!}
            {!! Form::text('nationality', isset($teacher->nationality) ? $teacher->nationality : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('religion', 'Religion') !!}
            {!! Form::text('religion', isset($teacher->religion) ? $teacher->religion : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fathers_name','Fathers Name') !!}
            {!! Form::text('fathers_name', isset($teacher->fathers_name) ? $teacher->fathers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('mothers_name','Mothers Name') !!}
            {!! Form::text('mothers_name', isset($teacher->mothers_name) ? $teacher->mothers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('salary','Salary') !!}
            {!! Form::text('salary', isset($teacher->salary) ? $teacher->salary : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('marital_status','Marital Status') !!}
            <br>
            <div class="radio-inline">
                @if(isset($teacher))
                    @if($teacher->marital_status=='Married')
                        {!! Form::radio('marital_status', 'Married', 'true') !!} Married
                        <br>
                        {!! Form::radio('marital_status', 'Single') !!} Single
                    @else
                        {!! Form::radio('marital_status', 'Married') !!} Married
                        <br>
                        {!! Form::radio('marital_status', 'Single', 'true') !!} Single
                    @endif
                @else
                    {!! Form::radio('marital_status', 'Married') !!} Married
                    <br>
                    {!! Form::radio('marital_status', 'Single') !!} Single
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('spouse_name','Name of Spouse') !!}
            {!! Form::text('spouse_name', isset($teacher->spouse_name) ? $teacher->spouse_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('present_address','Present Address') !!}
            {!! Form::textarea('present_address', isset($teacher->present_address) ? $teacher->present_address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('permanent_address','Permanent Address') !!}
            {!! Form::textarea('permanent_address', isset($teacher->permanent_address) ? $teacher->permanent_address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('teacher_photo','Choose image') !!}
            {!! Form::file('teacher_photo') !!}
        </div>
    </div>
</div>


