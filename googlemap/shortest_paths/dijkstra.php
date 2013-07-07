<?php
set_time_limit(10);


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

function pprint( $Q, $graph )
{
	echo '$Q: ';
	foreach( $Q as $q_vert )
	{
		if( $q_vert->parent != null )
			echo $q_vert->number . " has a parent in: " . $q_vert->parent->number . ", ";
		else
			echo $q_vert->number . " has no parent, ";
	}
	echo 'graph: ';
	foreach( $graph as $g_vert )
	{
		if( $g_vert->parent != null )
			echo $g_vert->number . " has a parent in: " . $g_vert->parent->number . ", ";
		else
			echo $g_vert->number . " has no parent, ";
	}
	echo "END OF TURN           ";
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
		$Q = array_values( $Q ) ;
		foreach( $actual_vert->ngb_edges as $edge )
		{
			//$ngb_index = array_search( $edge->ngb, $Q, true );
			//unset( $Q[$ngb_index] );
			if( $edge->ngb->distance > $actual_vert->distance + $edge->weight )
			{
				$edge->ngb->distance = $actual_vert->distance + $edge->weight;
				$edge->ngb->parent = $actual_vert;
				array_unshift( $Q, $edge->ngb );
			}
			$Q = array_values( $Q ) ;
		}
		//pprint( $Q, $graph );
	}
}


?>
