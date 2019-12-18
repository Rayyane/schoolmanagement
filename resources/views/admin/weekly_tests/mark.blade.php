@section('heading')
    Weekly Test
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $url = Session::get('chooseNumURL');

        //dd(Session::all());
        ?>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif

                    <div class="header">
                        <h4 class="title">Results</h4>
                        <p class="category">Adding marks for test: {{ ($weekly_test_number) }}</p>
                        <br>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <div class="content table-responsive table-full-width">
                                {!! Form::open(['method' => 'GET', 'url' => '/weeklytest/storeMarks']) !!}
                                {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}

                                    <table class="table table-striped">

                                        <thead>
                                        <th>Student Name</th>
                                        <th> Marks </th>
                                        
                                        </thead>


                                        @foreach($section_students as $section_student)
                                            <tbody>

                                                <?php
                                                $student = \App\Student::find($section_student->student_id);
                                                //dd($subject);
                                                ?>
                                                
                                            <tr>
                                                
                                                <td>
                                                    
                                                    {!! Form::label('student_name[]', $student->name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('student_id[]', $student->id, ['class'=> '']) !!}
                                                    {!! Form::hidden('weekly_test_number[]', $weekly_test_number, ['class'=> '']) !!}
                                                    {!! Form::hidden('section_subject_teacher_id[]', $sec_sub_teach->id, ['class'=> '']) !!} 
                                                    
                                                </td>

                                                <td>
                                                    {!! Form::number('marks[]', null, ['max'=>'25', 
                                                    'min'=>'0','step'=>'0.5','required'=>'true', 'class'=> 'form-control']) !!}
                                                </td>
                                                

                                                
                                                
                                            </tr>
                                            </tbody>
                                        @endforeach

                                    </table>

                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            {!! link_to($url, 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                        </div>


                    </div>
                    <br>
                    

                </div>
            </div>
        </div>
    </div>
@endsection
