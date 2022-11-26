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
                        <h4 class="title" align="center">Subject List For Selected Class</h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                <div class="content table-responsive table-full-width">
                                    <table id="resultByNumberDataTable" class="table table-striped">
                                        <thead>
                                        <th> Weekly Test no.</th>
                                        <th> Student Name</th>
                                        <th> Subject</th>

                                        <th> Obtained marks</th>
                                        </thead>
                                        @foreach($results as $result)
                                            <?php
                                            $student = \App\Models\Student::find($result->student_id);
                                            $subject = \App\Models\Subject::find($result->subject_id);
                                            ?>
                                            <tr>
                                                <td> {{$result->test_number}} </td>
                                                <td> {{$student->name}} </td>
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
    {{--<script type="text/javascript">
        var resultByNumberDataTable = null;
        window.addEventListener("load", function () {
            resultByNumberDataTable = $('#resultByNumberDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addResult',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = '/results';
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '20px',
                        'render': function (data, type, row, ind) {
                            var pageInfo = resultByNumberDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;
                        }
                    },
                    {
                        'title': 'Student Name',
                        'name': 'result.name',
                        'data': 'student.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Subject',
                        'name': 'subject_id',
                        'data': 'subject.subject_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Test #',
                        'name': 'test_number',
                        'data': 'test_number',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Marks',
                        'name': 'subject_marks',
                        'data': 'subject_marks',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    }


                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/result/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>--}}
@endsection

