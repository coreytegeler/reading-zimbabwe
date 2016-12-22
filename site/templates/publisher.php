<?php
$publisher = $page;
$website = $publisher->website();
snippet( 'header' );
echo '<div class="min">';
	echo '<section class="intro">';
		echo '<div class="inner">';
	    echo '<h1>' . $publisher->title() . '</h1>';
	    if( !$publisher->website()->empty() ) {
		    echo '<div class="text">';
		      // echo 'Read more at <a href="' . $website . '" target="_blank">' . $website . '</a>';
		  	echo '</div>';
		  }
	  echo '</div>';
	echo '</section>';
	$slug = $publisher->slug();
	snippet( 'shelf', array( 'type' => 'publisher', 'value' => $slug, 'max' => 12, 'title' => 'By This Publisher' ) );
echo '</div>';
snippet( 'footer' );
?>