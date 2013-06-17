/**
 * Widget ktory  wyswietli okrag, ktorego promien mozna zmieniac
 * promien w DistanceWidget jest w km!
 * przyjmuje mape do, ktorej widget ma byc przyklejony
 *  konstruktor
 */
function DistanceWidget( map )
{
	this.set( 'map', map );
	this.set( 'position', map.getCenter() );

	var marker = new google.maps.Marker
	({
		draggable: true,
		title: 'Move me!'
	});

	marker.bindTo( 'map', this );
	
	marker.bindTo( 'position', this );

	var radiusWidget = new RadiusWidget();

	//zwiaz mapy radiusWidget'a i distanceWidget'a:
	radiusWidget.bindTo( 'map', this);

	// srodki:
	radiusWidget.bindTo( 'center', this, 'position' );

	// Bind to the radiusWidgets' distance property
	this.bindTo('distance', radiusWidget);
	
	// Bind to the radiusWidgets' bounds property
	this.bindTo('bounds', radiusWidget);
}

DistanceWidget.prototype =  new google.maps.MVCObject();

/*
 * Widget promienia dodajacy okrag do DistanceWidget
 * umiejscawiajacy jego srodek w markerze z DistanceWidgeta
 * konstruktor
 */
function RadiusWidget()
{
	var circle = new google.maps.Circle
	({
		strokeWeight: 2
	});

	//ustaw domyslna odleglosc na 50km
	this.set( 'distance', 50 );

	//zwiaz RadiusWidget bounds z bounds okregu
	this.bindTo( 'bounds', circle );

	//zwiaz center okregu z RadiusWidget center
	circle.bindTo( 'center', this);

	//mape
	circle.bindTo( 'map', this);

	//promien
	circle.bindTo( 'radius', this );


	this.addSizer_();
	
}

RadiusWidget.prototype = new google.maps.MVCObject();

// przeskaluj roznice w jednostkach wlasnosci radius[m] i distance[km]:
//distance_changed() wywola sie zawsze gdy zostanie 
//wywolana funkcja RadiusWidget.set( 'distance', x )
RadiusWidget.prototype.distance_changed = function()
{
	this.set( 'radius', this.get( 'distance' ) * 1000);
};

//dodaj marker do zmieniania promienia kola:
RadiusWidget.prototype.addSizer_ = function()
{
	var sizer = new google.maps.Marker
	({
		draggable: true,
		title: "Drag me!"
	});
	
	sizer.bindTo( 'map', this );
	sizer.bindTo( 'position', this, 'sizer_position' );

	//wylapywanie ruchu sizer'a
	var me = this;
	google.maps.event.addListener( sizer, 'drag', function()
			{
				//ustaw promien okregu
				me.setDistance();
			});
}

//zaktualizuj srodek okregu i ustaw sizer'a na okregu
//Lokalizacja jest zwiazana z DistanceWidget wiec powinna 
//sie zmienic kiedy distance widget sie poruszy
RadiusWidget.prototype.center_changed = function()
{
	var bounds = this.get( 'bounds' );

	//granice nie zawsze moga byc ustawione wiec 
	//nalezy to sprawdzic:
	if( bounds )
		var lng = bounds.getNorthEast().lng();

	//ustaw sizer'a
	var position = new google.maps.LatLng( this.get('center').lat(), lng );
	this.set('sizer_position', position );
}



/*
 * Oblicza odleglosc miedzy dwoma latlng pozycjami [km]
 * @param {google.maps.LatLng} p1: pierwszy punkt lat lng
 * @param {google.maps.LatLng} p2: drugi punkt lat lng
 * @return {number} Odleglosc w km pomiedzy punktami
 */
RadiusWidget.prototype.distanceBetweenPoints_ = function(p1, p2)
{
	if( !p1 || !p2 )
		return 0;
	//skomplikowane liczenie prawdopodobnie dlugosci
	//krzywej polozonej na Ziemii, bedacej rzeczywista
	//odlegloscia na powierzchni Ziemii pomiedzy dwoma
	//punktami
	
	var EarthRadius = 6371 // [km]
	var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
	var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
	var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
		Math.sin(dLon / 2) * Math.sin(dLon / 2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = EarthRadius * c;
	return d;
};

//ustaw promien okregu na podstawie polozenia sizer'a
RadiusWidget.prototype.setDistance = function()
{
	/*
	 * Gdy sizer jest przesuwany, jego polozenie sie zmienia
	 * poniewaz RadiusWidget'a sizer_position jest zwiazany
	 * z position sizer'a, on rowniez sie zmieni
	 */
	var pos = this.get( 'sizer_position');
	var center = this.get( 'center');
	var distance = this.distanceBetweenPoints_( center, pos );

	//ustaw odleglosc/promien dla wszystkich objektow zwiazanych
	//z z nia
	this.set( 'distance', distance );
};




