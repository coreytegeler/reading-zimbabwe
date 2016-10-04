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
echo '</section>';
// snippet( 'categories' );
snippet( 'footer' );
?>