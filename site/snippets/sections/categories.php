<section id="categories">
<?php
$categories = $pages->find( 'category' )->children()->visible();
if( $categories ) {
	$index = 0;
	foreach( $categories as $category ) {
		$index++;
		$catSlug = $category->slug();
		$catText = $category->text()->kirbytext();
		$catTitle = $category->title();
		echo '<div class="category" data-category="' . $catSlug . '">';
			echo '<a href="/category/' . $catSlug . '" class="vert">';
					echo '<div class="title">' . $catTitle . '</div>';
				echo '</a>';
		echo '</div>';
	}
}
?>
</section>