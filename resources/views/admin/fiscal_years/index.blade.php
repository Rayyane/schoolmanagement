@section('heading')
    Fiscal Years
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
                        <h4 class="title">Fiscal Years</h4>
                        <p class="category">Business year timespan</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="fiscalYearDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var fiscalYearDataTable = null;
        window.addEventListener("load", function () {
            fiscalYearDataTable = $('#fiscalYearDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addFiscalYear',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/fiscal_years/create');
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
                            var pageInfo = fiscalYearDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Year',
                        'name': 'year',
                        'data': 'year',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Start date:',
                        'name': 'starts_from',
                        'data': 'starts_from',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'End date:',
                        'name': 'ends_on',
                        'data': 'ends_on',
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
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/fiscal_years/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/fiscal_years/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/fiscal_years/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/fiscal_year/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
