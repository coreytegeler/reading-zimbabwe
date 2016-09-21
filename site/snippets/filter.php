<?php
echo '<div id="filterButtons" class="tabs">';
	echo '<div class="inner">';
		echo '<div class="tab filterButton" data-type="category"><span>Category</span></div>';
		echo '<div class="tab filterButton" data-type="decade"><span>Decade</span></div>';
		echo '<div class="tab filterButton" data-type="location"><span>Location</span></div>';
	echo '</div>';
echo '</div>';
echo '<div id="filterLists" class="pages">';
	echo '<div class="inner">';
		$categories = $pages->find( 'category' )->children()->visible();
		echo '<div class="page filterList category" data-type="category">';
			echo '<div class="bricks pattern">';
				foreach( $categories as $category ) {
				  $catSlug = $category->slug();
			    $catTitle = $category->title();
			    echo '<div class="brick category">';
				    echo '<a href="/?category=' . $catSlug . '" data-slug="' . $catSlug . '">';
					    echo $catTitle;
					   echo '</a>';
			    echo '</div>';
				}
			echo '</div>';
		echo '</div>';

		echo '<div class="page filterList decade" data-type="year">';
			echo '<div class="bricks pattern">';
				$decade = 1800;
				while( $decade < date( 'Y' ) ) {
			    echo '<div class="brick decade">';
			    	echo '<a href="/?decade=' . $decade . '" data-slug="' . $decade . '">';
				    	echo $decade;
				    echo '</a>';
			    echo '</div>';
			    $decade += 10;
				}
			echo '</div>';
		echo '</div>';

		echo '<div class="page filterList location" data-type="location">';
			echo '<div class="bricks pattern">';
				echo '<div class="brick location">';
					echo '<a href="/?location=africa" data-slug="africa">';
						echo 'Africa';
					echo '</a>';
				echo '</div>';
				echo '<div class="brick location" value="europe">';
					echo '<a href="/?location=europe" data-slug="europe">';
						echo 'Europe';
					echo '</a>';
				echo '</div>';
				echo '<div class="brick location" value="north-america">';
					echo '<a href="/?location=north-america" data-slug="north-america">';
						echo 'North America';
					echo '</a>';
				echo '</div>';
				echo '<div class="brick location" value="asia">';
					echo '<a href="/?location=asia" data-slug="asia">';
						echo 'Asia';
					echo '</a>';
				echo '</div>';
				echo '<div class="brick location" value="australia">';
					echo '<a href="/?location=australia" data-slug="australia">';
						echo 'Australia';
					echo '</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
