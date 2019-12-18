@section('heading')
    Weekly Result
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Weekly result of selected student</h4>

                        <div class="panel-body">
                            <div class="row" style="align-content: center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4>Student name:</h4><br>
                                        {{$student->name}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4>Student roll no.:</h4><br>
                                        {{$student->roll_no}}
                                    </div>
                                </div>
                            </div>
                            <div style="padding-top: 25px;">
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">

                                        <th> Test #</th>
                                        <th>Subject</th>
                                        <th> marks</th>


                                        @foreach($results as $result)
                                            <tr>
                                                <?php
                                                $subject = \App\Subject::find($result->subject_id)
                                                ?>
                                                <td> {{$result->test_number}} </td>
                                                <td> {{$subject->subject_name}} </td>
                                                <td> {{$result->subject_marks}} </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

