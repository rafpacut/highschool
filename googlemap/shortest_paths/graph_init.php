<?php

class Vertex
{
	var $ngb_edges = array();
	var $distance = 999999;
	var $parent = null; 
	var $number = null;
}

class edge
{
	var $ngb = null;
	var $weight = null;
}

$graph = array();


$graph[0] = new Vertex;
$graph[1] = new Vertex;
$graph[2] = new Vertex;

$graph[0]->number = 0;
$graph[1]->number = 1;
$graph[2]->number = 2; 

$graph[1]->parent = $graph[0];
$graph[2]->parent = $graph[1];


$graph[0]->ngb_edges[0] = new edge;

$graph[0]->ngb_edges[0]->ngb = $graph[1];
$graph[0]->ngb_edges[0]->weight = 5;

$graph[0]->ngb_edges[1]->ngb = $graph[2];
$graph[0]->ngb_edges[1]->weight = 22;

$graph[1]->ngb_edges[0]->ngb = $graph[2];
$graph[1]->ngb_edges[0]->weight = 6;


?>






