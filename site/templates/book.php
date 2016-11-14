<?php
$book = $page;
$slug = $book->slug();
$title = $book->title();
$subtitle = $book->subtitle();
$authors = $book->author()->split( ',' );
$language = $book->language();
$categories = $book->category()->split(',');
$synopsis = $book->synopsis()->kirbytext();
$review = $book->review()->kirbytext();
$status = $book->status()->kirbytext();
$year = $book->year();
$isbnX = $book->isbnX();
$isbnXIII = $book->isbnXIII();
$hardCover = $book->hardCover();
$hardCoverCount = $book->hardCoverCount();
$paperBack = $book->paperBack();
$paperBackCount = $book->paperBackCount();
$eBook = $book->eBook();
$eBookCount = $book->eBookCount();
$publisher = $pages->find( 'publishers' )->children()->find( $book->publisher() );
$url = $book->url();

$files = $book->files();
if( $files->first() ) {
	$cover = $files->first()->url();
} else {
	$cover = false;
}
snippet( 'header' );
echo '<div class="patterns top">';  
  $j = 0;
  for ( $i = 0; $i < 3; $i++ ) {
    if( $j > ( sizeof( $categories ) - 1 ) ) { $j = 0; }
    $category = $categories[$j];
    $categoryPage = $pages->find( 'category' )->children()->find( $category );
    $categorySymbol = null;
    if( $categoryPage ) {
      $categorySymbol = $categoryPage->symbol();
    }
    if( !$categorySymbol || $categorySymbol == '' ) {
      $categorySymbol = 'default';
    }
    $symbolUrl = kirby()->urls()->assets() . '/images/symbols/' . $categorySymbol . '.svg';
    echo '<div class="pattern" style="background-image:url(' . $symbolUrl . ')"></div>';
    $j++;
  }
echo '</div>';
echo '<section id="book">';
	echo '<div class="title">';
		echo '<h1 class="main">' . $title . '</h1>';
		if( strlen( $subtitle ) ) {
	    echo '<h1 class="sub"> ' . $subtitle . '</h1>';
	  }
	  if( is_array( $authors ) ) {
			echo '<h4 class="author">';
				foreach( $authors as $index => $authorSlug ) {
					$author = $pages->find( 'authors' )->children()->find( $authorSlug );
					if( $author ) {
						echo '<a href="' . $author->url() . '" class="author">';
							echo $author->title();
						echo '</a>';
						if ( $index == sizeof( $authors ) - 2 ) {
							echo ' & ';
						} else if( $index < sizeof( $authors ) - 1 ) {
							echo ', ';
						}
					}
				}
			echo '</h4>';
		}
	echo '</div>';
	echo '<div id="content">';
		echo '<div class="side">';
			echo '<h3>&nbsp;</h3>';
			if( $cover ) {
				echo '<div class="cover">';
					echo '<img src="' . $cover . '">';
				echo '</div>';
			}
			echo '<ul class="meta">';
				echo '<li>';
					if( $publisher ) {
						if( sizeof( $publisher->website() ) ) {
							echo '<a href="' . $publisher->website() . '">';
								echo $publisher->title();
							echo '</a>';
						} else {
							echo $publisher->title();
						}
					} else {
						echo '<em>Unknown publisher</em>';
					}
				echo '</li>';
				echo '<li>';
					if( strlen( $book->city() ) ) {
						$city = $pages->find( 'cities' )->children()->find( $book->city() );
						if( $city ) {
							echo $city->title();
						} else {
							echo '<em>Unknown city</em>';	
						}
					} else {
						echo '<em>Unknown city</em>';
					}
				echo '</li>';
				echo '<li>';
					if( strlen( $year ) ) {
						echo $year;
					} else {
						echo '<em>Unknown year</em>';
					}
				echo '</li>';
				echo '<li>';
					if( strlen( $language ) ) {
						echo $language;
					} else {
						echo '<em>Unknown language</em>';
					}
				echo '</li>';
				if( $hardCover && $hardCoverCount != '') {
					echo '<li>Hardcover</li>';
					echo '<li>' . $hardCoverCount . ' pages</li>';
				}
				if( $paperBack && $paperBackCount != '') {
					echo '<li>Paperback</li>';
					echo '<li>' . $paperBackCount . ' pages</li>';
				}
				if( $eBook && $eBookCount != '') {
					echo '<li>eBook</li>';
					echo '<li>' . $eBookCount . ' pages</li>';
				}
				echo '<li class="share">';
					echo '<a class="twitter" href="https://twitter.com/share?url=' . urlencode( $url ) . '&text=' . urlencode( $title ) . '" target="_blank"></a>';
					echo '<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?sdk=joey&u=' . $url . '" target="_blank"></a>';
				echo '</li>';
			echo '</ul>';
			echo '<div class="share">';
				echo '<a class="twitter" href="https://twitter.com/share?url=' . urlencode( $url ) . '&text=' . urlencode( $title ) . '" target="_blank"></a>';
				echo '<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?sdk=joey&u=' . $url . '" target="_blank"></a>';
			echo '</div>';
		echo '</div>';
		echo '<div class="texts">';
			if( isset( $synopsis ) && $synopsis != '' ) {
				echo '<div class="text">';
					echo '<h3>Synopsis</h3>';
					echo $synopsis;
				echo '</div>';
			}
			if( isset( $review ) && $review != '' ) {
				echo '<div class="text">';
					echo '<h3>Review</h3>';
					echo $review;
				echo '</div>';
			}
			if( is_array( $authors ) && sizeof( $authors) ) {
				echo '<div class="text about">';
					if( sizeof( $authors) > 1 ) {
						echo '<h3>Authors</h3>';
					} else {
						echo '<h3>Author</h3>';
					}
					foreach( $authors as $index => $authorSlug ) {
						$author = $pages->find( 'authors' )->children()->find( $authorSlug );
						if( $author && !$author->empty() ) {
							echo '<div class="author">';
								// echo '<a href="' . $author->url() . '" class="author">';
								// 	echo $author->title();
								// echo '</a>';
								echo '<div>';
									echo $author->text()->kirbytext();
								echo '</div>';
							echo '</div>';
						}
					}
				echo '</div>';
			}
			if( isset( $status ) && $status != '' ) {
				echo '<div class="text status">';
					// echo '<h3>Status</h3>';
					echo '<div class="border">';
						echo $status;
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
echo '</section>';
snippet( 'shelf', array( 'type' => 'category', 'value' => $categories, 'hidden' => $slug, 'max' => 12 ) );
snippet( 'footer' );
?>