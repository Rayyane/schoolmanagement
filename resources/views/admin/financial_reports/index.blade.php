@section('heading')
    Financial Report
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Generate Report at Given Time</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div style="background-color: #e6ffe6; padding: 10px;">
                                <h4>Date range wise financial report</h4>
                                {!! Form::open(['method' => 'POST', 'url' => 'financial_report/date_wise_report']) !!}

                                @include('admin.financial_reports.form')

                                <div class="form-group">
                                    <div class="text-center">
                                        {!! Form::submit('Generate', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                            <br>

                            <div style="background-color: #e6ffff; padding: 10px;">
                                <h4>Month wise financial report</h4>
                                {!! Form::open(['method' => 'POST', 'url' => 'financial_report/month_wise_report']) !!}

                                @include('admin.financial_reports.form1')

                                <div class="form-group">
                                    <div class="text-center">
                                        {!! Form::submit('Generate', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                            <br>
                            <div style="background-color: #f2ffe6; padding: 10px;">
                                <h4>Year wise financial report</h4>
                                {!! Form::open(['method' => 'POST', 'url' => 'financial_report/year_wise_report']) !!}

                                @include('admin.financial_reports.form2')

                                <div class="form-group">
                                    <div class="text-center">
                                        {!! Form::submit('Generate', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                            <br>
                            <div style="background-color: #ffffcc; padding: 10px;">
                                <h4>Student individual financial report</h4>
                                {!! Form::open(['method' => 'POST', 'url' => 'financial_report/student_wise_report']) !!}

                                @include('admin.financial_reports.form3')

                                <div class="form-group">
                                    <div class="text-center">
                                        {!! Form::submit('Generate', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
