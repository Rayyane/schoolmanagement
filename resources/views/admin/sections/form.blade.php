<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('section_name','Section Name') !!}
            {!! Form::text('section_name', isset($section->section_name) ? $section->section_name : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('teacher_id','Class teacher:') !!}
            {!! Form::select('teacher_id', $teachers, isset($section->teacher_id) ? $section->teacher_id : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>




<div class="row">
   <div class="col-md-12">
        {!! Form::label('levels','Choose Class:') !!}
        <select class="form-control" name="level_enroll_id">
            <?php
            foreach ($levels as $key => $value) {                        
                ?>
                <optgroup label="{{$value->name}}">                        
                    <?php
                    foreach ($value->level_enroll as $keyL => $valueL) {                            
                        ?>                                             
                        <option value="{{$valueL->id}}">{{$valueL->level->class_name}}</option>                        
                        <?php
                    }
                    ?>
                </optgroup>
                <?php
            }
            ?>
        </select>
    </div>
</div> 
<br>


