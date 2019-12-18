<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('name','Name of Student') !!}
            {!! Form::text('name', isset($student->name) ? $student->name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('roll_no','Student roll no.') !!}
            {!! Form::text('roll_no', isset($student->roll_no) ? $student->roll_no : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fathers_name','Father Name') !!}
            {!! Form::text('fathers_name', isset($student->fathers_name) ? $student->fathers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('mothers_name','Mother Name') !!}
            {!! Form::text('mothers_name', isset($student->mothers_name) ? $student->mothers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('date_of_birth','Date of Birth') !!}
            {!! Form::date('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('nationality','Nationality') !!}
            {!! Form::text('nationality', isset($student->nationality) ? $student->nationality : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('religion','Religion') !!}
            {!! Form::text('religion', isset($student->religion) ? $student->religion : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('admission_date','Admission Date') !!}
            {!! Form::date('admission_date', isset($student->admission_date) ? $student->admission_date : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('gender','Student Gender') !!}
            {!! Form::select('gender', array('Male' => 'Male','Female' => 'Female'),isset($student->gender) ? $student->gender : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('contact_no','Contact no.') !!}
            {!! Form::text('contact_no', isset($student->contact_no) ? $student->contact_no : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fathers_cell','Fathers Contact no.') !!}
            {!! Form::text('fathers_cell', isset($student->fathers_cell) ? $student->fathers_cell : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('mothers_cell','Mothers Contact no.') !!}
            {!! Form::text('mothers_cell', isset($student->mothers_cell) ? $student->mothers_cell : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('present_address','Present Address of Student') !!}
            {!! Form::textarea('present_address', isset($student->present_address) ? $student->present_address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            {!! Form::label('permanent_address','Permanent Address of Student') !!}
            {!! Form::textarea('permanent_address', isset($student->permanent_address) ? $student->permanent_address : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('student_photo','Choose image') !!}
            {!! Form::file('student_photo') !!}
        </div>
    </div>
</div>
