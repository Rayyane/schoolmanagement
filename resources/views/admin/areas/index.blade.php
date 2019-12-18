@section('heading')
    Areas
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

                    <div class="header">
                        <h4 class="title">All Areas</h4>
                        <p class="category">All areas where branches exist</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="areaDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var areaDataTable = null;
        window.addEventListener("load", function () {
            areaDataTable = $('#areaDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addArea',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl("/areas/create");
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
                            var pageInfo = areaDataTable.page.info();
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
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {

                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/areas/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/areas/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/areas/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';areas                  }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {

                    url: jsUtlt.siteUrl("/area/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
<!-- jsUtlt.siteUrl('ajax/view_members_datatable') -->