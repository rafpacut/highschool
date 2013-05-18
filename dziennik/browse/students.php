<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<table align=center>

<?php

mysql_connect( 'localhost', 'root', 'rootpassword' );
mysql_select_db('dziennik');

$query = 'select * from osoby';
$db_struct = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct ) )
{
	echo '<tr><br><td>';
	echo '<a href=grades.php?student=' . $row['id'] . '>' . $row['imie'] . ' ' . $row['nazwisko'] . '</a>';
	echo '</td></tr>';
}
?>
</table>
