<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('session','Choose session:') !!}
            <?php
                $listSessions = [];
                foreach ($sessions as $keyL => $valL){
                    $listSessions[$valL->id] = $valL->name;
                }
            ?>
            {!! Form::select('session_id', $listSessions, isset($student->session_id) ? $student->session_id : null, ['class'=> 'form-control', 'id' => 'session_id']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('level','Choose Class:') !!}                 
            {!! Form::select('level_id', [], isset($student->level_id) ? $student->level_id : null, ['class'=> 'form-control', 'id' => 'level_id']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sections','Choose section:') !!}
            {!! Form::select('section_id', [], isset($student->section_id) ? $student->section_id : null, ['class'=> 'form-control', 'id' => 'section_id']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('business_months','Choose Month:') !!}
            {!! Form::select('business_month_id', $business_months, isset($section_wise_fees->business_month_id) ? $section_wise_fees->business_month_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fees_types','Choose Fees Type:') !!}
            {!! Form::select('fees_type_id', $fees_types, isset($section_wise_fees->fees_type_id) ? $section_wise_fees->fees_type_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('amount','Enter Amount:') !!}
            {!! Form::number('amount', isset($section_wise_fees->amount) ? $section_wise_fees->amount :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    
</div>


{!! Form::hidden('user_id', request()->user()->id, ['class'=> 'form-control']) !!}
<script type="text/javascript">
    var sessionList = <?php echo json_encode($sessions);?>;
    var levelList = <?php echo json_encode($levels);?>;
    $(document).ready(function(){
        $('#session_id').change(function (){
            updateLevel();
            updateSection();
        });


        $('#level_id').change(function (){
            updateSection();
        });

        updateLevel();
        updateSection();
    });

    function updateLevel() {
        //console.log(sessionList);
        $.each(sessionList, function(ind, val){
            //console.log(val.level_enroll);
        // debugger;
        if(val.id == $('#session_id').val()){
            $('#level_id').empty();
            $.each(val.level_enroll, function(indS, valS) {
                //console.log(valS);
                $('#level_id').append('<option value="'+valS.id+'">'+valS.level.class_name+'</option>');
                if(indS == 0){
                    $('#section_id').empty();
                    $.each(valS.section, function(indSec, valSec) {
                        $('#section_id').append('<option value="'+valSec.id+'">'+valSec.section_name+'</option>');
                    });
                }
            });
        }
    });   
    }

    function updateSection() {
        
        /*var currentLevels = levelList.filter(x=>x.id==$('#level_id').valx());
        console.log(currentLevels);*/
        $.each(levelList, function(index, value){
            //console.log(value);
           if(value.id == $('#level_id').val()) {
           $('#section_id').empty();
           $.each(value.level_enroll, function(indxs, valxs){
            //console.log(valxs);
            $.each(valxs.section, function(indxss, valxss) {
                //console.log(valxss.id);
                $('#section_id').append('<option value="'+valxss.id+'">'+valxss.section_name+'</option>');
                
            });
            //var level_enroll = <?php ?> ;
           
        });
       }
   });
    }


</script>