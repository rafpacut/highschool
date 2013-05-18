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

<form action="index.php?action=" method="GET">
	<button name="action" type="submit" value="browse">Przegladnij oceny</button>
	<button name="action" type="submit" value="add">Wstaw ocene</button>
</form>

<?php
//wybierz osobe, ktorej oceny bedziemy przegladac
if( isset($_GET['action'] ) )
{
	$action = $_GET['action'];
	if( $action == 'browse' )
	{
		include 'browse/students.php';
	}
	else
	{
		echo "add";
	}
}


?>
</body>

</html>
