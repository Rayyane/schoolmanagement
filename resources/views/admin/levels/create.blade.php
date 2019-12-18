@section('heading')
Classes
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $url = Session::get('levelIndexURL');
        //dd(Session::all());
        ?>
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"  style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Classes Information Form</h4>
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
                        <div class="header">
                            <h4 class="title">Add Class</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/levels']) !!}

                        @include('admin.levels.form')

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! link_to($url, 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                    <br>
                    <div class="panel-body">
                        <div class="header">
                            <h4 class="title">Enroll Class</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/level_enrolls_assign']) !!}

                        @include('admin.levels.level_enroll_form')

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::open(['method' => 'GET', 'url' => '/levelEnrolls']) !!}
                                {!! Form::submit('View Enrolled', array('class'=> 'btn btn-primary btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
