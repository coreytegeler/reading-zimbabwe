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
echo '<main class="book single">';
	echo '<section id="title">';
		echo '<h1>' . $title . '</h1>';
		echo '<div class="author">';
			echo $author;
		echo '</div>';
	echo '</section>';
	echo '<section id="book" class="folder">';
		echo '<div id="content">';
			echo '<div class="tabs dummy">';
				echo '<div class="inner hide">';
					echo '<div class="tab"><span>Information</span></div>';
					echo '<div class="tab"><span>Suggested Books</span></div>';
				echo '</div>';
				echo '<div class="tabs real">';
					echo '<div class="inner">';
						echo '<div class="tab selected" data-type="info"><span>Information</span></div>';
						echo '<div class="tab" data-type="suggested"><span>Suggested Books</span></div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="pages">';
				echo '<div class="page info show" data-type="info">';
					echo '<div class="content">';
						echo '<h2>Synopsis</h2>';
						echo '<div class="text">';
							echo $synopsis;
						echo '</div>';
						echo '<h2>Editorial Review</h2>';
						echo '<div class="text">';
							echo $review;
						echo '</div>';
						echo '<h2>About the Author</h2>';
						echo '<div class="text">';
							echo $aboutAuthor;
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="page suggested" data-type="suggested">';
					echo '<section id="shelf" class="shelf folder">';
						echo '<div class="books">';
							$books = $pages->find( 'books' )->children();
							if( !isset( $hidden ) ) { $hidden = ''; }
							foreach( $books as $book ) {
								snippet( 'book', array( 'book' => $book ) );
							}
						echo '</div>';
					echo '</section>';
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
		
	}
	snippet( 'sections/categories', array( 'class' => 'invert' ) );
echo '</main>';
snippet( 'footer' )
?>