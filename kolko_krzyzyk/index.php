<html>
<head>
<?php
if(isset($_GET['x']))
{
//	$newboard= file_get_contents($_GET['channel']; // nie ma juz channel- na koncu skryptu jest rename tuz po wyswietleniu tablicy
//	for($i = 0; $i < 17; $i++)
//	{
//		if($i == ( 4*($x-1) + $y))
//		{
//			$newboard[$i] = $_GET['player'];
//		}
//	}
}




?>
<?php // parowanie graczy
if(!isset($_GET['player'])) 
{
	$files = glob("*.wt");
	if(empty($files))
	{
		echo "that's the first player!";
		$channel=date('H:i:s');
		$filename = $channel . '.wt';
		$f = fopen($filename, "w+");
		for($i = 0; $i < 17; $i++)
		{
			fwrite($f,"0");
		}
		fclose($f);
		chmod($filename,0664);
		$player = 1;
		$channel = $channel . '.' . $player;
	}
	else
	{
		echo "that's the second player!";
		$channel = $files[0];
		$channel = substr($channel, 0, -3);
		$player = 2;
		$newplayer = $player % 2 + 1;
		$newfile = substr($files[0], 0, -3) . '.' . $newplayer;
		rename($files[0], $newfile);
		$channel = $channel . '.' . $player;
	}
	echo '<Meta http-equiv="refresh" content="10;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $channel .  '&player=' . $player . '">';
}
else
{
	echo '<Meta http-equiv="refresh" content="10;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $_GET['channel'] .  '&player=' .  $_GET['player'] . '">';
}

?>
</head>
<body>

<?php



if(isset($_GET['channel']))
{
	$dh = opendir('./');
	while(($file = readdir($dh)) !== false)
	{
		if($file == $_GET['channel']) // jezeli moja tura
		{
			$board = file_get_contents($file); // wypisywanie tablicy
			echo '<table border=1>';	
			for( $i = 1; $i < 5; $i++)
			{
				echo '<tr>';
				for( $j = 1; $j < 5; $j++)
				{
					echo '<td>';
					if($board[4*($i-1)+ $j] == 0) //jezeli puste miejsce
					{
						echo '<a href="http://localhost/kolko_krzyzyk/index.php?channel='.$_GET['channel'].'&player='.$_GET['player'].'&x='.$j.'&y='.$i.'">
							<img src="images/image0.jpg"></a>';
					}
					else
					{
						echo '<a href="http://localhost/kolko_krzyzyk/index.php?channel='.$_GET['channel'].'&player='.$_GET['player'].'">
							<img src="images/image'.$_GET['player'].'.jpg"></a>';
					}

					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';


			$newplayer = substr($file,-1) % 2 + 1; // zmien nazwe pliku
			$newfile = substr($file ,0,-1) . $newplayer;
			sleep(3);
			rename($file, $newfile);
		}
	}
}

?>

</body>
</html>
