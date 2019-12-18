@section('heading')
    Student's Payment History
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
                        <h4 class="title">Payment History</h4>
                        <p class="category">Student Individual Payment History</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="paymentHistoryDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var paymentHistoryDataTable = null;
        window.addEventListener("load", function () {
            paymentHistoryDataTable = $('#paymentHistoryDataTable').DataTable({
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '20px',
                        'render': function (data, type, row, ind) {
                            var pageInfo = paymentHistoryDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Student',
                        'name': 'section_student.student.name',
                        'data': 'section_student.student.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Roll no.',
                        'name': 'section_student.student.roll_no',
                        'data': 'section_student.student.roll_no',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Section',
                        'name': 'section_student.section.section_name',
                        'data': 'section_student.section.section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Class',
                        'name': 'section_student.section.level_enroll.level.class_name',
                        'data': 'section_student.section.level_enroll.level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Collected Amount',
                        'name': 'total_collected',
                        'data': 'total_collected',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    
                    {
                        'title': 'Collection Date',
                        'name': 'collection_date',
                        'data': 'collection_date',
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
                            return return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/financial_reports/' + data)+'">View</a></span>';
                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/payment_history/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
