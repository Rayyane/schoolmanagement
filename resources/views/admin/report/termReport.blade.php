<!DOCTYPE html>
<html>
<head>
	<title>Term Result</title>
</head>
<body>
	<table style="width: 100%; background-color: #e6ffff">
		<thead>
			<tr>
				<th colspan="3"> {{$term->term_name}} Result </th>
			</tr>
			
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<br>
	<table style="width: 100%; background-color: #e6f2ff">
		<thead>
			
		</thead>
		<tbody>
			<tr>
				<td>Student:<br>{{$student->name}}</td>
				<td> Roll no.<br>0{{$student->roll_no}} </td>
				<td>Class:<br>{{$level->class_name}}</td>
				<td>Section:<br>{{$section->section_name}} </td>
				<td>Session:<br>{{$session->name}} </td>
			</tr>
		</tbody>
	</table>

	<br>

	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Letter Grade</th>
				<th>Point</th>
				<th>Letter Grade</th>
				<th>Point</th>
				<th>Letter Grade</th>
				<th>Point</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>80-100=A+</td>
				<td>5.00</td>
				<td>70-79=A</td>
				<td>4.00</td>
				<td>60-69=A-</td>
				<td>3.50</td>
			</tr>
			<tr>
				<td>50-59=B</td>
				<td>3.00</td>
				<td>40-49=C</td>
				<td>2.00</td>
				<td>00-39=F</td>
				<td>0.00</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Subjects</th>
	            <th>Weekly Test<br>Marks<br>(converted<br> to 20)</th>
	            <th>Term Marks<br>(in 100)</th>
	            <th>Term<br>Marks<br>(converted<br>to 80)</th>
	            <th>Term Total</th>
	            <th>Letter Grade</th>
	            <th>Points</th>
			</tr>
			
		</thead>
		<tbody>
			@foreach($term_results as $term_result)

                <?php

                $section_subject_teacher =
                    \App\Models\SectionSubjectTeacher::find($term_result->section_subject_teacher_id);

                $subject =
                    \App\Models\Subject::find($section_subject_teacher->subject_id);

                $term_adjusted = (($term_result->term_marks) * 80) / 100;

                $letter_grade = "";
                $points = "0.0";
                $i = $term_result->total_marks;

                if ($i >= 80 && $i <= 100) {
                    $letter_grade = "A+";
                    $points = "5.0";
                } elseif ($i >= 70 && $i <= 79) {
                    $letter_grade = "A";
                    $points = "4.0";
                } elseif ($i >= 60 && $i <= 69) {
                    $letter_grade = "A-";
                    $points = "3.5";
                } elseif ($i >= 50 && $i <= 59) {
                    $letter_grade = "B";
                    $points = "3.0";
                } elseif ($i >= 40 && $i <= 49) {
                    $letter_grade = "C";
                    $points = "2.0";
                } elseif ($i >= 00 && $i <= 39) {
                    $letter_grade = "F";
                    $points = "0.0";
                }

                ?>


                <tr>
                    <td>
                        {{$subject->subject_name}}
                    </td>

                    <td>
                        {{$term_result->weekly_avg}}

                    </td>

                    <td>
                        {{$term_result->term_marks}}
                    </td>

                    <td>
                        {{$term_adjusted}}
                    </td>

                    <td>
                        {{$term_result->total_marks}}
                    </td>

                    <td>
                        {{$letter_grade}}
                    </td>

                    <td>
                        {{$points}}
                    </td>

                </tr>

            @endforeach
		</tbody>
	</table>

	<?php
	$term_marks_total = 0;
	//dd(count($term_results));
	foreach ($term_results as $term_result) {
		$term_marks_total = $term_marks_total + ($term_result->total_marks);
	}
	$i = $term_marks_total/count($term_results);
	$letter_grade = "";
    $points = "0.0";
    //$i = $term_result->total_marks;

    if ($i >= 80 && $i <= 100) {
        $letter_grade = "A+";
        $points = "5.0";
    } elseif ($i >= 70 && $i <= 79) {
        $letter_grade = "A";
        $points = "4.0";
    } elseif ($i >= 60 && $i <= 69) {
        $letter_grade = "A-";
        $points = "3.5";
    } elseif ($i >= 50 && $i <= 59) {
        $letter_grade = "B";
        $points = "3.0";
    } elseif ($i >= 40 && $i <= 49) {
        $letter_grade = "C";
        $points = "2.0";
    } elseif ($i >= 00 && $i <= 39) {
        $letter_grade = "F";
        $points = "0.0";
    }
	?>
	<br>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th>Term Name</th>
				<th>GPA</th>
				<th>Points</th>
				<th>Class Teacher's comment</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$term->term_name}}</td>
				<td>{{$letter_grade}}</td>
				<td>{{$points}}</td>
				<td></td>
			</tr>
		</tbody>
	</table>

</body>
</html>