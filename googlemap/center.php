<?php


mysql_connect( 'localhost', 'root', 'rootpassword');
mysql_select_db( 'googlemap' );

if( isset( $_POST['marker_pos'] ) )
{
	$query = 'insert into marker_pos (latitude, longitude) values(' . $_POST['marker_pos'][0] . ', ' . $_POST['marker_pos'][1] . ')';
	mysql_query( $query ) or die( mysql_error() );
}
else
{
	$query = 'select * from marker_pos';
	$db_struct = mysql_query( $query ) or die( mysql_error() );
	$markers = array();
	while( $row = mysql_fetch_array( $db_struct ) )
	{
		$markers[ $row['id'] ] = array();
		$markers[ $row['id'] ][0] = $row['latitude'];
		$markers[ $row['id'] ][1] = $row['longitude'];
	}
	$obj = json_encode( $markers );
	echo $obj;

}



?>


































