<section id="paragraph">
<?php
$categories = $pages->find( 'categories' )->children()->visible();
if( $categories ) {
	echo '<ol id="categories">';
	foreach( $categories as $catPath => $category ) {
		$catSlug = $category->slug();
		$books = $pages->find( 'books' )->children();
		// echo sizeof( $books ) . $catSlug;
		if( sizeof( $books ) ) {
			$catTitle = $category->title();
			echo '<li class="category" data-slug="' . $catSlug . '">';
				echo '<a class="title" href="' . $catPath . '">' . $catTitle . '</a>';
				echo '<ol class="books" data-category="' . $catSlug . '">';
					foreach( $books as $book ) {
						$bookTitle = $book->title();
						$bookSlug = $book->slug();
						echo '<li class="book" data-slug="' . $bookSlug . '">';
							echo '<a href="' . $bookSlug . '">' . $bookTitle . '</a>';
							echo '<span class="year">' . '(1992)' . '</span>';
						echo '</li>';
					}
				echo '</ol>';
			echo '</li>';
		}
	}
	echo '</ol>';
}
?>
 </section>