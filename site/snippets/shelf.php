<section id="shelf">
<?php
$categories = $pages->find( 'categories' )->children()->visible();
if( $categories ) {
	echo '<div id="categories">';
	foreach( $categories as $category ) {
		$catSlug = $category->slug();
		$catText = $category->text()->kirbytext();
		$books = $pages->find( 'books' )->children();
		// echo sizeof( $books ) . $catSlug;
		if( sizeof( $books ) ) {
			$catTitle = $category->title();
				echo '<div class="category" data-category="' . $catSlug . '">';
					echo '<div class="title">';
						$catTitle = str_replace( ' ', '<br/>', $catTitle );
						$catTitle = str_replace( '<br/>&', ' &amp;', $catTitle );
						echo '<div class="bottom">';
							echo '<a href="' . $catSlug . '">'. $catTitle . '</a>';
							echo '<span class="readMore">Read More</span>';
						echo '</div>';
					echo  '</div>';
					echo '<div class="card">';
						echo '<div class="text">';
							echo $catText;
						echo '</div>';
					echo  '</div>';
				echo '</div>';
				foreach( $books as $book ) {
					$bookTitle = $book->title();
					$bookSlug = $book->slug();
					$bookLink = $book->url();
					$bookAuthor = $book->author();
					$endPaper = $book->files()->first();
					if($endPaper) { $endPaperUrl = $endPaper->url(); } else { $endPaperUrl = null; }
					echo '<div class="book" data-slug="' . $bookSlug . '">';
						// $width = strval(mt_rand(150, 200));
						// $height = strval($width+mt_rand($width/4, $width/2));
						$width = 160;
						$height = 230;
						echo '<a href="' . $bookLink . '" style="width:'.$width.'px; height:'.$height.'px;background-image:url(' . $endPaperUrl . ')">';
							echo '<div class="inner">';
								echo '<div class="title">' . $bookTitle . '</div>';
								if($bookAuthor) {
									echo '<span class="author">by ' . $bookAuthor . '</span>';
								}
							echo '</div>';	
						echo '</a>';
						// echo '<span class="year">' . '(1992)' . '</span>';
					echo '</div>';
				}
		}
	}
	echo '</div>';
}
?>
 </section>