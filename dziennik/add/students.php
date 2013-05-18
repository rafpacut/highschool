<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<table align="left">

<?php

mysql_connect( 'localhost', 'root', 'rootpassword' );
mysql_select_db( 'dziennik' );



//tworzenie napisu html bedacego rozwijalna lista wszystkich ocen, do wykorzystania przy tablicy
$query_grades = 'select id,nazwa from oceny';
$db_struct_grades = mysql_query( $query_grades );
$select_form = '<form method=GET>';
$select_form .= '<select name=grade>';

while( $row = mysql_fetch_array($db_struct_grades) )
{
	$select_form .= '<option value=' . $row['id'] . '>' . $row['nazwa'] . '</option>';
}
$select_form .= '</select><input type=submit value=grade /><form>';

//tworzenie tablicy z uczniami
$query = 'select * from osoby';
$db_struct_students = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct_students) )
{
	echo '<tr><td>';
	echo $row['imie'] . ' ' . $row['nazwisko'];
	echo '</td><td>' . $select_form ;
	echo '</td></tr>';
}
?>

</table>


