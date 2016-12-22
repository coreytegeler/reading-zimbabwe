<?php
$category = $page;
snippet( 'header' );
echo '<section id="search">';
	echo '<form action="/search/" autocomplete="off">';
		if( !isset( $query ) ) {
			$query = null;
		}
		echo '<input type="text" name="q" value="' . $query . '" placeholder="Search">';
	echo '</form>';
echo '</section>';
echo '<section id="shelf" class="list">';
	echo '<div class="authors items' . ( sizeof( $results ) ? ' columns' : '' ) . '">';
		if( sizeof( $results ) ) {
			foreach($results as $result) {
				$template = $result->intendedTemplate();
				echo '<div class="result item">';
					if( $template == 'term' ) {
						$url = $pages->find( 'lexicon' )->url();
					} else if( $template == 'symbol' ) {
						$url = $pages->find( 'about' )->url();
					} else {
						$url = $result->url();
					}
					echo '<a href="' . $url . '">';
						echo '<div class="inner">';
							echo '<div class="title">';
								echo $result->title();
							echo '</div>';
							echo '<div class="template">';
								echo $template;
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
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>