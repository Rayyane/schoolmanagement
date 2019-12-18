<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>

	<style>
		table {
			border-collapse: collapse;
			width:100%;
		}

		table, th, td {
			border: 1px solid black;
			padding: 5px;
		}
		.col{
			float:left;
			width:45%;
		}
		.head_table td{
			border:none;
		}
		.head_table{
			border: 1px dotted;
			margin:0;

		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col" style="padding-right: 5%; border-right: 1px solid">
		<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%">
				 <img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
			</div>
			<div style="float:left; width:84%; text-align: center;">
				<h3 style="margin:0px; padding:0px">GRACE SCHOOL</h3>
				<address style="margin:0px; padding:0px">{{$section_student->section->level_enroll->branch->name}}, {{$section_student->section->level_enroll->branch->address}}</address>
				<span style="margin:0px; padding:0px">Phone:{{$section_student->section->level_enroll->branch->contact_no}}</span>
			</div>
		</div>
			<div style="height:500px;">
				<table class="head_table" style="border:none">
					<tr>
						<td>Session: {{$section_student->section->level_enroll->session->name}}</td>
						<td>Date: {{$collected->collection_date}}</td>
					</tr>
				</table>
				
				<table class="head_table">
					<tr>
						<td>Name: {{$section_student->student->name}}</td>
						<td>Shift: {{$section_student->section->level_enroll->shift->shift_name}}</td>
						<td>Class Roll: {{$section_student->student->roll_no}}</td>
					</tr>
					<tr>
						<td>Class: {{$section_student->section->level_enroll->level->class_name}}</td>
						<td></td>
						<td>Section: {{$section_student->section->section_name}}</td>
					</tr>
				</table>
				<br>
				<table>
					<tr>
						<th>SL#</th>
						<th>Fees Types</th>
						<th>Taka</th>
					</tr>
					@php $i = 1; $total = 0.0; @endphp
					@foreach($section_wise_fees as $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$value->fees_type->fees_type_name}}</td>
						<td style="text-align: right">{{$value->amount}}</td>
					</tr>
					@php $i++; $total+=$value->amount; @endphp
					@endforeach
					<tr>
						<td colspan="2">Total Payable Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $total-$collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2">Due</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_due)}}</td>
					</tr>
					<tr>
						<td colspan="2">Advanced</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_advanced)}}</td>
					</tr>
					<tr>
						<td colspan="2">Discount Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2"><b>Total Paid</b></td>
						<td style="text-align: right"><b>{{sprintf("%.2f", $collected->total_collected)}}</b></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total Paid in Word: ({{$collected->total_collected_word}} Only)</b></td>
					</tr>
				</table>
			</div>
			<div style="text-align: center; width:20%; border: 1px dotted; padding:2px; float:left">
				Print Date<br>
				{{date('M d Y')}}
			</div>
			<div style="float:left; margin-left:5%;  text-align: center; width:77%">
				<div style="float:left; width:33%">
					...............<br>
					Parents/Student
				</div>
				<div style="float:left; width:33%">
					.............<br>
					Cashier
				</div>
				<div style="float:left; width:33%">
					.............<br>
					Officer
				</div>
			</div>
			<div style="text-align: center">
				<h5 style="padding:0px; margin-top: 5px;margin-bottom: 0px;">Office Copy</h5>
			</div>
		</div>
		<div class="col" style="margin-left: 5%;">
			<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%;">
				 <img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
			</div>
			<div style="float:left; width:84%; text-align: center;">
				<h3 style="margin:0px; padding:0px">GRACE SCHOOL</h3>
				<address style="margin:0px; padding:0px">{{$section_student->section->level_enroll->branch->name}}, {{$section_student->section->level_enroll->branch->address}}</address>
				<span style="margin:0px; padding:0px">Phone:{{$section_student->section->level_enroll->branch->contact_no}}</span>
			</div>
		</div>
			<div style="height:500px;">
				<table class="head_table" style="border:none">
					<tr>
						<td>Session: {{$section_student->section->level_enroll->session->name}}</td>
						<td>Date: {{$collected->collection_date}}</td>
					</tr>
				</table>
				
				<table class="head_table">
					<tr>
						<td>Name: {{$section_student->student->name}}</td>
						<td>Shift: {{$section_student->section->level_enroll->shift->shift_name}}</td>
						<td>Class Roll: {{$section_student->student->roll_no}}</td>
					</tr>
					<tr>
						<td>Class: {{$section_student->section->level_enroll->level->class_name}}</td>
						<td></td>
						<td>Section: {{$section_student->section->section_name}}</td>
					</tr>
				</table>
				<br>
				<table>
					<tr>
						<th>SL#</th>
						<th>Fees Types</th>
						<th>Taka</th>
					</tr>
					@php $i = 1; $total = 0.0; @endphp
					@foreach($section_wise_fees as $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$value->fees_type->fees_type_name}}</td>
						<td  style="text-align: right">{{$value->amount}}</td>
					</tr>
					@php $i++; $total+=$value->amount; @endphp
					@endforeach
					<tr>
						<td colspan="2">Total Payable Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $total-$collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2">Due</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_due)}}</td>
					</tr>
					<tr>
						<td colspan="2">Advanced</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_advanced)}}</td>
					</tr>
					<tr>
						<td colspan="2">Discount Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2"><b>Total Paid</b></td>
						<td style="text-align: right"><b>{{sprintf("%.2f", $collected->total_collected)}}</b></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total Paid in Word: ({{$collected->total_collected_word}} Only)</b></td>
					</tr>
				</table>
			</div>
			<div style="text-align: center; width:20%; border: 1px dotted; padding:2px; float:left">
				Print Date<br>
				{{date('M d Y')}}
			</div>
			<div style="float:left; margin-left:5%;  text-align: center; width:77%">
				<div style="float:left; width:33%">
					...............<br>
					Parents/Student
				</div>
				<div style="float:left; width:33%">
					.............<br>
					Cashier
				</div>
				<div style="float:left; width:33%">
					.............<br>
					Officer
				</div>
			</div>
			<div style="text-align: center">
				<h5 style="padding:0px; margin-top: 5px;margin-bottom: 0px;">Students Copy</h5>
			</div>
		</div>
	</div>

</body>

</html>