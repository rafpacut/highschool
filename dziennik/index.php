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
<?php
//wybierz osobe, ktorej oceny bedziemy przegladac

include 'wybor_uczniowie.php';

// wyswietl menu z wyborem przedmiotow. ToDo: dodaj opcje "zestawienie ocen z przedmiotow, badz samej sredniej z nich"
if(isset($_GET['form_student'] ) ) // jezeli zostala wybrana osoba
{
	include 'wybor_przedmioty.php';
}
?>
</body>

</html>
