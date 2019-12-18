@section('heading')
Classes
@endsection

@extends('layouts.app')

@section('content')
    <div class="container" >
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default" >

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
                            <h4 class="title">Edit Class</h4>
                        </div>
                        {!! Form::open(['method' => 'PUT', 'url' => ['/levels/'.$level->id]]) !!}

                        @include('admin.levels.form')

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
