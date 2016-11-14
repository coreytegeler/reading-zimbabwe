<?php
$category = $page;
snippet( 'header' );
echo '<section id="search">';
	echo '<form action="/search/" autocomplete="off">';
		if( !isset( $query ) ) {
			$query = null;
		}
		echo '<input type="search" name="q" value="' . $query . '" placeholder="Search">';
		echo '<input type="submit" value="Search">';
	echo '</form>';
echo '</section>';
echo '<section id="shelf" class="list">';
	if( sizeof( $results ) ) {
		foreach($results as $result) {
			echo '<div class="result item">';
				echo '<a href="' . $result->url() . '">';
					echo '<div class="inner">';
						echo '<div class="title">';
							echo $result->title();
						echo '</div>';
						echo '<div class="template">';
							echo $result->intendedTemplate();
						echo '</div>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
		}
	} else {
		echo '<div class="horz">';
			if( $query ) {
				echo '<h1 class="noResults">No results for "' . $query . '".</h1>';
			} else {
				echo '<h1 class="noResults">No results.</h1>';
			}
		echo '</div>';
	}
echo '</section>';
snippet( 'footer' );
?>