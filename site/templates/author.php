<?php
$author = $page;
snippet( 'header' );
echo '<div class="min">';
	echo '<section class="intro">';
		echo '<div class="inner">';
	    echo '<h1>' . $author->title() . '</h1>';
	    if( !$author->text()->empty() ) {
		    echo '<div class="text">';
		      echo $author->text()->kirbytext();
		  	echo '</div>';
		  }
	  echo '</div>';
	echo '</section>';
	$slug = $author->slug();
	snippet( 'shelf', array( 'type' => 'author', 'value' => $slug, 'max' => 12 ) );
echo '</div>';
snippet( 'footer' );
?>