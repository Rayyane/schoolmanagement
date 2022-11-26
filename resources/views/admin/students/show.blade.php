@section('heading')

    Student Profile

@endsection


@extends('layouts.app')

@section('content')
<div class="content">
    <?php
    $section_student = \App\Models\SectionStudent::where('student_id', $student->id)->get()->first();
    
    if($section_student!= null) {
      $section = \App\Models\Section::find($section_student->section_id);
      $level = \App\Models\Level::find(\App\Models\LevelEnroll::find($section->level_enroll_id)->level_id); 
    }
    else {
      //dd($section_student);
    }
    
    ?>
    <div class="row">

        <div class="col-md-4 col-md-offset-1" style="padding-top: 5px">
            <div class="card card-user">
              <div class="image">
                <!-- <img src="../assets/img/damir-bosnjak.jpg" alt="..."> -->
                <!-- <img height="42" width="42" src="'$student->student_photo'" alt="something"> -->
              </div>
              <div class="card-body">
                <div class="author">
                  
                    <!-- <img class="avatar border-gray" src="'$student->student_photo'" alt="hi"> -->
                    <img class="avatar border-gray" src="{{asset($student->student_photo)}}" alt="profile Pic" >
                    
                    <h5 class="title">{{$student->name}}</h5>
                    <p class="description">{{$student->roll_no}}</p>                 
                </div>
                
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">

                  <div class="row" style="padding-left: 3em">
                    <div class="col-lg-4 col-md-6 col-6 ml-auto">

                      <h5>{{isset($level->class_name) ? $level->class_name : null}}
                        <br>
                        <small>Class</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>{{isset($section->section_name) ? $section->section_name : null}}
                        <br>
                        <small>Section</small>
                      </h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5>{{$student->gender}}
                        <br>
                        <small>Gender</small>
                      </h5>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            
        </div>

      <div class="col-md-6" style="padding-top: 5px">
        <div class="card card-user" style="padding-top: 5px; padding-left: 20px; padding-right: 10px">
          <div class="card-header">
            <h5 class="card-title">Profile Details</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    {!! Form::label('contact_no','Contact no.') !!}
                    {!! Form::label('contact_no', isset($student->contact_no) ? $student->contact_no : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    {!! Form::label('nationality','Nationality:') !!}
                    {!! Form::label('nationality', isset($student->nationality) ? $student->nationality : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    {!! Form::label('religion','Religion:') !!}
                    {!! Form::label('religion', isset($student->religion) ? $student->religion : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('fathers_name','Fathers Name:') !!}
                    {!! Form::label('fathers_name', isset($student->fathers_name) ? $student->fathers_name : null, ['class'=> 'form-control']) !!}
                    
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    {!! Form::label('mothers_name','Mothers Name:') !!}
                    {!! Form::label('mothers_name', isset($student->mothers_name) ? $student->mothers_name : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('fathers_cell','Fathers Contact no.:') !!}
                    {!! Form::label('fathers_cell', isset($student->fathers_cell) ? $student->fathers_cell : null, ['class'=> 'form-control']) !!}
                    
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    {!! Form::label('mothers_cell','Mothers Contact no.') !!}
                    {!! Form::label('mothers_cell', isset($student->mothers_cell) ? $student->mothers_cell : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('present_address','Present Address:') !!}
                    {!! Form::label('present_address', isset($student->present_address) ? $student->present_address : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('permanent_address','Permanent Address:') !!}
                    {!! Form::label('permanent_address', isset($student->permanent_address) ? $student->permanent_address : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('date_of_birth','Date of Birth:') !!}
                    {!! Form::label('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth : null, ['class'=> 'form-control']) !!}
                    
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    {!! Form::label('admission_date','Date of Admission:') !!}
                    {!! Form::label('admission_date', isset($student->admission_date) ? $student->admission_date : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
