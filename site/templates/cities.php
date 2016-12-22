<?php
snippet( 'header' );
echo '<section id="map">';
	// $cities = page( 'cities' )->children();
	// $citiesArray = new ArrayObject(array());
	// foreach( $cities as $city ) {
	// 	if( !$city->lat()->empty() ) {
	// 		$lat = $city->lat();
	// 		$citiesArray->append( $lat );
	// 	}
	// }
	// if( sizeof( $citiesArray ) ) {
	// 	$citiesArray = json_encode( $citiesArray );
	// } else {
	// 	$citiesArray = 'null';
	// }
	echo '<script type="text/javascript">';
		echo 'var citiesArray = ' . $citiesArray . ';';
	echo '</script>';
echo '</section>';
snippet( 'footer' );
?>