<?php
echo '<div id="filter">';
	echo '<div class="tabs dummy">';
		echo '<div class="inner hide">';
			echo '<div class="vert">';
				echo '<div class="tab filter button" data-slug="decade"><span>Decade</span></div>';
				echo '<div class="tab filter button" data-slug="location"><span>Location</span></div>';
				echo '<div class="tab view button">View</div>';
			echo '</div>';
		echo '</div>';
		echo '<div id="filterButtons" class="tabs real">';
			echo '<div class="inner">';
				echo '<div class="vert">';
					echo '<div class="tab filter button" data-slug="decade"><span>Decade</span></div>';
					echo '<div class="tab filter button" data-slug="location"><span>Location</span></div>';
					echo '<div class="tab view button">View</div>';
				echo '</div>';
			echo '</div>';
			echo '<div id="filterLists" class="pages">';
				echo '<div class="inner">';
					echo '<div class="page filterList decade" data-type="year">';
						echo '<div class="filters">';
							echo '<div class="vert">';
								$start = date( 'Y' );
								$end = 1950;
								$decade = floor( $start/10 ) * 10;
								while( $decade >= $end  ) {
							    echo '<div class="filter decade" data-slug="' . $decade . 's">';
							    	echo '<a href="?decade=' . $decade . 's" data-slug="' . $decade . 's">';
								    	echo $decade . 's';
								    echo '</a>';
							    echo '</div>';
							    $decade -= 10;
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';

					// $publishers = $pages->find( 'publishers' )->children()->visible();
					// echo '<div class="page filterList publisher" data-type="year">';
					// 	echo '<div class="filters">';
					// 		foreach( $publishers as $publisher ) {
					// 		  $pubSlug = $publisher->slug();
					// 	    $pubTitle = $publisher->title();
					// 	    echo '<div class="filter publisher">';
					// 	    	echo '<a href="/?publisher=' . $pubSlug . '" data-slug="' . $pubSlug . '">';
					// 		    	echo $pubTitle;
					// 		    echo '</a>';
					// 	    echo '</div>';
					// 		}
					// 	echo '</div>';
					// echo '</div>';

					$regionsJson = (object) array (
				    'africa' => array(),
				    'europe' => array(),
				    'north-america' => array(),
				    'asia' => array(),
				    'australia' => array()
				  );
				  $cities = $pages->find( 'cities' )->children()->visible();
					foreach($cities as $city) {
						$region = (string)$city->region();
						$title = (string)$city->title();
						$slug = (string)$city->slug();
						if( $region && $title ) {
							$regionArray = array($slug, $title);
							$regionsJson->{$region}[] = $regionArray;
						}
					}
					echo '<script type="text/javascript">';
						echo 'var allRegions = ' . json_encode( $regionsJson ) . ';';
					echo '</script>';


					function styleLabel( $label ) {
						switch( $label ) {
							case 'africa':
								return 'Africa';
							case 'europe':
								return 'Europe';
							case 'north-america':
								return 'North America';
							case 'asia':
								return 'Asia';
							case 'australia':
								return 'Australia';
							default:
								return $label;
						};
					};

					echo '<div class="page filterList location" data-type="location">';
						echo '<div class="filters">';
							echo '<div class="vert">';
								echo '<div class="filter location" data-slug="africa">';
									echo '<a href="?location=africa" data-slug="africa">';
										echo '<div class="title">Africa</div>';
									echo '</a>';
								echo '</div>';
								echo '<div class="filter location" data-slug="europe">';
									echo '<a href="?location=europe" data-slug="europe">';
										echo '<div class="title">Europe</div>';
									echo '</a>';
								echo '</div>';
								echo '<div class="filter location" data-slug="north-america">';
									echo '<a href="?location=north-america" data-slug="north-america">';
										echo '<div class="title">North America</div>';
									echo '</a>';
								echo '</div>';
								echo '<div class="filter location" data-slug="asia">';
									echo '<a href="?location=asia" data-slug="asia">';
										echo '<div class="title">Asia</div>';
									echo '</a>';
								echo '</div>';
								echo '<div class="filter location" data-slug="australia">';
									echo '<a href="?location=australia" data-slug="australia">';
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
echo '</div>';
?>
