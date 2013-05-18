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
<!--  -->
<!-- Przegladaj oceny -->
<form action="browse/students.php" method="GET">
	<button type="submit">Przegladaj oceny</button>
</form>

<?php
// dolaczanie modulow odpowiadajacych wybranej akcji
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
