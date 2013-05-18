<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<table align="left">

<?php
mysql_connect( 'localhost', 'root', 'rootpassword');
mysql_select_db( 'dziennik' );

$query = 'select * from przedmioty';
$db_struct = mysql_query( $query );

while( $row = mysql_fetch_array( $db_struct ) )
{
	echo '<tr><td>';
	echo '<a href=students.php?subject=' . $row['id'] . '>' . $row['nazwa'] . '</a>';
	echo '</td></tr>';
}

