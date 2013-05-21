<form action="../index.php">
	<button type="submit">Wroc</button>
</form>

<table align="left">

<?php

mysql_connect( 'localhost', 'root', 'rootpassword' );
mysql_select_db( 'dziennik' );


//tworzenie listy wyboru ocen, do tabeli z uczniami :
$query= 'select nazwa,id from oceny';
$grades_db_struct = mysql_query( $query );

$gll_end='';	
$gll_end.= '<option value=NULL>-</option>';
while( $row = mysql_fetch_array( $grades_db_struct ) )
{
	$gll_end.= '<option value='.$row['id'].'>'.$row['nazwa'].'</option>';
}
$gll_end.='</select>';
//$gll_end.='<input type=hidden name=subject value='.$_GET['subject'].'/>';

//funkcja do latwiejszego wstawiania do tworzenia tablicy z uczniami
function echo_grade_list( $i )
{
	global $gll_end;
	$gll = '<form action=students.php? method=GET >';
	$gll .= '<select name=grade'.$i.'>';
	$gll.= $gll_end;
	$gll.= '<input type=submit value=submit />';
	echo $gll;
}


//tworzenie tablicy z uczniami
$query = 'select * from osoby';
$db_struct_students = mysql_query( $query );

$i=1;
while( $row = mysql_fetch_array( $db_struct_students) )
{
	echo '<tr><td>';
	echo $row['imie'] . ' ' . $row['nazwisko'];
	echo '</td><td>'.echo_grade_list( $i );
	echo '</td></tr>';
	$i++;
}
echo '<input type=hidden name=subject value='.$_GET['subject'].' />';
?>
</table>

<?php
$j=1;
//while( isset($_GET["grade$j"] ) || $j <= $i )
//{
//	$query= 'insert  into main(id_przedmiot,id_osoba,id_ocena) '.$_GET['subject'].','.$j.','.$_GET["grade$j"];
//}
for($j=1; isset($_GET["grade$j"]);  $j++)
{
	if($_GET["grade$j"] != NULL)
	{
		$query= 'insert  into main (id_przedmiot,id_osoba,id_ocena) values ('.$_GET['subject'].','.$j.','.$_GET["grade$j"].')';
		echo $query . '<br>';
		mysql_query( $query );
	}

}

?>









