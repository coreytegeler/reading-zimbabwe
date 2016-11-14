<?php
snippet( 'header' );
echo '<section id="shelf" class="list intro">';
	echo '<div class="inner">';
		echo '<h1>' . $page->title() . '</h1>';
		$authors = $pages->find( 'authors' )->children()->visible()->sortBy( 'surname', 'asc' );
		foreach( $authors as $author ) {
			$surname = $author->surname();
			$firstname = $author->firstname();
			if( !$author->firstname()->empty() && !$author->surname()->empty() ) {
				echo '<div class="author item">';
				  echo '<a href="' . $author->url() . '">';
			      echo '<h3 class="name">';
			      	echo $surname . ', ' . $firstname;
			      echo '</h3>';
				  echo '</a>';
				echo '</div>';
			}
		}
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>