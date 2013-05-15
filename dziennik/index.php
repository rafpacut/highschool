<!-- 
program imitujacy dziennik elektroniczny z mozliwoscia przegladania ocen uczniow i dodawania ich.

struktura bazy danych:
	-osoby:
		id, imie, nazwisko;
	-przedmioty:
		id, nazwa;
	-oceny:
		id, wartosc(INT), nazwa(string);
	-main:
		 id_przedmiot,id_osoba, id_ocena;
-->
<html>
<head>
</head>
<body>
 <!-- wybierz osobe, ktorej oceny bedziemy przegladac -->
<form action="">
<select name="osoby">



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
</form>
</body>

</html>
