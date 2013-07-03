function draw_polyline( data )
{
	var path = [];
	$.each( data, function( key, val )
	{
		var position = new google.maps.LatLng( val[0], val[1] );
		path.push( position );
	});
//	for( var i = 0; i < path.length; i++ )
//	{
//		alert( path[i].lat() );
//	}
	var polyline = new google.maps.Polyline(
	{
		path: path,
	    	strokeColor: '#FF0000',
	        strokeOpacity: 1.0,
	        strokeWeight: 2
	});

	polyline.setMap( map );
}


