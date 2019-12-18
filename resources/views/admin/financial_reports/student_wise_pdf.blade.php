<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Student's Payment History</title>
</head>
<body>
	<div class="row">
		<div class="col" style="padding-right: 5%;">

			<div style="margin-bottom: 20px; width:100%; height:60px;">
				
				<div style="float:left; width:100%; text-align: center;">
					<h3 style="margin:0px; padding:0px">GRACE SCHOOL</h3>
					<address style="margin:0px; padding:0px">{{$branch->name}}, {{$branch->address}}
					</address>
					<span style="margin:0px; padding:0px">Phone:{{$branch->contact_no}}</span>
				</div>

			</div>
			
		</div>
		<br>
		<table style="width: 100%; background-color: #e6f2ff; border: 1">
			<thead>
				<tr>
					<td>Name: {{$student->name}} </td>
				</tr>
				
			</thead>
			<tbody>
				<tr>
					<td>Roll no. {{$student->roll_no}} </td>
					<td>Class: {{$level->class_name}} </td>
					<td>Section: {{$section->section_name}} </td>
				</tr>
			</tbody>

		</table>

		<br>

		<table style="width: 100%; background-color: #e6f2ff;">
			<thead>
				<tr>
					<td>Payment for Month: {{$business_month->month_name}} </td>
					<td>Discount Given: {{$collected_fees->discount_amount}} </td>
					<td colspan="2" style="text-align:right;">Collection date: {{$collected_fees->collection_date}} </td>
				</tr>
				
			</thead>
			<tbody>
				<tr>
					<td>Amount collected: {{$collected_fees->total_collected}} </td>
					<td>Dues kept: {{$collected_fees->total_due}} </td>
					<td style="text-align:right;">Advance paid: {{$collected_fees->total_advanced}} </td>
				</tr>
			</tbody>

		</table>
		<br>

		
	</div>

</body>
</html>