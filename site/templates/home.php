<?php snippet( 'header' ) ?>
<section id="manifesto" class="intro">
<?php
$manifesto = $pages->find( 'home' )->intro()->kirbytext();
echo '<div class="inner">';
	echo '<div class="vert">';
		echo '<div class="horz">';
			echo '<h1>READING</br>ZIMBABWE</br><div class="beta">beta</div></h1>'; 
			echo '<div class="text">';
				echo $manifesto;
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
?>
</section>
<?php snippet( 'categories' ) ?>
<?php snippet( 'footer' ) ?>