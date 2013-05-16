<form method="GET" action="index.php?student=$_GET['form_student']&subject=">
<select name="form_subject">
<?php
//acquire and echo a select form of the list of subjects, the student is enrolled into

$link = mysql_connect( 'localhost', 'root', 'rootpassword');
mysql_select_db( 'dziennik', $link );
$query = "select * from przedmioty";
$database_struct = mysql_query( $query ) ;
while ( $row = mysql_fetch_array( $database_struct ) )
{
	echo '<option value='.$row[id].'>'. $row[imie].' </option>';
}

?>

</select>
<input type="submit" value="Submit">
</form>
