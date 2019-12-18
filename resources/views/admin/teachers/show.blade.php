@section('heading')

    Teacher Profile

@endsection


@extends('layouts.app')

@section('content')
<div class="content">
    <?php
    $sections = \App\Section::where('teacher_id', $teacher->id)->get();
    $section_subject_teachers = \App\SectionSubjectTeacher::where('teacher_id', $teacher->id)->get();
    
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
                    <img class="avatar border-gray" src="{{asset($teacher->teacher_photo)}}" alt="profile Pic" >
                    
                    <h5 class="title">{{$teacher->teacher_name}}</h5>
                    <p class="description">{{$teacher->nationality}}</p>                 
                </div>
                
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">

                  <div class="row" style="padding-left: 2.5em">
                    <div class="col-lg-4 col-md-6 col-6 ml-auto">
                      <h5>{{$teacher->religion}}
                        <br>
                        <small>Religion</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>{{$teacher->marital_status}}
                        <br>
                        <small>Marital Status</small>
                      </h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5>{{$teacher->salary}}
                        <br>
                        <small>Salary</small>
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
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('contact_no','Contact no.') !!}
                    {!! Form::label('contact_no', isset($teacher->contact_no) ? $teacher->contact_no : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
                <div class="col-md-6 px-1">
                  <div class="form-group">
                    {!! Form::label('date_of_birth','Date of Birth:') !!}
                    {!! Form::label('date_of_birth', isset($teacher->date_of_birth) ? $teacher->date_of_birth : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p4-1">
                  <div class="form-group">
                    {!! Form::label('spouse_name','Spouse Name') !!}
                    {!! Form::label('spouse_name', isset($teacher->spouse_name) ? $teacher->spouse_name : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
            </div>
                

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('fathers_name','Fathers Name:') !!}
                    {!! Form::label('fathers_name', isset($teacher->fathers_name) ? $teacher->fathers_name : null, ['class'=> 'form-control']) !!}
                    
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    {!! Form::label('mothers_name','Mothers Name:') !!}
                    {!! Form::label('mothers_name', isset($teacher->mothers_name) ? $teacher->mothers_name : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('present_address','Present Address:') !!}
                    {!! Form::label('present_address', isset($teacher->present_address) ? $teacher->present_address : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('permanent_address','Permanent Address:') !!}
                    {!! Form::label('permanent_address', isset($teacher->permanent_address) ? $teacher->permanent_address : null, ['class'=> 'form-control']) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('class_teacher','Class Teacher of Section:') !!}
                    @foreach($sections as $section)
                    <?php
                    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                    ?>
                    {!! Form::label('class_teacher', isset($section->section_name) ? $section->section_name : null, ['class'=> 'form-control']) !!} 
                    @endforeach
                    
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group">
                        {!! Form::label('','(Class:)') !!}
                        @foreach($sections as $section)
                        <?php
                        $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                        $level = \App\Level::find($level_enroll->level_id);
                        ?>
                            
                            {!! Form::label('class_name', isset($level->class_name) ? $level->class_name : null, ['class'=> 'form-control']) !!}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    {!! Form::label('subject_teacher','Subject Teacher of:') !!}
                    @foreach($section_subject_teachers as $section_subject_teacher)

                    <?php
                    $subject = \App\Subject::find($section_subject_teacher->subject_id);
                    ?>
                    
                    {!! Form::label('subject_teacher', isset($subject->subject_name) ? $subject->subject_name : null, ['class'=> 'form-control']) !!}

                    @endforeach
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    {!! Form::label('section','of Section:') !!}
                    @foreach($section_subject_teachers as $section_subject_teacher)

                    <?php
                    $section = \App\Section::find($section_subject_teacher->section_id);
                    ?>
                    
                    {!! Form::label('section_name', isset($section->section_name) ? $section->section_name : null, ['class'=> 'form-control']) !!}

                    @endforeach
                  </div>
                </div>
                <div class="col-md-3 pr-1">
                  <div class="form-group">
                    {!! Form::label('class','of Class:') !!}
                    @foreach($section_subject_teachers as $section_subject_teacher)

                    <?php
                    $section = \App\Section::find($section_subject_teacher->section_id);
                    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                    $level = \App\Level::find($level_enroll->level_id);
                    ?>
                    
                    {!! Form::label('class_name', isset($level->class_name) ? $level->class_name : null, ['class'=> 'form-control']) !!}

                    @endforeach
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
