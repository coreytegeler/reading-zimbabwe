<?php
echo '<section id="shelf" class="shelf">';
	echo '<div class="middle">';
		echo '<div class="horz">';
			echo '<div class="books">';
				
				$books = $pages->find( 'books' )->children();
				if( !isset( $hidden ) ) { $hidden = ''; }
				foreach( $books as $book ) {
					snippet( 'book', array( 'book' => $book ) );
				}
				
			echo '</div>';
		echo '</div>';
	echo '</div>';
	snippet( 'filter' );
echo '</section>';
?>