<?php 
echo '<section id="manifesto">';
	$manifesto = $pages->find( 'home' )->intro();
	echo '<div class="inner">';
		echo $manifesto;
	echo '</div>';
echo '</section>';
?>