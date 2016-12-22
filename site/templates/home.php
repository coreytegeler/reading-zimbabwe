<?php snippet( 'header' ) ?>
<section id="manifesto" class="big">
<?php
$manifesto = $pages->find( 'home' )->intro()->kirbytext();
// $period = array( '. ' );
// $manifesto = str_replace( $period, '<span class="period symbol"></span>', $manifesto );
// $comma = array( ', ' );
// $manifesto = str_replace( $comma, '<span class="comma symbol"></span>', $manifesto );
// $question = array( '? ' );
// $manifesto = str_replace( $question, '<span class="question symbol"></span>', $manifesto );

$books = $pages->find('books')->children()->visible();
$authors = $pages->find('authors')->children()->visible();
$cities = $pages->find('cities')->children()->visible();
$publishers = $pages->find('publishers')->children()->visible();
$countries = $pages->find('countries')->children()->visible();
$booksCount = sizeof( $books );
$authorsCount = sizeof( $authors );
$citiesCount = sizeof( $cities );
$publishersCount = sizeof( $publishers );


echo '<div class="inner">';
	echo '<div id="rz"><div class="relative"><h1>READING ZIMBABWE</h1><div class="beta">BETA</div></div></div>'; 
	echo '<div class="text">';
		echo $manifesto;
		echo '<p>';
			echo 'This repository hosts references to ';
			echo '<a href="/books">' . $booksCount . ' books</a>';
			echo ' written by ';
			echo '<a href="/authors">' . $authorsCount . ' authors</a>';
			echo ' published in ';
			echo '<a href="/cities">' . $citiesCount . ' cities</a>';
			echo ' by ';
			echo '<a href="/publishers">' . $publishersCount . ' publishers</a>';
			echo '.';
		echo '</p>';
	echo '</div>';
echo '</div>';
?>
</section>
<?php snippet( 'footer' ) ?>