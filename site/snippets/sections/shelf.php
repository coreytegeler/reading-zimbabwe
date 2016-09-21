<?php
echo '<section id="shelf" class="shelf folder">';
	snippet( 'filter' );
	echo '<div class="books">';
		$books = $pages->find( 'books' )->children();
		if( !isset( $hidden ) ) { $hidden = ''; }
		foreach( $books as $book ) {
			snippet( 'book', array( 'book' => $book ) );
		}
	echo '</div>';
echo '</section>';
?>