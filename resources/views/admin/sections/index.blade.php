@section('heading')
    Sections
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $sectionIndexURL = \Request::fullUrl();
        Session::put('sectionIndexURL', $sectionIndexURL);
        //dd(Session::get('sectionIndexURL'));
        ?>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif
                    <div class="header">
                        <h4 class="title">All Sections</h4>
                        <p class="category">All sections belonging to every class</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="sectionDataTable" class="table table-striped">
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sectionDataTable = null;
        window.addEventListener("load", function () {
            sectionDataTable = $('#sectionDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addSection',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/sections/create');
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
                            var pageInfo = sectionDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'section_name',
                        'data': 'section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },

                    {
                        'title': 'Class',
                        'name': 'level_id',
                        'data': 'level_enroll.level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Session',
                        'name': 'session_id',
                        'data': 'level_enroll.session.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Class Teacher',
                        'name': 'teacher_id',
                        'data': 'teacher.teacher_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="{{ url('/sections/') }}' + '/' + data + '">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="/sections/' + data + '/edit">Edit</a></span>' +
                                    '<span><form action="/sections/' + data + '" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>'+
                                    '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="{{ url('/section/assign_student') }}' + '/' + data + '">Student+</a></span>'+
                                    '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="{{ url('/section/assign_subject') }}' + '/' + data + '">Subject+</a></span>';
                                    


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/section/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
