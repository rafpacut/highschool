<div>

	<form method=GET>
	<input type=text name=input>
	<br>
	<input type=submit>
	</form>	

</div>

<?php

if(isset($_GET['input']))
{
	$in =$_GET['input'];
	$in = $in . "<br>";
	if(is_writable("history.txt"))
	{
		$f = fopen("history.txt","a");
		fputs($f,$in);
		fclose($f);
	}
}
?>
