<html>
<head>
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
		for($i = 0; $i < 16; $i++)
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
	echo '<Meta http-equiv="refresh" content="5;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $channel .  '&player=' . $player . '">';
}
else
{
	echo '<Meta http-equiv="refresh" content="5;URL=http://localhost/kolko_krzyzyk/index.php?channel=' . $_GET['channel'] .  '&player=' .  $_GET['player'] . '">';
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
		if($file == $_GET['channel'])
		{
			echo "twoj ruch <br>";

			$board = file_get_contents($file);
			echo '<table border=1>';	
			for( $i = 0; $i < 4; $i++)
			{
				echo '<tr>';
				for( $j = 0; $j < 4; $j++)
				{
					echo '<td>';
					echo '<a href="http://localhost/kolko_krzyzyk/index.php?channel='.$_GET['channel'].'&player='.$_GET['player'].'&x='.$j.'&y='.$i.'">
						<img src="images/image0.jpg"></a>';
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';


			$newplayer = substr($file,-1) % 2 + 1;
			$newfile = substr($file ,0,-1) . $newplayer;
			sleep(3);
			rename($file, $newfile);
		}
	}
}

?>

</body>
</html>
