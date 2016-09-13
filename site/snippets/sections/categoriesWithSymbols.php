<section id="categories">
<?php
$categories = $pages->find( 'categories' )->children()->visible();
if( $categories ) {
	$index = 0;
	foreach( $categories as $category ) {
		$index++;
		$catSlug = $category->slug();
		$catText = $category->text()->kirbytext();
		$books = $pages->find( 'books' )->children();
		// echo sizeof( $books ) . $catSlug;
		if( sizeof( $books ) ) {
			$catTitle = $category->title();
				echo '<div class="category" data-category="' . $catSlug . '">';
					echo '<a href="' . $catSlug . '" class="vert">';
							$catTitle = str_replace( ' ', '<br/>', $catTitle );
							$catTitle = str_replace( '<br/>&', ' &amp;', $catTitle );
							$catTitle = str_replace( 'in<br/>', 'in ', $catTitle );
							echo '<div class="title">' . $catTitle . '</div>';
							echo '<div class="bookBrickPile">';
								echo '<div class="bookBricks">';
									// echo '<div class="bookBrick gap"></div>';
									// echo '<div class="bookBrick gap"></div>';	
									// echo '<div class="bookBrick gap"></div>';
									echo '<div class="bookBrick gap"></div>';	
									for($i = 0; $i < rand ( 5 , 100 ); $i++) {
										echo '<div class="bookBrick"></div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</a>';
				echo '</div>';
		}
	}
}
?>
</section>