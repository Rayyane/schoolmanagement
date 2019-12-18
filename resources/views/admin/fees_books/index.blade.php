@section('heading')
    Fees Books
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
                        <h4 class="title">Fees Books</h4>
                        <p class="category">Fees Books Details</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="feesBooksDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var feesBooksDataTable = null;
        window.addEventListener("load", function () {
            feesBooksDataTable = $('#feesBooksDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addFeesBook',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/fees_books/create');
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
                            var pageInfo = feesBooksDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

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
                        'title': 'Assigned User:',
                        'name': 'teacher.teacher_name',
                        'data': 'teacher.teacher_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Total leaf:',
                        'name': 'total_leaf',
                        'data': 'total_leaf',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Prefix:',
                        'name': 'prefix.prefix',
                        'data': 'prefix.prefix',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Leaf Start no.:',
                        'name': 'leaf_start_number',
                        'data': 'leaf_start_number',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Leaf End no.:',
                        'name': 'leaf_end_number',
                        'data': 'leaf_end_number',
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
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/fees_books/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/fees_books/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/fees_books/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/fees_book/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
