<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fiscal_year','Choose month:') !!}
            <?php
            $listFiscalYears = [];
            foreach ($fiscal_years as $keyL => $valL){
                //dd($valL->id);
                $listFiscalYears[$valL->id] = $valL->year;
            }
            //dd($listFiscalYears);
            ?>
            {!! Form::select('fiscal_year_id', $listFiscalYears, null, ['required', 'class'=> 'form-control', 'id' => 'fiscal_year_id']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('month_name','Choose month:') !!}                
            {!! Form::select('business_month_id', [], null, ['required', 'class'=> 'form-control', 'id' => 'business_month_id']) !!}
        </div>
    </div>
</div>

<script type="text/javascript">
    var fiscalYearList = <?php echo json_encode($fiscal_years);?>;
    var businessMonthList = <?php echo json_encode($business_months);?>;
    //console.log(businessMonthList);
    $(document).ready(function() {
        $('#fiscal_year_id').change(function (e){
                e.preventDefault();
                updateMonth();
            });
        updateMonth();
    });

    function updateMonth() {
        $('#business_month_id').empty();
        $.each(businessMonthList, function(index, value) {
            //console.log(value.id);
            if(value.fiscal_year_id == $('#fiscal_year_id').val()) {
                $('#business_month_id').append('<option value="'+value.id+'">'+value.month_name+'</option>');
            }
        });
    }

    
</script>