<?php
$author = $page;
snippet( 'header' );
echo '<section class="intro">';
	echo '<div class="inner">';
	  echo '<div class="vert">';
	    echo '<div class="horz">';
	      echo '<h1>' . $author->title() . '</h1>';
	      echo '<div class="text">';
	        echo $author->text()->kirbytext();
	    	echo '</div>';    
	    echo '</div>';
	   echo '</div>';
  echo '</div>';
echo '</section>';
$slug = $author->slug();
snippet( 'shelf', array( 'type' => 'author', 'value' => $slug ) );
snippet( 'categories' );
snippet( 'footer' );
?>