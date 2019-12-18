<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('teachers','Choose User to Assign:') !!}
            {!! Form::select('teacher_id', $teachers, isset($fees_book->teacher_id) ? $fees_book->teacher_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('branches','Choose Branch:') !!}
            {!! Form::select('branch_id', $branches, isset($fees_book->branch_id) ? $fees_book->branch_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('total_leaf','Total Leaf Number:') !!}
            {!! Form::number('total_leaf', isset($fees_book->total_leaf) ? $fees_book->total_leaf :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('prefixes','Prefix:') !!}
            {!! Form::select('prefix_id', $prefixes, isset($fees_book->prefix_id) ? $fees_book->prefix_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('leaf_start_number','Leaf Start Number:') !!}
            {!! Form::number('leaf_start_number', isset($fees_book->leaf_start_number) ? $fees_book->leaf_start_number :null, ['min'=>'0', 'class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('creator_user_id', request()->user()->id, ['class'=> 'form-control']) !!}