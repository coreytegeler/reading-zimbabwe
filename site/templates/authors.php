<?php
snippet( 'header' );
echo '<section id="shelf" class="list intro">';
	echo '<h1>' . $page->title() . '</h1>';
	echo '<div class="authors items columns">';
		$authors = $pages->find( 'authors' )->children()->visible()->sortBy( 'surname', 'asc' );
		$lastAlpha = '';
		foreach( $authors as $author ) {
			$surname = $author->surname();
			$firstname = $author->firstname();
			$alpha = mb_substr($surname, 0, 1, 'utf-8');
			if( strtolower( $alpha ) != strtolower( $lastAlpha ) ) {
				$lastAlpha = $alpha;
				echo '<div class="item sublabel"><span>' . $alpha . '</span></div>';
			}
			if( !$author->firstname()->empty() && !$author->surname()->empty() ) {
				echo '<div class="author item">';
					echo '<h4 class="name">';
					  echo '<a href="' . $author->url() . '">';
			      	echo $surname . ', ' . $firstname;
					  echo '</a>';
				  echo '</h4>';
				echo '</div>';
			}
		}
	echo '</div>';
echo '</section>';
snippet( 'footer' );
?>