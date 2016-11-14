<?php
echo '<section id="categories" class="categories bricks pattern">';
echo '<div class="category brick">';
	echo '<a href="/books" class="vert">';
		echo '<div class="title">All Books</div>';
	echo '</a>';
echo '</div>';
$categories = $pages->find( 'category' )->children()->visible();
if( $categories ) {
	$index = 0;
	foreach( $categories as $category ) {
		$index++;
		$catSlug = $category->slug();
		$catText = $category->text()->kirbytext();
		$catTitle = $category->title();
		echo '<div class="category brick" data-category="' . $catSlug . '">';
			echo '<a href="'.$site->url().'/category/' . $catSlug . '" class="vert">';
					echo '<div class="title">' . $catTitle . '</div>';
				echo '</a>';
		echo '</div>';
	}
}
echo '</section>';
?>