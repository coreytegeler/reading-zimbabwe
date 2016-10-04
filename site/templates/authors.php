<?php
snippet( 'header' );
echo '<section id="shelf" class="list">';
	$authors = $pages->find( 'authors' )->children()->visible()->sortBy( 'surname', 'asc' );
	foreach( $authors as $author ) {
		echo '<div class="author item">';
		  echo '<a href="' . $author->url() . '">';
		    echo '<div class="inner">';
		      echo '<h1 class="name">';
		      	echo $author->surname();
		      	if( $author->firstname() ) {
		      		echo ', ' . $author->firstname();
		      	}
		      echo '</h1>';
		    echo '</div>';  
		  echo '</a>';
		echo '</div>';
	}
echo '</section>';
snippet( 'categories' );
snippet( 'footer' );
?>