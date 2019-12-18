<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('categories','Choose Category:') !!}
            <?php
            $listCategories = [];
            foreach ($categories as $keyL => $valL){
                $listCategories[$valL->id] = $valL->category_name;
            }
            ?>
            {!! Form::select('category_id', $listCategories, isset($voucher->category_id) ? $voucher->category_id :null, ['class'=> 'form-control', 'id'=>'category_id']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('suppliers','Choose Supplier:') !!}
            {!! Form::select('supplier_id', [], isset($voucher->supplier_id) ? $voucher->supplier_id :null, ['class'=> 'form-control', 'id'=>'supplier_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('account_name','Account Name:') !!}
            {!! Form::text('account_name', isset($voucher->account_name) ? $voucher->account_name :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('amount','Enter Amount:') !!}
            {!! Form::number('amount', isset($voucher->amount) ? $voucher->amount :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    
    
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('description','Description:') !!}
            {!! Form::textarea('description', isset($voucher->description) ? $voucher->description :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    
</div>

{!! Form::hidden('created_by', request()->user()->id, ['class'=> 'form-control']) !!}
{!! Form::hidden('action_date', Carbon\Carbon::now()->toDateString(), ['class'=> 'form-control']) !!}

<script type="text/javascript">
    var categoryList = <?php echo json_encode($categories); ?>;
    var supplierList = <?php echo json_encode($suppliers); ?>;

    $(document).ready(function(){

        $('#category_id').change(function(){
            updateSupplier();
        });

        updateSupplier();
    });

    function updateSupplier() {
        //console.log(categoryList);
        
        $.each(categoryList, function(ind, val){
            //console.log($('#category_id').val());
            if(val.id == $('#category_id').val()) {
                $('#supplier_id').empty();

                $.each(val.supplier, function(indx, valx) {
                    //console.log(valx);
                    $('#supplier_id').append('<option value="'+valx.id+'">'+valx.supplier_name+'</option>');
                    
                });
            }
        });
    }
</script>
