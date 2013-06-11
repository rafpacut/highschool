var map;

function add_marker(  markLatlng )
{
	var marker = new google.maps.Marker
	({
		position: markLatlng,
		map: map,
		title: "Marker"
	})


	//send marker position to database via php:
	$.post("/googlemap/center.php", { 'marker_pos[]': [ markLatlng.lat(), markLatlng.lng() ]});


	return marker;
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
			//var new_marker_Latlng = new google.maps.LatLng( val.latitude, val.longitude );
			//add_marker( new_marker_Latlng );
			//val zawiera zarowno latitude i longitude, nalezy to rozdzielic
			console.log( "latitude "+val );
		});

		
	});

//create a marker after clicking on map:
google.maps.event.addListener(map, 'click', function( event )
{
	  var markLatlng = new google.maps.LatLng( event.latLng.lat(), event.latLng.lng() );
	  add_marker( markLatlng );
});

//google.maps.event.addListener(marker, 'click', function( event )
//{
//
//
//});
}

google.maps.event.addDomListener(window, 'load', initialize);

