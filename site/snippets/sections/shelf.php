<section id="shelf" class="shelf">
	<div class="horz">
		<div class="books">
			<?php
			$books = $pages->find( 'books' )->children();
			if( sizeof( $books ) >= 1 ) {
				foreach( $books as $book ) {
					if( isset( $category ) ){
						$categories = $book->category()->split( ',' );
						if(  in_array( $category, $categories ) ) {
							snippet( 'book', array( 'book' => $book ) );
						}
					} else {
						snippet( 'book', array( 'book' => $book ) );
					}
				}
			}
			?>
		</div>
	</div>
</section>