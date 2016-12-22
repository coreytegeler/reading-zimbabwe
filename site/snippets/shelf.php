<?php
if( !isset( $view ) ) {
	$view = 'covers';
}
$books = $pages->find( 'books' )->children()->visible();

$decade = param( 'decade' );
$location = param( 'location' );
$motif = param( 'motif' );

if( $decade ) {
	$books = $books->sortBy( 'year', 'asc' );
	$books = $books->filter( function( $book ) {
		$decade = param( 'decade' );
		$year = (int) (string) $book->year();
		if( $year ) {
		  return $year >= $decade && $year < $decade + 10;
		}
		return false;
	});
} else if( $location ) {
	$books = $books->sortBy( 'city', 'asc' );
	$books = $books->filter( function( $book ) {
		$location = param( 'location' );
		$city = (string) $book->city();
		if( $city ) {
		  $cityPage = $region = page( 'cities' )->children()->visible()->find( $city );
		  if( $cityPage && $cityPage->region() == $location ) {
		  	return true;
		  }
		}
		return false;
	});
} else if( $motif ) {
	$books = $books->sortBy( 'motif', 'asc' );
	$books = $books->filter( function( $book ) {
		$motif = param( 'motif' );
		$thisMotif = $book->motif();
		if( $motif == $thisMotif ) {
			return true;
		} else if( $motif == 'other' && $book->motif()->empty() ) {
			return true;
		}
		return false;
	});
}
$pageNumber = 1;
if( isset( $paginate ) ) {
	$books = $books->paginate(60);
	if($books->pagination()->hasPages()) {
		$pageNumber = $books->pagination()->page();
		if($books->pagination()->hasPrevPage()) {
		  $prevPage = $books->pagination()->prevPageURL();
	  }
	  if($books->pagination()->hasNextPage()) {
		  $nextPage = $books->pagination()->nextPageURL();
	  }
	}
}
if( isset( $hidden ) ) {
	$books = $books->not( $hidden );
}

$booksArray = [];
if( isset( $type ) && isset( $value ) ) {
	if( is_array( $value ) ) {
		foreach( $value as $val ) {
			$filteredBooks = $books->filterBy( $type, $val, ',' );
			foreach( $filteredBooks as $filteredBook ) {
				array_push( $booksArray, $filteredBook );
			}
		}
	} else {
		$filteredBooks = $books->filterBy( $type, $value, ',' );
		foreach( $filteredBooks as $filteredBook ) {
			array_push( $booksArray, $filteredBook );
		}
	}
	if( isset( $max ) ) {
		$booksArray = array_splice( $booksArray, 0, $max );
	}
} else {
	foreach( $books as $book ) {
		array_push( $booksArray, $book );
	}
}
$index = 0;
$lastLabel = '';
$lastSublabel = '';

if( sizeof( $booksArray ) ) {
	echo '<section id="shelf" class="' . $view . '" data-view="' . $view . '" data-page="' . $pageNumber . '">';
		echo '<div id="shelfInner" class="inner">';
			if( isset( $title ) ) {
				echo '<h3>' . $title . '</h3>';
			}
			echo '<div class="books columns">';
				
				foreach( $booksArray as $book ) {
					if( $decade ) {
						$sublabel = (string) $book->year();
					} else if( $location ) {
						$subPage = page( 'cities' )->children()->visible()->find( $book->city() );
						$sublabel = $subPage->title();
					}
					if( isset( $sublabel ) && $sublabel != $lastSublabel ) {
						$lastSublabel = $sublabel;
						echo '<div class="sublabel">' . $sublabel . '</div>';
					}
					snippet( 'book', array( 'book' => $book->slug(), 'index' => $index ) );
					$index++;
				}
			echo '</div>';

			echo '<div class="pagination">';
			if( isset( $prevPage ) ) {
				echo '<a class="prev" href="' . $prevPage . '">Previous</a>';
			}
			if( isset( $nextPage ) ) {
				echo '<a class="next" href="' . $nextPage . '">Next</a>';
			}
			echo '</div>';
		echo '</div>';
	echo '</section>';
}
?>