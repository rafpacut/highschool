<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<table align="left">

<?php

mysql_connect( 'localhost', 'root', 'rootpassword' );
mysql_select_db( 'dziennik' );



//tworzenie tablicy z uczniami
$query = 'select * from osoby';
$db_struct_students = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct_students) )
{
	echo '<tr><td>';
	echo $row['imie'] . ' ' . $row['nazwisko'];
	echo '</td></tr>';
}
?>

</table>


