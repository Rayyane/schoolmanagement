@section('heading')
Teachers
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $teacherIdxURL = \Request::fullUrl();
        Session::put('teacherIdxURL', $teacherIdxURL);
        //dd(Session::get('teacherIdxURL'));
        ?>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif
                    <div class="header">
                        <h4 class="title">All Teachers</h4>
                        <p class="category">All teachers of all branches</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="teacherDataTable" class="table table-striped">
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var teacherDataTable = null;
        window.addEventListener("load",function () {
            teacherDataTable = $('#teacherDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addTeacher',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config)
                        {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/teachers/create');
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
                            var pageInfo = teacherDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'teacher_name',
                        'data': 'teacher_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Image',
                        'name': 'teacher_photo',
                        'data': 'teacher_photo',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<img height="42" width="42" src="'+data+'" alt="something">';
                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/teachers/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/teachers/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/teachers/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url:"/teacher/get-data-json",
                    url: jsUtlt.siteUrl("/teacher/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
