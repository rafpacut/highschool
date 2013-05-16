 <!-- wybierz osobe, ktorej oceny bedziemy przegladac -->
<form method="GET" action="index.php?student=">
<select name="form_student">


<?php
//pobierz z bazy danych liste osob ( posortuj po nazwiskach, czy baza sama to zrobi?)
$link = mysql_connect('localhost', 'root', 'rootpassword');
if( !$link ) 
	die('nie mozna sie polaczyc z localhost' . mysql_error() );

mysql_select_db('dziennik',$link);
$query = 'select * from osoby';
$db_struct = mysql_query($query);

while( $row = mysql_fetch_array($db_struct) )
{
	echo '<option value=' . $row['id'] . '>' . $row['imie'] . ' ' . $row['nazwisko'] . '</option>';
}




?>

</select>
<input type="submit" value="Submit">
</form>
