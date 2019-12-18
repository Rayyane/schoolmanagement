@section('heading')
    Section Wise Fees
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
                        <h4 class="title">Section Wise Fees</h4>
                        <p class="category">Section-wise fees details</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="sectionWiseFeesDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sectionWiseFeesDataTable = null;
        window.addEventListener("load", function () {
            sectionWiseFeesDataTable = $('#sectionWiseFeesDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addSectionFee',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/section_wise_fees/create');
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
                            var pageInfo = sectionWiseFeesDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

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
                        'title': 'Class',
                        'name': 'section.level_enroll.level.class_name',
                        'data': 'section.level_enroll.level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Section',
                        'name': 'section.section_name',
                        'data': 'section.section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Month',
                        'name': 'business_month.month_name',
                        'data': 'business_month.month_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Fees Type',
                        'name': 'fees_type.fees_type_name',
                        'data': 'fees_type.fees_type_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Amount',
                        'name': 'amount',
                        'data': 'amount',
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
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';

                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/section_wise_fee/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
