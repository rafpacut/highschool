<html>
<head>
<?php

function get_pos( $x, $y )
{
	$pos = 4*$y + $x;
	if( $pos > 0 && $pos < 4 )
		return $pos;
	else
		return -1;
}


function sum_line( $x, $y, $file, $dx, $dy )
{
	$sum = 0;
	$x -= 4*$dx;
	$y -= 4*$dy;
	echo "dx: $dx, dy: $dy <br> <br>";
	for( $i = 0; $i < 8; $i++)
	{
		echo "x: $x, y: $y, sum: $sum" . '<br>';
		if( $sum == 3 )
			return true;
		$pos = get_pos( $x, $y);
		if(  $pos != -1)
		{
			echo "pos: $pos <br>";
			if( $_GET['player'] == $file[$pos] )
				$sum++;
		}
		$x += $dx;
		$y += $dy;
	}
	return false;
}




function check_for_win($start_x, $start_y, $file)
{
	if( sum_line( $start_x, $start_y, $file, -1, -1) ||
		sum_line( $start_x, $start_y, $file, -1, 0) ||
		sum_line( $start_x, $start_y, $file, 1, -1) ||
		sum_line( $start_x, $start_y, $file, 0, 1) )
			return true;
		else
			return false;
}


if(isset($_GET['x']))
{
	$channel = $_GET['channel'];
	$x = $_GET['x'];
	$y = $_GET['y'];
	$newboard= file_get_contents($channel);
	for($i = 0; $i < 17; $i++)
	{
		if($i == ( 4*($y-1) + $x))
		{
			$newboard[$i] = $_GET['player'];
		}
	}

	if(check_for_win($x, $y, $newboard))
	{
		echo "wygrales!";
	}

	file_put_contents($channel,$newboard);
	$newplayer = substr($channel,-1) % 2 + 1; // zmien nazwe pliku
	$newfile = substr($channel ,0,-1) . $newplayer;
	rename($channel, $newfile);
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
	echo '<Meta http-equiv="refresh" content="0;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $channel .  '&player=' . $player . '">';
}
else
{
	echo '<Meta http-equiv="refresh" content="20;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $_GET['channel'] .  '&player=' .  $_GET['player'] . '">';
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
							<img src="images/image'.$board[4*($i-1)+ $j].'.jpg"></a>';
					}

					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';


		}
	}
}

?>

</body>
</html>
