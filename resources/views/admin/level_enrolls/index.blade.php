@section('heading')
    Class Enroll
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
                            <h4 class="title">All Classes</h4>
                            <p class="category">All Classes enrolled to specific sessions</p>
                            <br>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="levelEnrollDataTable" class="table table-striped">
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var levelEnrollDataTable = null;
        window.addEventListener("load", function () {
            levelEnrollDataTable = $('#levelEnrollDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Enroll+',
                        attr: {
                            'id': 'addClass',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/levels/create');
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
                            var pageInfo = levelEnrollDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Class',
                        'name': 'level.class_name',
                        'data': 'level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Session',
                        'name': 'session.name',
                        'data': 'session.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Branch',
                        'name': 'branch.name',
                        'data': 'branch.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },

                    {
                        'title': 'Shift',
                        'name': 'shift.shift_name',
                        'data': 'shift.shift_name',
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
                            return '<span><form action="'+jsUtlt.siteUrl('/levelEnrolls/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/level_enroll/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
