<?php
echo '<aside class="toggleWrap">';
	echo '<div class="toggle">RZ</div>';
  echo '<div class="inner">';
    echo '<div class="button home"><a href="/">Home</a></div>';
	  if($pages->find('about')->isVisible()) {
	    echo '<div class="button about"><a href="' . $pages->find('about')->url() . '">About</a></div>';
	  }
	  if($pages->find('books')->isVisible()) {
	    echo '<div class="button books"><a href="' . $pages->find('books')->url() . '">Books</a></div>';
	  }
    if($pages->find('authors')->isVisible()) {
	    echo '<div class="button authors"><a href="' . $pages->find('authors')->url() . '">Authors</a></div>';
	  }
    if($pages->find('lexicon')->isVisible()) {
	    echo '<div class="button lexicon"><a href="' . $pages->find('lexicon')->url() . '">Lexicon</a></div>';
	  }
	  echo '<div class="button search">Search</div>';
  echo '</div>';
echo '</aside>';
?>