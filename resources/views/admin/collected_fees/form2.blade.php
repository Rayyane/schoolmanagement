{{--
    **Fees collection form
    **Version 0.1~2019
    **Author:Md. Abdullah
    **Systech Digital Limited
    --}}

    @php
        $old_ids = isset($old_fees->section_wise_fees_ids)? $old_fees->section_wise_fees_ids : '';
        $section_wise_fees_id = explode(',',$old_ids);
    @endphp
    @section('heading')
        Collected Fees
    @endsection

    @extends('layouts.app')

    @section('content')
    <div class="container">
        <br>
        <div class="row">
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
                        <div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <table class="table-responsive table-bordered" width="100%">
                                        <tr>
                                            <td class="well-sm" ><b>Session:</b> {{$session}}</td>
                                            <td class="well-sm" ><b>Month:</b> {{$business_month}}</td>
                                            <td class="well-sm" ><b>Due: </b>{{isset($old_fees->total_due)?$old_fees->total_due:0}}</td>
                                            <td class="well-sm" ><b>Advanced:</b> {{isset($old_fees->total_advanced)?$old_fees->total_advanced:0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="well-sm" ><b>Name:</b> {{$section_student->student->name}}</td>
                                            <td class="well-sm" ><b>Class:</b> {{$section_student->section->level_enroll->level->class_name}}</td>
                                            <td class="well-sm" ><b>Section:</b> {{$section_student->section->section_name}}</td>
                                            <td class="well-sm" ><b>Prev. total:</b> {{isset($old_fees->total_collected)?$old_fees->total_collected:0}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            {!! Form::open(['method' => 'POST', 'route' => ['collected_fees.store'], 'class' => 'validateForm']) !!}
                            
                            @if($section_wise_fees->first())
                                <div class="row" style="margin-bottom:10px; margin-top:10px;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('fees_type','Choose Fees Options:') !!}
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td><input type="checkbox" class="fees_type" value = "" id="discount_check" name="discount_checkbox"></td>
                                                    <td>Discount Amount</td>
                                                    <td><input type="number" id="discount_amount" name="discount_amount" value="{{ isset($collected_fees->discount) ? $collected_fees->discount :null}}"></td>
                                                </tr>
                                                @foreach($section_wise_fees as $row)
                                                    @if(!(in_array($row->id, $section_wise_fees_id) && $old_fees->business_month_id == $business_month_id))   
                                                        <tr>
                                                            <td width="20px"><input type="checkbox" value = "{{$row->id.'-'.$row->amount}}" class="fees_type" name="fees_type[]"></td>
                                                            <td>{{ $row->fees_type->fees_type_name }}</td>
                                                            <td>{{ ($row->amount)?$row->amount:0 }} BDT.</td>
                                                        </tr>
                                                        @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('fees_book_leaf_prefix','Choose Leaf Prefix:') !!}
                                            {!! Form::select('fees_book_leaf_prefix', $leaf_prefix,[], ['required', 'class'=> 'form-control','id' => 'leaf_prefix']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('fees_book_leaf_number','Enter Leaf Number:') !!}
                                            {!! Form::number('fees_book_leaf_number', isset($collected_fees->fees_book_leaf_number) ? $collected_fees->fees_book_leaf_number :null, ['required', 'class'=> 'form-control','id' => 'leaf_number']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('payment_methods','Choose Payment Method:') !!}
                                            {!! Form::select('payment_method_id', $payment_methods, isset($collected_fees->payment_method_id) ? $collected_fees->payment_method_id :null, ['required', 'class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('total_payable','Total Payable Amount:') !!}
                                            {!! Form::number('total_payable', isset($collected_fees->total_payable) ? $collected_fees->total_payable :0, ['readonly' ,'class'=> 'form-control', 'id' => 'total_payable']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('total_paid','Total Paid Amount:', ['class'=> 'col-sm-4 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::number('total_paid',0 , ['class'=> 'form-control', 'id' => 'total_paid']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('total_collected','Total Collected Amount:', ['class'=> 'col-sm-4 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::number('total_collected', isset($collected_fees->total_collected) ? $collected_fees->total_collected :null, ['required', 'class'=> 'form-control', 'id' => 'total_collected']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('return','Total Return Amount:', ['class'=> 'col-sm-4 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::number('return', 0, ['readonly','class'=> 'form-control', 'id' => 'total_return']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('total_due','Amount Due:', ['class'=> 'col-sm-4 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::number('total_due', isset($collected_fees->total_due) ? $collected_fees->total_due :null, ['readonly','class'=> 'form-control','id' => 'total_due' ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {!! Form::label('total_advanced','Advanced Amount:', ['class'=> 'col-sm-4 col-form-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::number('total_advanced', isset($collected_fees->total_advanced) ? $collected_fees->total_advanced :null, ['readonly','class'=> 'form-control','id' => 'total_advanced']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="col-md-12 well-lg">
                                    This section doesn't have any fees. Please! add fees to this section. 
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-left">
                                        {!! link_to(URL::previous(), 'Back', ['class' => 'btn btn-default']) !!}
                                    </div>
                                </div>
                            </div>
                            @if($section_wise_fees->first())
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-right">
                                        {!! Form::submit('Submit', array('class'=> 'form-submit btn btn-info')) !!}
                                    </div>
                                </div>
                            </div>
                            @endif

                            {!! Form::hidden('collector_id', Auth()->user()->id, ['class'=> 'form-control']) !!}
                            {!! Form::hidden('business_month_id', $business_month_id, ['class'=> 'form-control']) !!}
                            {!! Form::hidden('student_id', $student_id, ['class'=> 'form-control']) !!}
                            {!! Form::hidden('collection_date', Carbon\Carbon::now()->toDateString(), ['class'=> 'form-control']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

{{--
    **Calculation Fees by using jquery
    **Version 0.1~2019
    **Author:Md. Abdullah
    **Systech Digital Limited
--}}
<script>
    $(document).ready(function() {
        /*Jquery validator with remote validation leaf number*/
        $(".validateForm").validate({
            rules: {
                fees_book_leaf_number:{
                    remote: {
                        type: 'post',
                        url: '{{url('/fees_book/check')}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'fees_book_leaf_number': $('#fees_book_leaf_number').val(),
                            'leaf_prefix': $('#leaf_prefix').val()
                        }
                    },
                }
            },
            messages: {
               fees_book_leaf_number: {
                  remote: "The Leaf number of that prefix is not valid or already exist!!",
                }
            },
            submitHandler: function(form) {
                $('.form-submit').attr('disabled','disabled');
                form.submit();
            }
        });


        /*calculate total payable*/
        function calculate(){
            var old_due =  {{isset($old_fees->total_due)?$old_fees->total_due:0}},
            old_advanced = {{isset($old_fees->total_advanced)?$old_fees->total_advanced:0}},
            total_discount_amount = 0;
            $total = 0;
            $total += old_due-old_advanced;

            if($('#discount_check').is(":checked")){
                total_discount_amount = convert($('#discount_amount').val());
            }

            $total -= total_discount_amount;

            $('.fees_type:checkbox:checked').each(function(i){
                $total += convert($(this).val().split("-")[1]);
            });

            return $total;
        }

        /*Adjust due and advanced*/
        function adjust_due_advanced(){
            var $total = calculate();
                total_collected_amount = convert($('#total_collected').val()),
            
            $due = ((total_collected_amount-$total) <= 0) ? ($total-total_collected_amount) :0;
            $advanced = ((total_collected_amount-$total) >= 0) ? (total_collected_amount-$total) :0;
            $('#total_due').val($due);
            $('#total_advanced').val($advanced);
        }

        function return_calculation(){
            var $paid = convert($('#total_paid').val());
            var $total_collected_amount = convert($('#total_collected').val());

            var $return = $paid-$total_collected_amount;
            if($return > 0){
                $('#total_return').val($return);
            }
            else{
                $('#total_return').val(0);
            }
        }

        calculate();
        adjust_due_advanced();

        /*convert to int all value*/
        function convert($value){
            $val = parseInt($value);

            if(isNaN($val)){
                return 0;
            }
            else{
                return $val;
            }
        }

        /*collected amount field change*/
        $('#total_collected').on('keyup change', function(){
            adjust_due_advanced();
            return_calculation();
        })

        /*discount field checkbox is check*/
        $('.fees_type').click(function(){
            $total = calculate();
            $('#total_payable').val(0);
            if($total >= 0){
                $('#total_payable').val($total);
            }
            adjust_due_advanced();
        });

        /*discount filed amount change*/
        $('#discount_amount').on('keyup change', function(){
            $total = calculate();
            if($('#discount_check').is(":checked")){
                $('#total_payable').val(0);
                if($total >= 0){
                    $('#total_payable').val($total);
                }
                adjust_due_advanced();
            }
        })


        /*calulator setup for retuen amount*/
        $('#total_paid').on('keyup change', function(){
            return_calculation();
        });
    })

</script>
@endpush