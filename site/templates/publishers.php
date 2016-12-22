<?php
snippet( 'header' );
echo '<section id="shelf" class="list intro">';
	echo '<h1>' . $page->title() . '</h1>';
	echo '<div class="publishers items columns">';
		$publishers = $pages->find( 'publishers' )->children()->visible()->sortBy( 'title', 'asc' );
		$lastAlpha = '';
		foreach( $publishers as $publisher ) {
			$title = $publisher->title();
			$firstname = $publisher->firstname();
			$alpha = mb_substr($title, 0, 1, 'utf-8');
			if( strtolower( $alpha ) != strtolower( $lastAlpha ) ) {
				$lastAlpha = $alpha;
				echo '<div class="item sublabel"><span>' . $alpha . '</span></div>';
			}
			if( !$publisher->title()->empty() ) {
				echo '<div class="publisher item">';
					echo '<h4 class="name">';
						echo '<a href="' . $publisher->url() . '">';
			      	echo $title;
					  echo '</a>';
					echo '</h4>';
				echo '</div>';
			}
		}
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>