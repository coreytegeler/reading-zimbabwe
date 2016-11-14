<?php
$category = $page;
snippet( 'header' );
echo '<div class="relative min">';
// snippet( 'filter' );
	echo '<section class="intro">';
		echo '<div class="inner">';
		  echo '<div class="vert">';
		    echo '<div class="horz">';
		      echo '<h1>' . $category->title() . '</h1>';
		      echo '<div class="text">';
		        echo $category->text();
		    	echo '</div>';    
		    echo '</div>';
		  echo '</div>';
		echo '</div>';
	echo '</section>';
	$slug = $category->slug();
	snippet( 'shelf', array( 'type' => 'category', 'value' => $slug ) );
echo '</div>';
snippet( 'footer' );
?>