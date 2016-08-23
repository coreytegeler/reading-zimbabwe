<?php
echo '<nav>';
  $categories = $pages->find( 'categories' )->children()->visible();
  if( $categories ) {
    echo '<ol id="categories">';
    foreach( $categories as $category ) {
      $title = $category->title();
      echo '<li class="category">';
      echo $title;
      echo '</li>';
    }
    echo '</ol>';
  }
echo '</nav>';
?>