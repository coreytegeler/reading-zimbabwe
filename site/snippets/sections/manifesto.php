<section id="manifesto">
<?php
$manifesto = $pages->find( 'home' )->intro();
echo '<div class="inner">';
	echo '<div class="vert">';
		echo '<div class="horz">';
			echo $manifesto;
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
</section>