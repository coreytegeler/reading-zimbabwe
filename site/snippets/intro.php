<?php 
echo '<section id="intro">';
	$intro = $pages->find( 'home' )->intro();
	echo '<div class="text">';
		echo $intro;
	echo '</div>';
echo '</section>';
?>