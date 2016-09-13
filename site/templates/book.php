<?php
$title = $page->title();
$author = $page->author();
$language = $page->language();
$publisher = $page->publisher();
$category = $page->category();
$synopsis = $page->synopsis();
$review = $page->review();
$aboutAuthor = $page->aboutAuthor();
$year = $page->year();
$files = $page->files();
if($files->first()) {
	$cover = $files->first()->url();
} else {
	$cover = false;
}
$isbnX = $page->isbnX();
$isbnXIII = $page->isbnXIII();
snippet( 'header' );
echo '<main class="book single">';
	echo '<section id="book">';
		echo '<div class="spread">';
			echo '<div class="page first">';
				echo '<div class="inner">';
					echo '<div class="title">';
						echo '<h1>' . $title . '</h1>';
					echo '</div>';
					echo '<div class="rule"></div>';
					echo '<div class="author">';
						echo $author;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="page meta">';
				echo '<div class="inner">';
					snippet( 'meta' );
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="spread">';
			echo '<div class="page text">';
				echo '<div class="inner">';
					echo '<div class="synopsis chapter">';
						echo '<div class="title">Synopsis</div>';
						echo '<div class="rule"></div>';
						echo '<div class="text">';
							echo $synopsis;
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="page text">';
				echo '<div class="inner">';
					echo '<div class="review chapter">';
						echo '<div class="title">Editorial Review</div>';
						echo '<div class="rule"></div>';
						echo '<div class="text">';
							echo $review;
						echo '</div>';
					echo '</div>';
					echo '<div class="aboutAuthor chapter">';
						echo '<div class="title">About the Author</div>';
						echo '<div class="rule"></div>';
						echo '<div class="text">';
							echo $aboutAuthor;
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>';
	echo '<aside>';
	echo '<div class="group">';
		echo '<div class="category">';
			echo 'CATEGORY:</br>';
			echo $category;
		echo '</div>';
	echo '</div>';
	echo '<div class="group">';
		if($publisher) {
			echo '<div class="publisher">';
				echo 'PUBLISHER: ' . $publisher;
			echo '</div>';
		}
		if($year) {
			echo '<div class="year">';
				echo 'YEAR PUBLISHED: ' . $year;
			echo '</div>';
		}
		if($language) {
			echo '<div class="language">';
				echo 'LANGUAGE: ' . $language;
			echo '</div>';
		}
		if($isbnX) {
			echo '<div class="isbn10">';
				echo 'ISBN10: ' . $isbnX;
			echo '</div>';
		}
		if($isbnXIII) {
			echo '<div class="isbn13">';
				echo 'ISBN13: ' . $isbnXIII;
			echo '</div>';
		}
	echo '</div>';
	if($cover) {
		echo '<div class="group cover">';
			echo '<img src="' . $cover . '">';
		echo '</div>';
	}
echo '</aside>';
echo '</main>';
echo '<section id="shelf" class="shelf">';
	echo '<div class="category"><div class="title"><div class="bottom">Related books</div></div></div>';
	$relatedBooks = $pages->find('books')->children()->visible();
	foreach( $relatedBooks as $book ) {
		snippet( 'book', array('book' => $book) );
	}
echo '</section>';	

snippet( 'footer' )
?>