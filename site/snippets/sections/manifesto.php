<section id="manifesto">
<?php
$manifesto = $pages->find( 'home' )->intro()->kirbytext();
echo '<div class="inner matchHeight">';
	echo '<div class="vert">';
		echo '<div class="horz">';
			echo '<h1>READING</br>ZIMBABWE</h1>'; 
			echo '<div class="text">';
				echo $manifesto;
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
</section>