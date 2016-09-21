<section id="manifesto" class="frame">
<?php
$manifesto = $pages->find( 'home' )->intro();
echo '<div class="inner matchHeight">';
	echo '<div class="vert">';
		echo '<div class="horz">';
			echo $manifesto;
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
</section>