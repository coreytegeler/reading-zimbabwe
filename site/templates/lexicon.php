<?php snippet( 'header' );
$terms = $page->children()->visible();
echo '<section id="lexicon" class="intro">';
	echo '<div class="inner">';
		echo '<h1>Lexicon</h1>';
		if( !$page->note()->empty() ) {
			echo '<div class="text">';
				echo $page->note();
			echo '</div>';
		}
		foreach( $terms as $i => $term ) {
			echo '<div class="row term">';
				echo '<div class="name">' . $term->title() . '</div>';
				echo '<div class="definition">' . $term->definition() . '</div>';
			echo '</div>';
		}
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>