<html>
<head>
</head>
<body>
	<form method=GET>
		Podaj nick:
		<input type=text name=nick>
		<input type=submit>
	</form>


</body>
<?php

	$filepath="players";
	if(isset($_GET['nick']))
	{
		if( 0 == filesize($filepath))//file is empty
		{
			$f = fopen($filepath,"w");
			if(flock($f,LOCK_EX))//succesfully obtained the lock
			{
				fwrite($f,$_GET['nick']);
			}
			flock($f,LOCK_UN);
			fclose($f);
		}
		else
		{
			//obtain second nick
			$f = fopen($filepath,'r');
			if(flock($f,LOCK_SH))// succesfully obtained read lock
			{
				$nick2= fgets($f);
			}
			flock($f,LOCK_EX);//obtain write lock
			//empty the file
			unlink("players");//reset players file
			touch("players");
			flock($f,LOCK_UN);//release the locks
			fclose($f);

			//make a "play room" for those two players
			$roompath=$_GET[nick] . $nick2;
			mkdir($roompath);
			//make the boards
			touch($roompath . '/' . $_GET['nick'] );//player1 armada
			touch($roompath .  '/' . $_GET['nick']  . "shots"); // player1 shots
			touch($roompath .  '/' . $nick2);
			touch($roompath .  '/' . $nick2 . "shots");
		}
	}



?>
</html>
