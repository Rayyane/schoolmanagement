<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('category_name','Category:') !!}
            {!! Form::text('category_name', isset($category->category_name) ? $category->category_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('created_by', request()->user()->id, ['class'=> 'form-control']) !!}
