<?php
snippet( 'header' );
echo '<section id="shelf" class="list">';
	$authors = $pages->find( 'authors' )->children()->visible()->sortBy( 'surname', 'asc' );
	foreach( $authors as $author ) {
		$surname = $author->surname();
		$firstname = $author->firstname();
		if( !$author->firstname()->empty() && !$author->surname()->empty() ) {
			echo '<div class="author item">';
			  echo '<a href="' . $author->url() . '">';
			    echo '<div class="inner">';
			      echo '<h1 class="name">';
			      	echo $surname . ', ' . $firstname;
			      echo '</h1>';
			    echo '</div>';  
			  echo '</a>';
			echo '</div>';
		}
	}
echo '</section>';
snippet( 'categories' );
snippet( 'footer' );
?>