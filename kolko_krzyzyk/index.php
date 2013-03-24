<html>
<head>
</head>
<body>


</body>
<?php

	$timestamp = date('d_h:i');
//	echo $timestamp;
	$files = glob("*.wt");
	if(empty($files))
	{
		$filename = $timestamp . ".wt";
		touch($filename);
	}
	else
	{
		echo "there is another player!<br>";
		$filename = $files[0];
		$path =  substr($filename,0,-3);
		unlink($filename);
		mkdir("$path");
	}
?>
</html>
