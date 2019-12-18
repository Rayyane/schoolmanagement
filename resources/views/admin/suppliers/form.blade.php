<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('supplier_name','Supplier Name:') !!}
            {!! Form::text('supplier_name', isset($supplier->supplier_name) ? $supplier->supplier_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('categories','Choose Category:') !!}
            {!! Form::select('category_id', $categories, isset($supplier->category_id) ? $supplier->category_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('created_by', request()->user()->id, ['class'=> 'form-control']) !!}
