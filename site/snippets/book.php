<?php
$bookTitle = $book->title();
$bookSlug = $book->slug();
$bookLink = $book->url();
$bookAuthor = $book->author();
$bookYear = $book->publishedDate();
$bookCategories = $book->category();
$endPaper = $book->files()->first();
if($endPaper) { $endPaperUrl = $endPaper->url(); } else { $endPaperUrl = null; }
echo '<div class="book" data-slug="' . $bookSlug . '" data-year="' . $bookYear . '" data-category="' . $bookCategories . '">';
  echo '<a href="' . $bookLink . '">';
    echo '<div class="inner">';
      $svg = file_get_contents('./assets/images/currency.svg');
      echo '<div class="title">' . $bookTitle . '</div>';
      echo '<div class="symbol">' . $svg . '</div>';
      if($bookAuthor) {
        echo '<span class="author">' . $bookAuthor . '</span>';
      }
    echo '</div>';  
  echo '</a>';
echo '</div>';
?>