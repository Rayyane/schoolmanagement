@section('heading')
Weekly Test
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card card-plain">

                @if(Session::has('message'))
                {{ Session::get('message') }}
                @endif

                <div class="header">
                    <h4 class="title">Results</h4>
                    <p class="category">Weekly test section</p>
                    <br>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/view_subjects']) !!}
                        <div class="row" style="align-content: center">
                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
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
                            <div class="col-md-3">

                            </div>   

                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('level','Choose Class:') !!}
                                    
                                    
                                    {!! Form::select('level_id', [], isset($student->level_id) ? $student->level_id : null, ['class'=> 'form-control', 'id' => 'level_id']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                            </div>  

                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('sections','Choose section:') !!}
                                    {!! Form::select('section_id', [], isset($student->section_id) ? $student->section_id : null, ['class'=> 'form-control', 'id' => 'section_id']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row" style="align-content: center">
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    
                                    {!! Form::label('terms','Choose term:') !!}
                                    {!! Form::select('term_id', $terms, null, ['class'=> 'form-control', 'id' => 'term_id']) !!} 

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Search', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


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


@endsection