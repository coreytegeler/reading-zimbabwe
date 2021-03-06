<?php
$book = $pages->find( 'books' )->children()->find( $book );
$bookTitle = $book->title();
$bookSubtitle = $book->subtitle();
$bookSlug = $book->slug();
$bookLink = $book->url();
$authors = $book->author();
$motif = $book->motif();
if( !$motif ) {
  $motif = 'other';
}
if( $authors ) {
  $authorsArray = $authors->split( ',' );
}
$bookYear = $book->year();
$bookCity = $book->city();
$bookPublisher = $book->publisher();
$bookCategories = $book->category();
if( $bookCategories ) {
  $bookCategoriesArray = $bookCategories->split(',');
}
$files = $book->files();
if( $files->first() ) {
  $cover = $files->first()->resize(150, null)->url();
  $hasCover = true;
} else {
  $hasCover = false;
}

echo '<div class="book item ' . ($hasCover ? 'hasCover' : 'noCover') . '" data-slug="' . $bookSlug . '" data-year="' . $bookYear . '" data-category="' . $bookCategories . '" data-location="' . $bookCity . '" data-index="' . $index . '" data-publisher="' . $bookPublisher . '" data-motif="' . $motif . '">';
  echo '<a href="' . $bookLink . '">';
    if( $hasCover ) {
      echo '<img class="cover" data-source="' . $cover . '">';
    }
    echo '<div class="inner">';
      echo '<div class="title">';
        echo $bookTitle;
      echo '</div>';
      if( strlen( $bookSubtitle ) ) {
        echo '<div class="subtitle">';
          echo $bookSubtitle;
        echo '</div>';
      }
      if( is_array( $authorsArray ) ) {
        echo '<div class="author">';
          foreach( $authorsArray as $index => $authorSlug ) {
            $author = $pages->find( 'authors' )->children()->find( $authorSlug );
            if( $author ) {
              echo $author->title();
              if ( $index == sizeof( $authorsArray ) - 2 ) {
                echo ' & ';
              } else if( $index < sizeof( $authorsArray ) - 1 ) {
                echo ', ';
              }
            }
          }
        echo '</div>';
      }
    echo '</div>';
    echo '<div class="patterns">';        
      $j = 0;
      for ( $i = 0; $i < 18; $i++ ) {
        if( $j > ( sizeof( $bookCategoriesArray ) - 1 ) ) { $j = 0; }
        if( is_array( $bookCategoriesArray ) && sizeof( $bookCategoriesArray ) > 0 ) {
          $bookCategory = $bookCategoriesArray[$j];
          $categoryPage = $pages->find( 'category' )->children()->find( $bookCategory );
          $categorySymbol = null;
          if( $categoryPage ) {
            $categorySymbol = $categoryPage->symbol();
          }
        }
        if( !isset( $categorySymbol ) || $categorySymbol == '') {
          $categorySymbol = 'default';
        }
        $symbolUrl = kirby()->urls()->assets() . '/images/symbols/' . $categorySymbol . '.svg';
        echo '<div class="pattern" style="background-image:url(' . $symbolUrl . ')"></div>';
        $j++;
      }
    echo '</div>';
  echo '</a>';
echo '</div>';
?>