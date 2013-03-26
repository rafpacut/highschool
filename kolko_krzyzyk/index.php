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
<?php
if(isset($_GET['nick']))
{
 	$f = fopen('players','r+');
 	if(flock($f, LOCK_EX))
 	{
 		$file = file_get_contents('players');
 		if(empty($file))
 		{
 			$file =  date('H:i:s');
 			fwrite($f,$file);
 			fflush($f);
 			flock($f,LOCK_UN);
 			fclose($f);
 			while(!file_exists($file))
 			{
 				sleep(3);
 			}
 			$ready = true;
 		}
 		else
 		{
 			ftruncate($f,0);
 			flock($f,LOCK_UN);
 			fclose($f);
 			$dirname = $file;
 			mkdir($file);
 			$ready = true;
 		}
 	}
 }
 
 if(isset($ready) && isset($_GET['nick']))
 {
 	$foo = file_get_contents('start_array.txt');
 	$dest=$file . '/' . $_GET['nick'];
 	copy('start_array.txt',$dest) or die('ehhh');
}







?>
</html>
