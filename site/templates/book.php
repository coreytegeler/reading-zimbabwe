<?php
$title = $page->title();
$cover = $page->files()->first();
$author = $page->author();
$title = $page->title();
$synopsis = $page->synopsis();
$year = $page->year();
snippet( 'header' );
echo '<main class="book single">';
	echo '<section id="book">';
		echo '<div class="spread">';
			echo '<div class="page first">';
				echo '<div class="inner">';
					echo '<header>';
						echo '<h1>' . $title . '</h1>';
					echo '</header>';
					echo '<div class="rule"></div>';
					echo '<div class="author">';
						echo $author;
					echo '</div>';
					echo '<div class="year">';
						echo $year;
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
					echo '<div class="synopsis">';
						echo $synopsis;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="page text">';
				echo '<div class="inner">';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>';
	echo '<aside>';

	echo '</aside>';
echo '</main>';
snippet( 'footer' )
?>