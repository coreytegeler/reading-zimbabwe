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
$publisher = $pages->find( 'publishers' )->children()->find( $book->publisher() );

$files = $book->files();
if( $files->first() ) {
	$cover = $files->first()->url();
} else {
	$cover = false;
}
snippet( 'header' );
echo '<div class="patterns">';        
  foreach( $categories as $category ) {
    $categoryPage = $pages->find( 'category' )->children()->find( $category );
    $categorySymbol = null;
    if( $categoryPage ) {
      $categorySymbol = $categoryPage->symbol();
    }
    if( !$categorySymbol || $categorySymbol == '' ) {
      $categorySymbol = 'default';
    }
    $bookSvgUrl = '/assets/images/symbols/' . $categorySymbol . '.png';
    echo '<div class="pattern" style="background-image:url(' . $site->url() . $bookSvgUrl . ')"></div>';
  }
echo '</div>';
echo '<section id="book">';
	echo '<div class="title">';
		echo '<h1 class="main">' . $title . '</h1>';
		if( strlen( $subtitle ) ) {
	    echo '<h2 class="sub">' . $subtitle . '</h2>';
	  }
	  if( is_array( $authors ) ) {
			echo '<h3 class="author">';
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
			echo '</h3>';
		}
	echo '</div>';
	echo '<div id="content">';
		echo '<div class="meta">';
			echo '<h3>&nbsp;</h3>';
			echo '<ul>';
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
				if( $cover ) {
					echo '<li>';
						echo '<img src="' . $cover . '">';
					echo '</li>';
				}
			echo '</ul>';
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
			if( is_array( $authors ) && sizeof( $authors ) > 1 ) {
				echo '<div class="text about">';
					if( sizeof( $authors) > 1 ) {
						echo '<h3>Authors</h3>';	
					} else {
						echo '<h3>Author</h3>';
					}
					
					foreach( $authors as $index => $authorSlug ) {
						$author = $pages->find( 'authors' )->children()->find( $authorSlug );
						if( $author ) {
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
snippet( 'shelf', array( 'type' => 'category', 'value' => $categories, 'hidden' => $slug ) );
snippet( 'categories', array( 'class' => 'invert' ) );
snippet( 'footer' );
?>