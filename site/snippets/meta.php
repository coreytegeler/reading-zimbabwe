<?php
$language = $page->language();
$category = $page->category();
$hardCover = $page->hardCover();
$hardCoverCount = $page->hardCoverCount();
$paperBack = $page->paperBack();
$paperBackCount = $page->paperBackCount();
$publisher = $page->publisher();
$publisherLink = $page->publisherLink();
$publishedDate = $page->publishedDate();
$publisherLocation = $page->publisherLocation();
$isbnX = $page->isbnX();
$isbnXIII = $page->isbnXIII();
echo '<ul>';
  if( $language ) {
    echo '<li class="language">';
      echo '<span>Language</span><em>' . $language . '</em>';
    echo '</li>';
  }
  // if( $category ) {
  //   echo '<li class="category">';
  //     echo 'Category: <em>' . $category . '</em>';
  //   echo '</li>';
  // }
  if( $publisher ) {
    echo '<li class="publisher">';
      echo '<span>Publisher</span><em>';
      if( $publisherLink ) {
        echo '<a href="' . $publisherLink . '">' . $publisher . '</a>';
      } else {
        echo $publisher;
      }
      // if( $publisherLocation ) {
      //  echo ' in ' . $publisherLocation;
      // }
      echo '</em>';
    echo '</li>';
  }
  if( $hardCover && $hardCoverCount ) {
    echo '<li class="hardCover">';
      echo '<span>Hard Cover</span><em>' . $hardCoverCount. ' pages</em>';
    echo '</li>';
  }
  if( $paperBack && $paperBackCount ) {
    echo '<li class="paperBack">';
      echo '<span>Paper Back</span><em>' . $paperBackCount . ' pages</em>';
    echo '</li>';
  }
  if( $isbnX ) {
    echo '<li class="isbn10">';
      echo '<span> ISBN-10</span><em>' . $isbnX . '</em>';
    echo '</li>';
  }
  if( $isbnXIII ) {
    echo '<li class="isbn13">';
      echo '<span> ISBN-13</span><em>' . $isbnXIII . '</em>';
    echo '</li>';
  }
echo '</ul>';
?>