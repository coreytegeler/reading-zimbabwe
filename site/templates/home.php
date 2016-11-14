<?php snippet( 'header' ) ?>
<section id="manifesto">
<?php
$manifesto = $pages->find( 'home' )->intro()->kirbytext();
echo '<div class="inner">';
	echo '<h1>READING ZIMBABWE<div class="beta">beta</div></h1>'; 
	echo '<div class="text">';
		echo $manifesto;
	echo '</div>';
echo '</div>';
?>
</section>
<?php snippet( 'footer' ) ?>