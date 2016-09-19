<?php
$book = $page;
$slug = $book->slug();
$title = $book->title();
$author = $book->author();
$language = $book->language();
$publisher = $book->publisher();
$categories = explode( ',', $book->category() );
// $category = $book->category();
$synopsis = $book->synopsis()->kirbytext();
$review = $book->review()->kirbytext();
$aboutAuthor = $book->aboutAuthor()->kirbytext();
$year = $book->year();
$files = $book->files();
$isbnX = $book->isbnX();
$isbnXIII = $book->isbnXIII();
if($files->first()) {
	$cover = $files->first()->url();
} else {
	$cover = false;
}
snippet( 'header' );
echo '<main class="book single pattern">';
	echo '<section id="book">';
		echo '<div class="inner">';
			echo '<h1>' . $title . '</h1>';
			echo '<div class="author">';
				echo $author;
			echo '</div>';
			echo '<div class="synopsis group">';
				echo '<h2>Synopsis</h2>';
				echo '<div class="text">';
					echo $synopsis;
				echo '</div>';
			echo '</div>';
			echo '<div class="review group">';
				echo '<h2>Editorial Review</h2>';
				echo '<div class="text">';
					echo $review;
				echo '</div>';
			echo '</div>';
			echo '<div class="aboutAuthor group">';
				echo '<h2>About the Author</h2>';
				echo '<div class="text">';
					echo $aboutAuthor;
				echo '</div>';
			echo '</div>';
		echo '</div>';
		// echo '<aside class="border">';
		// 	echo '<div class="inner">';
		// 		echo '<div class="group">';
		// 			snippet( 'meta' );
		// 		echo '</div>';
		// 	echo '</div>';
		// echo '</aside>';
	echo '</section>';
	if( sizeof( $categories ) > 1 ) {
		foreach( $categories as $category ) {
			// snippet( 'sections/shelf', array( 'category' => $category, 'hidden' => $slug ) );
		}
	} else {
		snippet( 'sections/shelf', array( 'category' => $categories, 'hidden' => $slug ) );
	}
	snippet( 'sections/categories' );
echo '</main>';
snippet( 'footer' )
?>