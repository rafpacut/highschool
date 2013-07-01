<?php
include "graph_init.php";


//echo $graph[0]->number;

function find_minimal( $Q )
{
	$minimal = $Q[0];
	foreach( $Q as $vert )
	{
		if( $minimal->distance > $vert->distance )
		{
			$minimal = $vert;
		}
	}
	return $minimal;
}








function dijkstra( $graph, $source, $target )
{
	$source->distance = 0;
	$Q =  $graph;
	while( count( $Q ) > 0 )
	{
		$actual_vert = find_minimal( $Q  );
		foreach( $actual_vert->nbg_edges as $edge )
		{
			if( $edge->ngb->distance > $actual_vert->distance + $edge->weigth )
			{
				$edge->ngb->distance = $actual_vert->distance + $edge->weigth;
				$edge->ngb->parent = $actual_vert;
				array_unshift( $Q, $edge->ngb );
			}
		}
	}
	$trace = $target;
	echo $trace->number;
	while( $trace->parent != null )
	{
		$trace = $trace->parent;
		echo $trace-number;
	}


}

dijkstra( $graph, $graph[0], $graph[2] ); 



?>
