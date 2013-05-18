<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<?php
mysql_connect('localhost', 'root', 'rootpassword');
mysql_select_db('dziennik');

$query = 'select * from main where id_osoba =' . $_GET['student'] . ' order by id_przedmiot';

$db_struct = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct ) )
{
	$query_tmp = 'select nazwa from przedmioty where id =' . $row['id_przedmiot'];
	$db_struct2 = mysql_query( $query_tmp );
	$subject_name = mysql_fetch_array( $db_struct2 );
	
	echo '<br>'. $subject_name['nazwa'] . '<br>';	

	$query_tmp = 'select nazwa from oceny where id =' . $row['id_ocena'];
	$db_struct3 = mysql_query( $query_tmp );
	$grade = mysql_fetch_array( $db_struct3 );

	echo $grade['nazwa'] . ' ';
}
