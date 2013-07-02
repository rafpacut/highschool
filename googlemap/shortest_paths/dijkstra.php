<?php
include "graph_init.php";
set_time_limit(30);


//echo $graph[0]->number;

function find_minimal( $Q )
{
	$minimal = $Q[0];
	$min_key = 0;
	foreach( $Q as $key => $vert )
	{
		if( $minimal->distance > $vert->distance )
		{
			$minimal = $vert;
			$min_key = $key;
		}
	}
	return $min_key;
}








function dijkstra( $graph, $source, $target )
{
	$source->distance = 0;
	$Q =  $graph;
	while( count( $Q ) > 0 )
	{
		$min_index = find_minimal( $Q  );
		$actual_vert = $Q[ $min_index ];
		unset( $Q[ $min_index ] );
		foreach( $actual_vert->ngb_edges as $edge )
		{
			$ngb_index = array_search( $edge->ngb, $Q );
			unset( $Q[$ngb_index] );
			if( $edge->ngb->distance > $actual_vert->distance + $edge->weight )
			{
				$edge->ngb->distance = $actual_vert->distance + $edge->weight;
				$edge->ngb->parent = $actual_vert;
				array_unshift( $Q, $edge->ngb );
			}
		}
	}
}

dijkstra( $graph, $graph[0], $graph[2] ); 

$trace = $graph[2];
echo $trace->number . '<br>';
while( !is_null( $trace->parent ) )
{
	$trace = $trace->parent;
	echo $trace->number . '<br>';
}


?>
