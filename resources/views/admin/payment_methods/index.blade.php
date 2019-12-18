@section('heading')
    Payment Methods
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
                        <h4 class="title">Payment Methods</h4>
                        <p class="category">List of payment methods</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="paymentMethodsDataTable" class="table table-striped">
                        </table>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var paymentMethodsDataTable = null;
        window.addEventListener("load", function () {
            paymentMethodsDataTable = $('#paymentMethodsDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addPaymentMethod',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/payment_methods/create');
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
                            var pageInfo = paymentMethodsDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Method',
                        'name': 'method_name',
                        'data': 'method_name',
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
                            return '<span class="btn btn-sm btn-info" data-id = ' + data + '> <a href="'+jsUtlt.siteUrl('/payment_methods/' + data)+'">View</a></span>' +
                                    '<span class="btn btn-sm btn-primary" data-id = ' + data + '><a href="'+jsUtlt.siteUrl('/payment_methods/' + data)+'/edit">Edit</a></span>' +
                                    '<span><form action="'+jsUtlt.siteUrl('/payment_methods/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/payment_method/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
