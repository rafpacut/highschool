<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<?php
mysql_connect('localhost', 'root', 'rootpassword');
mysql_select_db('dziennik');

$query = 'select * from main where id_osoba =' . $_GET['student'] . ' order by id_przedmiot';

$db_struct = mysql_query( $query );


echo '<table border=1>';
$last_subject = '';
$grade_nr = 1;
$all_grades[0] = 0;
$grade_sum = 0;

while( $row = mysql_fetch_array( $db_struct ) )
{

	$query_tmp = 'select nazwa from przedmioty where id =' . $row['id_przedmiot'];
	$db_struct2 = mysql_query( $query_tmp );
	$subject_name = mysql_fetch_array( $db_struct2 );


	$query_tmp = 'select nazwa,wartosc from oceny where id =' . $row['id_ocena'];
	$db_struct3 = mysql_query($query_tmp);
	$grade = mysql_fetch_array( $db_struct3 );

	
	if( $subject_name['nazwa'] != $last_subject )
	{
		for($i = 0; $i < $grade_nr; $i++)
			$grade_sum += $all_grades[$i];
		$average = $grade_sum / $grade_nr;


		$all_grades = array();
		$grade_sum = 0;
		$grade_nr = 0;



		if( $average != 0 )
			echo '<td>srednia: ' . $average . '</td>';

		echo '</tr><tr><td>' . $subject_name['nazwa'] . '</td>';
		$last_subject = $subject_name['nazwa'];

	}
	echo '<td>' . $grade['nazwa'] . '</td>';


	$all_grades[$grade_nr] = $grade['wartosc'];
	$grade_nr++;
}


for($i = 0; $i < $grade_nr; $i++)
	$grade_sum += $all_grades[$i];
$average = $grade_sum / $grade_nr;
echo '<td>srednia: ' . $average . '</td>';



echo '</table>';
	









	// wypisz nazwe przedmiotu(ToDo: nazwy przedmiotow do wypisania maja byc unikalne)
//	$query_tmp = 'select nazwa from przedmioty where id =' . $row['id_przedmiot'];
//	$db_struct2 = mysql_query( $query_tmp );
//	$subject_name = mysql_fetch_array( $db_struct2 );
//	
//	echo '<br>'. $subject_name['nazwa'] . '<br>';	
//
//	//wypisz ocene
//	$query_tmp = 'select nazwa from oceny where id =' . $row['id_ocena'];
//	$db_struct3 = mysql_query( $query_tmp );
//	$grade = mysql_fetch_array( $db_struct3 );
//
//	echo $grade['nazwa'] . ' ';
