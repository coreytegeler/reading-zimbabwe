<?php
$decadeParam = param( 'decade' );
$locationParam = param( 'location' );
$motifParam = param( 'motif' );

echo '<div id="filter">';
	echo '<div id="filterTabs" class="tabs">';
		echo '<div id="filterTabsInner" class="inner">';
			echo '<div class="vert">';
				echo '<div class="tab" data-slug="decade"><span>Decade</span></div>';
				echo '<div class="tab" data-slug="location"><span>Location</span></div>';
				echo '<div class="tab" data-slug="motif"><span>Motifs</span></div>';
				echo '<div class="tab view">View</div>';
			echo '</div>';
		echo '</div>';
		echo '<div id="filterLists" class="pages">';
			echo '<div class="inner">';
				echo '<div class="page filterList decade" data-type="year">';
					echo '<div class="filters">';
						echo '<div class="vert">';
							$start = 1950;
							$end = date( 'Y' );
							$decade = floor( $start/10 ) * 10;
							while( $decade <= $end  ) {
						    echo '<div class="filter decade' . ( $decadeParam == $decade ? ' selected' : '') . '" data-slug="' . $decade . '">';
						    	echo '<a href="' . $page->url() . '/decade:' . $decade . '" data-slug="' . $decade . '">';
							    	echo $decade . 's';
							    echo '</a>';
						    echo '</div>';
						    $decade += 10;
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';

				$motifs = page( 'motifs' )->children()->visible()->sortBy( 'title', 'asc' );
				$motifsJson = (object) array();
				echo '<div class="page filterList motif" data-type="motif">';
					echo '<div class="filters">';
						echo '<div class="vert">';
							foreach( $motifs as $motif ) {
								$motif = page( $motif );
								$motifSlug = (string)$motif->slug();
								$motifTitle = (string)$motif->title();
								$motifArray = array( $motifSlug, $motifTitle );
								// $motifsJson->{$motifSlug} = $motifArray;
								$motifsJson->{$motifSlug}[] = $motifArray;
						    echo '<div class="filter motif' . ( $motifParam == $motifSlug ? ' selected' : '') . '" data-slug="' . $motifSlug . '">';
						    	echo '<a href="' . $page->url() . '/motif:' . urlencode( $motifSlug ) . '" data-slug="' . $motifSlug . '">';
							    	echo $motifTitle;
							    echo '</a>';
						    echo '</div>';
							}
							$motifsJson->{'other'}[] = array('other', 'Other');
							echo '<div class="filter motif' . ( $motifParam == 'other' ? ' selected' : '') . '" data-slug="other">';
					    	echo '<a href="' . $page->url() . '/motif:other" data-slug="other">Other</a>';
					    echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				// $regionsJson = (object) array (
			 //    'africa' => array(),
			 //    'europe' => array(),
			 //    'north-america' => array(),
			 //    'asia' => array(),
			 //    'australia' => array()
			 //  );

			 //  $cities = $pages->find( 'cities' )->children()->visible();
				// foreach($cities as $city) {
				// 	$region = (string)$city->region();
				// 	$title = (string)$city->title();
				// 	$slug = (string)$city->slug();
				// 	if( $region && $title ) {
				// 		$regionArray = array($slug, $title);
				// 		// $regionsJson->{$region}[] = $regionArray;
				// 	}
				// }
				// echo '<script type="text/javascript">';
				// 	if( $regionsJson ) {					
				// 		echo 'var allRegions = ' . json_encode( $regionsJson ) . '; ';
				// 	}
				// 	if( $motifsJson ) {
				// 		echo 'var allMotifs = ' . json_encode( $motifsJson ) . '; ';
				// 	}
				// echo '</script>';


				// function styleLabel( $label ) {
				// 	switch( $label ) {
				// 		case 'africa':
				// 			return 'Africa';
				// 		case 'europe':
				// 			return 'Europe';
				// 		case 'north-america':
				// 			return 'North America';
				// 		case 'asia':
				// 			return 'Asia';
				// 		case 'australia':
				// 			return 'Australia';
				// 		default:
				// 			return $label;
				// 	};
				// };

				echo '<div class="page filterList location" data-type="location">';
					echo '<div class="filters">';
						echo '<div class="vert">';
							echo '<div class="filter location' . ( $locationParam == 'africa' ? ' selected' : '') . '" data-slug="africa">';
								echo '<a href="' . $page->url() . '/location:africa" data-slug="africa">';
									echo '<div class="title">Africa</div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="filter location' . ( $locationParam == 'europe' ? ' selected' : '') . '" data-slug="europe">';
								echo '<a href="' . $page->url() . '/location:europe" data-slug="europe">';
									echo '<div class="title">Europe</div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="filter location' . ( $locationParam == 'north-america' ? ' selected' : '') . '" data-slug="north-america">';
								echo '<a href="' . $page->url() . '/location:north-america" data-slug="north-america">';
									echo '<div class="title">North America</div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="filter location' . ( $locationParam == 'asia' ? ' selected' : '') . '" data-slug="asia">';
								echo '<a href="' . $page->url() . '/location:asia" data-slug="asia">';
									echo '<div class="title">Asia</div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="filter location' . ( $locationParam == 'australia' ? ' selected' : '') . '" data-slug="australia">';
								echo '<a href="' . $page->url() . '/location:australia" data-slug="australia">';
									echo '<div class="title">Australia</div>';
								echo '</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
