@section('heading')
    Branches
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
                            <h4 class="title">All Branches</h4>
                            <p class="category">All branches appear here</p>
                            <br>
                        </div>
                   
                        <div class="content table-responsive table-full-width">
                            <table id="branchDataTable" class="table table-striped">
                            </table>

                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var branchDataTable = null;
        window.addEventListener("load", function () {
            branchDataTable = $('#branchDataTable').DataTable({
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
                            window.location.href = jsUtlt.siteUrl('/branches/create');
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
                            var pageInfo = branchDataTable.page.info();
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
                        'title': 'Address',
                        'name': 'address',
                        'data': 'address',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Email',
                        'name': 'email',
                        'data': 'email',
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
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/branches/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/branches/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/branches/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/branch/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
<!-- jsUtlt.siteUrl('ajax/view_members_datatable') -->
