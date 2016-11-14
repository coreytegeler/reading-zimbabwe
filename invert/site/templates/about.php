<?php snippet( 'header' ) ?>
<section id="about" class="intro">
<?php
$bookCount = sizeof( $pages->find('books')->children()->visible() );
$authorCount = sizeof( $pages->find('authors')->children()->visible() );
$cityCount = sizeof( $pages->find('cities')->children()->visible() );


echo '<div class="inner">';
	echo '<div class="vert">';
		echo '<div class="horz">';
			echo '<h1>READING ZIMBABWE</br><div class="beta">beta</div></h1>'; 
			echo '<div class="text">';
				echo 'This repository hosts references to ';
				echo '<a href="/books">' . $bookCount . ' books</a>';
				echo ' written by ';
				echo '<a href="/authors">' . $authorCount . ' authors</a>';
				echo ' published in ';
				echo '<a href="/books">' . $cityCount . ' cities</a>';
				echo '.';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
</section>
<?php snippet( 'footer' ) ?>