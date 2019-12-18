@section('heading')
    Term Result Generation
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Generate Term Result here</h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">

                                <br class="content table-responsive table-full-width">
                                    {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/view_term_result/']) !!}
                                    {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                                    <table class="table table-striped">

                                        <thead>
                                        <th>Subject Name</th>
                                        <th>Weekly Tests (With marks)</th>
                                        <th>Term marks</th>
                                        </thead>

                                        <?php
                                        $key = 0;
                                        ?>
                                        @foreach($section_subject_teacher_ids as $section_subject_teacher_id)
                                            <tbody>

                                            <?php
                                            $section_subject_teacher =
                                                \App\SectionSubjectTeacher::find($section_subject_teacher_id);

                                            $subject =
                                                \App\Subject::find($section_subject_teacher->subject_id);

                                            $student_subject_results =
                                                \App\StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
                                                    ->where('student_id', $student->id)
                                                    ->where('term_id', $term_id)
                                                    ->get();

                                            ?>

                                            <tr>

                                                <td>
                                                    {!! Form::label('Subject name', $subject->subject_name, ['class'=> 'form-control']) !!}

                                                </td>


                                                <td width="55%">
                                                    @foreach($student_subject_results as $student_subject_result)
                                                        {{"Weekly test no.: "}}
                                                        {{$student_subject_result->weekly_test_number}}
                                                        ({{$student_subject_result->weekly_test_marks}}) 

                                                        {!! Form::checkbox('student_subject_result_id['.$section_subject_teacher_id.'][]',
                                                        $student_subject_result->id.'_'.$student_subject_result->weekly_test_marks,
                                                        true) !!}

                                                    @endforeach
                                                </td>

                                                <td width="20%">
                                                    {!! Form::number('term_marks['.$section_subject_teacher_id.']', null, ['max'=>'100', 'min'=>'0', 'step'=>'0.5','required'=>'true','class'=> 'form-control']) !!}
                                                    {!! Form::hidden('section_subject_teacher_idRes[]', $section_subject_teacher_id, ['class'=> '']) !!}

                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                            $key++;
                                            ?>
                                        @endforeach

                                    </table>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <div class="form-group" style="text-align: center">
                                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection