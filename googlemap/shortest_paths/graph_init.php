<?php
include "dijkstra.php";

class Vertex
{
	var $ngb_edges = array();
	var $distance = 999999;
	var $parent = null; 
	var $number = null;
	var $lat = null;
	var $lng = null;
}

class edge
{
	var $ngb = null;
	var $weight = null;
}

$graph = array();


//$graph[0] = new Vertex;
//$graph[1] = new Vertex;
//$graph[2] = new Vertex;
//
//$graph[0]->number = 0;
//$graph[1]->number = 1;
//$graph[2]->number = 2; 
//
//$graph[1]->parent = $graph[0];
//$graph[2]->parent = $graph[1];
//
//
//$graph[0]->ngb_edges[0] = new edge;
//
//$graph[0]->ngb_edges[0]->ngb = $graph[1];
//$graph[0]->ngb_edges[0]->weight = 5;
//
//$graph[0]->ngb_edges[1]->ngb = $graph[2];
//$graph[0]->ngb_edges[1]->weight = 22;
//
//$graph[1]->ngb_edges[0]->ngb = $graph[2];
//$graph[1]->ngb_edges[0]->weight = 6;
//dijkstra( $graph, $graph[0], $graph[2] );

/*
Calculates the great-circle distance between two points, with
  the Haversine formula.
  */
function haversineDistance( $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo )
{
	$earthRadius = 6371000;
  // convert from degrees to radians
  	$latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
  
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
  
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                 cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
} 



if( isset( $_GET['source_id'] ) )
{


	$circle_radius = 300;

	mysql_connect( 'localhost', 'root', 'rootpassword' );
	mysql_select_db( 'googlemap' );
	$query = 'select * from marker_pos';


	$db_struct = mysql_query( $query) or die( mysql_error() );
	while( $row = mysql_fetch_array( $db_struct ) )
	{
		$marker = new Vertex;
		$marker->number = $row['id'];
		$marker->lat = $row['latitude'];
		$marker->lng = $row['longitude'];
		array_push( $graph, $marker );
	}

	foreach( $graph as $actual )
	{
		foreach( $graph as $vert )
		{
			if( $actual->number != $vert->number )
			{
				$distance = haversineDistance( $actual->lat, $actual->lng, $vert->lat, $vert->lng) / 1000;
				if( $distance <= $circle_radius )
				{
					$edge = new edge;
					$edge->ngb = $vert;
					$edge->weight = $distance;
					array_push( $actual->ngb_edges, $edge );
				}
			}
		}
	}

	foreach( $graph as $vert )
	{
		echo "marker nr: " . $vert->number . " has ngb's: ";
		foreach( $vert->ngb_edges as $edge )
		{
			echo $edge->ngb->number . ',';
		}
	}



	foreach( $graph as $vert )
	{
		if( $vert->number === $_GET['source_id'] )
			$source = $vert;
		if( $vert->number === $_GET['dest_id'] )
			$target = $vert;
	}	


	dijkstra( $graph, $source, $target );

	$path = array();
	$trace = $target;
	//echo $trace->number . " ";

	$path[0] = array();
	$path[0][0] = $trace->lat;
	$path[0][1] = $trace->lng;

	
	while( $trace->parent != null )
	{
		$trace = $trace->parent;
		$arr = array();
		array_push( $path, $arr );
		$el_number = count( $path );
		$path[ $el_number ][0] = $trace->lat;
		$path[ $el_number ][1] = $trace->lng;
		//echo $trace->number . " ";
	}

	$obj = json_encode( $path );
	echo $obj;
}


				


	

?>
