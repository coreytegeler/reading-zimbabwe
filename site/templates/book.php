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
	echo '</section>';
	echo '<section id="book" class="folder">';
		echo '<div id="content">';
			echo '<div class="tabs">';
				echo '<div class="inner">';
					echo '<div class="tab selected" data-type="first"><span>First Page</span></div>';
					echo '<div class="tab" data-type="synopsis"><span>Synopsis</span></div>';
					echo '<div class="tab" data-type="review"><span>Review</span></div>';
					echo '<div class="tab" data-type="author"><span>About the Author</span></div>';
					echo '<div class="tab" data-type="suggested"><span>Suggested Books</span></div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="pages">';
				echo '<div class="page first show" data-type="first">';
					echo '<div class="content">';
						echo '<div class="author">';
							echo $author;
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="page synopsis" data-type="synopsis">';
					echo '<div class="content">';
						echo '<h2>Synopsis</h2>';
						echo '<div class="text">';
							echo $synopsis;
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="page review" data-type="review">';
					echo '<div class="content">';
						echo '<h2>Editorial Review</h2>';
						echo '<div class="text">';
							echo $review;
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="page author" data-type="author">';
					echo '<div class="content">';
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