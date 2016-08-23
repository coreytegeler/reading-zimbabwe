<section id="masonry">
<?php
$categories = $pages->find( 'categories' )->children()->visible();
if( $categories ) {
	echo '<div id="categories">';
	foreach( $categories as $catPath => $category ) {
		$catSlug = $category->slug();
		$books = $pages->find( 'books' )->children();
		// echo sizeof( $books ) . $catSlug;
		if( sizeof( $books ) ) {
			$catTitle = $category->title();
			echo '<div class="books" data-category="' . $catSlug . '">';
				echo '<div class="title tile">';
					echo '<div>';
						echo '<a href="' . $catPath . '">'. $catTitle . '</a>';
					echo  '</div>';
				echo  '</div>';
				foreach( $books as $book ) {
					$bookTitle = $book->title();
					$bookSlug = $book->slug();
					$width = strval(mt_rand(100, 300));
					$height = strval($width+mt_rand($width/4, $width/2));
					echo '<div class="book tile" data-slug="' . $bookSlug . '" style="width:'.$width.'px; height:'.$height.'px;">';
						echo '<a href="' . $bookSlug . '">';
						echo '<div class="img"></div>';
						echo '</a>';
						// echo '<span class="year">' . '(1992)' . '</span>';
					echo '</div>';
				}
			echo '</div>';
		}
	}
	echo '</div>';
}
?>
 </section>