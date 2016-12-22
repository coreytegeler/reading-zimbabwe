<?php
$category = $page;
snippet( 'header' );
echo '<div class="relative min">';
	echo '<div class="patterns top">';  
	  $j = 0;
	  for ( $i = 0; $i < 3; $i++ ) {
	    $symbol = $page->symbol();
	    if( $symbol->empty() ) {
	      $symbol = 'default';
	    }
	    $symbolUrl = kirby()->urls()->assets() . '/images/symbols/' . $symbol . '.svg';
	    echo '<div class="pattern" style="background-image:url(' . $symbolUrl . ')"></div>';
	    $j++;
	  }
	echo '</div>';
	echo '<section class="intro">';
		echo '<h1>' . $category->title() . '</h1>';
		echo '<div class="inner">';
      if( !$category->text()->empty() ) {
	      echo '<div class="text">';
	        echo $category->text()->kirbytext();
	    	echo '</div>';    
	    }
		echo '</div>';
	echo '</section>';
	$slug = $category->slug();
	snippet( 'shelf', array( 'type' => 'category', 'value' => $slug ) );
echo '</div>';
snippet( 'footer' );
?>