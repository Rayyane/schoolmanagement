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
                {!! Form::select('session_id', $listSessions, isset($student->session_id) ? $student->session_id : null, ['required', 'class'=> 'form-control', 'id' => 'session_id']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('level','Choose Class:') !!}                 
                {!! Form::select('level_id', [], isset($student->level_id) ? $student->level_id : null, ['required', 'class'=> 'form-control', 'id' => 'level_id']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('sections','Choose section:') !!}
                {!! Form::select('section_id', [], isset($student->section_id) ? $student->section_id : null, ['required', 'class'=> 'form-control', 'id' => 'section_id']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('students','Choose Student:') !!}
                {!! Form::select('student_id',[], isset($collected_fees->student_id) ? $collected_fees->student_id :null, ['required', 'class'=> 'form-control', 'id' => 'student_id']) !!}
            </div>
        </div>
    </div>

<script type="text/javascript">
    var sessionList = <?php echo json_encode($sessions);?>;
    var levelList = <?php echo json_encode($levels);?>;
    var studentList = <?php echo json_encode($students);?>;
    

    $(document).ready(function(){
        $('#session_id').change(function (e){
            e.preventDefault();
            updateLevel();
            updateSection();
            updateStudent();
        });

        $('#level_id').change(function (){
            updateSection();
            updateStudent();
        });

        $('#section_id').change(function (){
            updateStudent();
        });


        updateLevel();
        updateStudent();
    });

    function updateLevel() {
        $.each(sessionList, function(ind, val){
            if(val.id == $('#session_id').val()){
                $('#level_id').empty();
                $.each(val.level_enroll, function(indS, valS) {
                    $('#level_id').append('<option value="'+valS.level.id+'">'+valS.level.class_name+'</option>');
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
        $.each(levelList, function(index, value){
            if(value.id == $('#level_id').val()) {
                $('#section_id').empty();
                $.each(value.level_enroll, function(indxs, valxs){
                    $.each(valxs.section, function(indxss, valxss) {
                        $('#section_id').append('<option value="'+valxss.id+'">'+valxss.section_name+'</option>');
                    });
                });
            }
        });
    }

    function updateStudent() {
        $('#student_id').empty();
        $.each(studentList, function(index, value){
            if(value.section_id == $('#section_id').val()) {
                $('#student_id').append('<option value="'+value.student.id+'">'+value.student.name+' ('+value.student.roll_no+')</option>');
            }
        });
    }

</script>