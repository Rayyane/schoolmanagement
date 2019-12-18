@section('heading')
Collected Fees
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! $message !!}
                </div>
                </div>
            @endif
        </div>
        <div class="col-md-6 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Fees Collection Information Form</h4>
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
                        {!! Form::open(['method' => 'get', 'url' => '/collected_fee/calculate', 'class'=> 'validateForm']) !!}

                        @include('admin.collected_fees.form')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-left">
                                        {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-right">
                                        {!! Form::submit('Next', array('class'=> 'form-submit btn btn-info')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(".validateForm").validate({
            submitHandler: function(form) {
                $('.form-submit').attr('disabled','disabled');
                form.submit();
            }
        });
    });
</script>
@endpush


