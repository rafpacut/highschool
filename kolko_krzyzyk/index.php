<html>
<head>
</head>
<body>

	<form method=GET>
		Podaj swoj nick:
		<input type=text name=nick>
		<input type=submit>
	</form>

</body>
<?phP
if(isset($_GET['nick']))
{
	$f = fopen('players','r+');
	if(flock($f, LOCK_EX))
	{
		$file = file_get_contents('players');
		if(empty($file))
		{
			$timestamp = date('H:i:s');
			fwrite($f,$timestamp);
			fflush($f);
			flock($f,LOCK_UN);
			fclose($f);
			while(!file_exists($timestamp))
			{
				sleep(3);
			}
			$filename = $timestamp . '/' . $nick;
			touch($filename) or die("player1 nie zdolal stworzyc pliku");
		}
		else
		{
			ftruncate($f,0);
			flock($f,LOCK_UN);
			fclose($f);
			$dirname = $file;
			mkdir($file);
			$filename = $file . '/' . $nick;
			touch($filename)  or die("player2 nie zdolal stworzyc pliku");
		}
	}
}

?>
</html>
