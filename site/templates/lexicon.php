<?php
snippet( 'header' );
$terms = $page->children()->visible();
echo '<section id="lexicon">';
	echo '<div class="inner">';
		echo '<h1>Lexicon</h1>';
		echo '<div class="columns">';
			if( !$page->note()->empty() ) {
				echo '<div class="note">';
					echo $page->note();
				echo '</div>';
			}
			foreach( $terms as $i => $term ) {
				$title = $term->title();
				$definition = $term->definition();
				if( !$title->empty() && !$definition->empty() ) {
					echo '<div class="row term">';
						echo '<div class="inner">';
							echo '<span class="title">' . $title . ' </span>';
							echo '<span class="definition">' . $definition . '</span>';
						echo '</div>';
					echo '</div>';
				}
			}
		echo '</div>';
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>