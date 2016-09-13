<?php
$bookTitle = $book->title();
$bookSlug = $book->slug();
$bookLink = $book->url();
$bookAuthor = $book->author();
$endPaper = $book->files()->first();
if($endPaper) { $endPaperUrl = $endPaper->url(); } else { $endPaperUrl = null; }
echo '<div class="book" data-slug="' . $bookSlug . '">';
  // $width = strval(mt_rand(150, 200));
  // $height = strval($width+mt_rand($width/4, $width/2));
  echo '<a href="' . $bookLink . '">';
    echo '<div class="inner">';
      echo '<div class="title">' . $bookTitle . '</div>';
      if($bookAuthor) {
        echo '<span class="author">' . $bookAuthor . '</span>';
      }
    echo '</div>';  
  echo '</a>';
  // echo '<span class="year">' . '(1992)' . '</span>';
echo '</div>';
?>