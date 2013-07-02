var map;
var markersArray = [];
// if there is no markers in database, the first marker will have no id, 
// and by clicking on the map the markersArray[0] would be NaN
markersArray[0] = -1; 
var graph_constructing = false;
var json_str = [];


function add_marker( location, marker_id )
{
	var marker = new google.maps.Marker
	({
		position: location,
		map: map,
		title: "marker",
		id: marker_id
	});

	//marker specific event listener allowing deletion:
	google.maps.event.addListener( marker, 'click', function()
	{
		$.post("/googlemap/center.php", { 'id': marker_id });
		marker.setMap( null );
	});


	//send marker position to database via php:
	//w tej chwili unikalnosc markerow jest zachowana dzieki odrzucaniu duplikatow przez baze danych,
	//nie lepiej byloby sprawdzic ja iterujac po tablicy markerow?
	$.post("/googlemap/center.php", { 'marker_pos[]': [ marker_id, location.lat(), location.lng() ]});

	google.maps.event.addListener( marker, 'rightclick', function()
	{
		if( graph_constructing )
        	{
			graph_constructing = false;

			json_str[1] = [];
			json_str[1][0] = marker_id;
			json_str[1][1] = location.lat();
			json_str[1][2] = location.lng();

			$.post("/googlemap/shortest_paths/graph_init.php", JSON.stringify( json_str ) );
		}
		else
		{
			graph_constructing = true;

			json_str[0] = [];
			json_str[0][0] = marker_id;
			json_str[0][1] = location.lat();
			json_str[0][2] = location.lng();
		}

		
	});

	markersArray.push( marker_id );
}



function initialize()
{
  var mapOptions =
  {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  //re-create all the markers previously set from the database:
	$.getJSON( '/googlemap/center.php', function( data )
  	{
		$.each( data, function( key, val )
		{
			var new_marker_Latlng = new google.maps.LatLng( val[0], val[1] );
			add_marker( new_marker_Latlng, parseFloat(key) );
		});

		
	});

//create a marker after clicking on map:
google.maps.event.addListener( map, 'click', function( event )
{
	marker_id = markersArray[markersArray.length - 1] + 1;
	  add_marker( event.latLng, marker_id );
});


var distanceWidget = new DistanceWidget( map );


}

google.maps.event.addDomListener(window, 'load', initialize);



