<?php
$category = $page;
snippet( 'header' );
echo '<main>';
	echo '<section class="frame pattern invert">';
	  echo '<div class="inner matchHeight">';
	    echo '<div class="vert">';
	      echo '<div class="horz">';
	        echo '<h1>' . $category->title() . '</h1>';
	        echo $category->text();
	      echo '</div>';
	    echo '</div>';
	  echo '</div>';
	echo '</section>';
$slug = $category->slug();
snippet( 'sections/shelf', array( 'category' => $slug ) );
// snippet( 'sections/categories', array( 'class' => 'invert' ) );
echo '</main>';
snippet( 'footer' );
?>