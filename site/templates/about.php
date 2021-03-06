<?php snippet( 'header' );

$symbolsPage = $pages->find('symbols');
$blocks = $page->blocks()->toStructure();
$symbols = $symbolsPage->children()->visible();
$rationale = $page->rationale()->kirbytext();

echo '<section id="blocks" class="inner blocks">';
	echo '<div class="inner">';
		echo '<h1>About</h1>';
		echo '<div class="blocks">';
			echo '<div class="block rationale">';
				echo '<div class="text">';
					echo $rationale;
				echo '</div>';
			echo '</div>';
			
			foreach( $blocks as $block ) {
				echo '<div class="block">';
					echo '<div class="text">';
						echo '<h1>' . $block->title() . '</h1>';
						echo $block->text()->kirbytext();
					echo '</div>';
				echo '</div>';
			}
	echo '</div>';
echo '</section>';
	// 	echo $rationale;
	// echo '</div>';
// 	echo '<h1>READING ZIMBABWE</br><div class="beta">beta</div></h1>'; 
// 	echo '<div class="text">';
// 		echo 'This repository hosts references to ';
// 		echo '<a href="/books">' . $booksCount . ' books</a>';
// 		echo ' books written by ';
// 		echo '<a href="/authors">' . $authorsCount . ' authors</a>';
// 		echo ' authors published in ';
// 		echo '<a href="/books?sort=location">' . $citiesCount . ' cities</a>';
// 		echo ' cities by ';
// 		echo '<a href="/books?sort=publisher">' . $publishersCount . ' publishers</a>';
// 		echo '.';

// 		$blackAuthorCount = 0;
// 		$whiteAuthorCount = 0;
// 		foreach( $books as $book ) {
// 			$authorsArray = $book->author()->split(',');
// 			foreach( $authorsArray as $author ) {
// 				$author = $pages->find( 'authors' )->children()->find( $author );
// 				if( $author && $race = $author->race() ) {
// 					if( $race == 'white' ) {
// 						$whiteAuthorCount++;
// 					} else if( $race == 'black' ) {
// 						$blackAuthorCount++;
// 					}
// 				}
// 			}
// 		}
// 		// echo '</br></br>Black authors have written ' . $blackAuthorCount . ' of the books on the list, ' . $whiteAuthorCount . ' are written by white authors';

// 	echo '</div>';
// echo '</div>';
// echo '</section>';
// echo '<section id="blocks" class="intro">';

// echo '<section id="stats" class="intro">';
// 	echo '<div class="blocks">';
// 		echo '<div class="block">';
// 			echo '<h4>Black</h4>';
// 			for( $i = 0; $i < 129; $i++ ) {
// 				echo '<div class="book"></div>';
// 			}
// 		echo '</div>';
// 		echo '<div class="block">';
// 			echo '<h4>White</h4>';
// 			for( $i = 0; $i < 234; $i++ ) {
// 				echo '<div class="book"></div>';
// 			}
// 		echo '</div>';
// 		echo '<div class="block">';
// 			echo '<h4>Male</h4>';
// 			for( $i = 0; $i < 400; $i++ ) {
// 				echo '<div class="book"></div>';
// 			}
// 		echo '</div>';
// 		echo '<div class="block">';
// 			echo '<h4>Female</h4>';
// 			for( $i = 0; $i < 89; $i++ ) {
// 				echo '<div class="book"></div>';
// 			}
// 		echo '</div>';
// 		foreach( $countries as $country ) {
// 			echo '<div class="block">';
// 				echo '<h4>' . $country->title() . '</h4>';
// 				$authorsFromCountry = $authors->filterBy( 'country', $country->slug(), ',' );
// 				foreach( $authorsFromCountry as $author ) {
// 					$booksByAuthor = $books->filterBy( 'author', $author->slug() );
// 					foreach( $booksByAuthor as $author ) {
// 						echo '<div class="book"></div>';
// 					}
// 				}
// 			echo '</div>';
// 		}
// 	echo '</div>';
// echo '</section>';

// echo '<section id="glossary" class="intro">';
// 	echo '<div class="group symbols">';
// 		echo '<div class="row">';
			
// 			echo '<div class="name">';
				
// 			echo '</div>';
// 			echo '<div class="note">';
// 				echo '<h3>Symbols</h3>';
// 				echo '<div class="text">' . $symbolsPage->note()->kirbytext() . '</div>';
// 			echo '</div>';		
// 		echo '</div>';
// 		foreach( $symbols as $i => $symbol ) {
// 			$light = $symbol->light();
// 			if($light) {
// 				echo '<div class="row">';
// 					echo '<div class="name">';
// 						echo '<div class="icon" style="background-image:url(' . $light->toFile()->url() . ')">';
// 							echo $light->toFile()->read();
// 						echo '</div>';
// 						echo '<div class="caption">' . $symbol->title() . '</div>';
// 					echo '</div>';
// 					echo '<div class="definition">' . $symbol->definition() . '</div>';
// 				echo '</div>';
// 			}
// 		}
// 	echo '</div>';
// echo '</section>';
snippet( 'footer' );
?>