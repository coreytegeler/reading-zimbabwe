<?php
echo '<div id="filter">';
	echo '<div class="inner">';
		$categories = $pages->find( 'category' )->children()->visible();
		echo '<div class="filter category select">';
			echo '<select id="category" default=null data-attr="categories">';
				echo '<option class="category" value=null>Category</option>';
				foreach( $categories as $category ) {
				  $catSlug = $category->slug();
			    $catTitle = $category->title();
			    echo '<option class="category" value="' . $catSlug . '">' . $catTitle . '</option>';
				}
			echo '</select>';
		echo '</div>';

		echo '<div class="filter decade select">';
			echo '<select id="decade" default=null data-attr="year">';
				echo '<option class="decade" value=null>Decade</option>';
				$decade = 1800;
				while( $decade < date( 'Y' ) ) {
			    echo '<option class="decade" value="' . $decade . '">' . $decade . '</option>';
			    $decade += 10;
				}
			echo '</select>';
		echo '</div>';

		echo '<div class="filter location select">';
			echo '<select id="loation" default=null data-attr="location">';
				echo '<option class="loation" value=null>Location</option>';
				echo '<option class="loation" value="africa">Africa</option>';
				echo '<option class="loation" value="europe">Europe</option>';
				echo '<option class="loation" value="north-america">North America</option>';
				echo '<option class="loation" value="asia">Asia</option>';
				echo '<option class="loation" value="australia">Australia</option>';
			echo '</select>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
