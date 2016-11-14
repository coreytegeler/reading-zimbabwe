<?php
echo '<section id="shelf" class="grid">';
	if( isset( $value ) && is_array( $value ) ) {
		echo '<h3>Related Books</h3>';
	}
	echo '<div class="books">';
		$books = $pages->find( 'books' )->children()->visible();
		if( isset( $hidden ) ) {
			$books->not( $hidden );
		}
		$booksArray = [];
		if( isset( $type ) && isset( $value ) ) {
			if( is_array( $value ) ) {
				foreach( $value as $val ) {
					$filteredBooks = $books->filterBy( $type, $val, ',' );
					foreach( $filteredBooks as $filteredBook ) {
						array_push( $booksArray, $filteredBook );
					}
				}
			} else {
				$filteredBooks = $books->filterBy( $type, $value, ',' );
				foreach( $filteredBooks as $filteredBook ) {
					array_push( $booksArray, $filteredBook );
				}
			}
			shuffle( $booksArray );
			if( isset( $max ) ) {
				$booksArray = array_splice( $booksArray, 0, $max );
			}
		} else {
			foreach( $books as $book ) {
				array_push( $booksArray, $book );
			}
		}
		$index = 0;
		foreach( $booksArray as $book ) {
			snippet( 'book', array( 'book' => $book->slug(), 'index' => $index ) );
			$index++;
		}
	echo '</div>';
echo '</section>';
?>