@section('heading')
    Students
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif
                    <div class="panel-body">
                        <div class="header">
                            <h4 class="title">All Students</h4>
                            <p class="category">All students of all classes</p>
                            <br>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="studentDataTable" class="table table-striped">
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var studentDataTable = null;
        window.addEventListener("load", function () {
            studentDataTable = $('#studentDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addBranch',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/students/create');
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
                            var pageInfo = studentDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;
                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'name',
                        'data': 'name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Roll.',
                        'name': 'roll_no',
                        'data': 'roll_no',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Father',
                        'name': 'fathers_name',
                        'data': 'fathers_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Gender',
                        'name': 'gender',
                        'data': 'gender',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Contact No.',
                        'name': 'contact_no',
                        'data': 'contact_no',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Image',
                        'name': 'student_photo',
                        'data': 'student_photo',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<img height="42" width="42" src="'+data+'" alt="something">';
                        }
                    },
                    /*{
                        'title': 'Class',
                        'name': 'level_id',
                        'data': 'level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },*/
                    /*{
                        'title': 'Section',
                        'name': 'section_id',
                        'data': 'section.section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },*/
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/students/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/students/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/students/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/student/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
