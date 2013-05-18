<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<?php
mysql_connect('localhost', 'root', 'rootpassword');
mysql_select_db('dziennik');

$query = 'select * from main where id_osoba =' . $_GET['student'] ;

$db_struct = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct ) )
{
	echo $row['id_przedmiot'] . ' ' . $row['id_ocena'] . '<br>';
}
