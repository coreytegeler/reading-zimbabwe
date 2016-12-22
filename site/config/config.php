<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set( 'license', 'put your license key here' );
c::set( 'autopublish.templates', array(
	'book', 'category', 'author', 'city', 'symbol', 'term', 'publisher'
));
ini_set('memory_limit', '128M');
c::set( 'scssNestedCheck', true );
c::set( 'cache.ignore', array( 'sitemap' ) );


kirby()->hook(['panel.page.create', 'panel.page.update'], 'geocodeCheck');

function geocodeCheck( $page ) {
	if( $page->intendedTemplate() == 'city' ) {
		if( $page->lat()->empty() || $page->lng()->empty() ) {
	  	geocode( $page );
	  }
	}
}

function geocode( $city ) {
	$title = $city->title();
	$region = str_replace( '-', ' ', $city->region() );
	$address = $title . ' ' . $region;
	$address = urlencode( $address );
  $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
  try {
	 	$resp_json = file_get_contents( $url );
	  $resp = json_decode( $resp_json, true );
	  if( $resp['status']=='OK' ){
		  $lat = $resp['results'][0]['geometry']['location']['lat'];
		  $lng = $resp['results'][0]['geometry']['location']['lng'];
			try {
		    $city->update( array(
		      'lat' => $lat,
		      'lng' => $lng
		    ) );
		  } catch (Exception $e) {
		    echo $e->getMessage();
		  }
		}
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



// $geocode=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".$_GET['q']."&sensor=false");
// $output= json_decode($geocode);
// $lat = $output->results[0]->geometry->location->lat;
// $lng = $output->results[0]->geometry->location->lng;
/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/