<?php
$category = $page;
snippet( 'header' );
echo '<main>';
	echo '<header>';
	  echo '<div class="inner matchHeight">';
	    echo '<div class="vert">';
	      echo '<div class="horz">';
	        echo '<h1>' . $category->title() . '</h1>';
	        echo $category->text();
	      echo '</div>';
	    echo '</div>';
	  echo '</div>';
	echo '</header>';
$slug = $category->slug();
snippet( 'sections/shelf', array( 'category' => $slug ) );
echo '</main>';
snippet( 'footer' );
?>