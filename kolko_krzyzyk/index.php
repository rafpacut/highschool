<html>
<head>
<?php
if(!isset($_GET['player']))
{
	$directory='./';
	$files = glob("*.wt");
	if(empty($files))
	{
		echo "that's the first player!";
		$time=date('H:i:s');
		$channel = $time . '.wt';
		$f = fopen($channel, "w+");
		fclose($f);
		chmod($channel,0664);
		$player = 1;
	}
	else
	{
		echo "that's the second player!";
		$channel = $files[0];
		$player = 2;
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

</body>
</html>
