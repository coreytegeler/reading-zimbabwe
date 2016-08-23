<section id="colophon">
<?php
$categories = $pages->find( 'categories' )->children()->visible();
if( $categories ) {
	echo '<ol id="categories">';
	$index = 0;
	foreach( $categories as $catPath => $category ) {
		$index++;
		$catSlug = $category->slug();
		$books = $pages->find( 'books' )->children();
		$count = sizeof( $books );
		if( $count ) {
			$catTitle = $category->title();
			echo '<li class="category" data-slug="' . $catSlug . '">';
				echo '<span class="index">' . $index . '.</span>';
				echo '<a href="' . $catPath . '">' . $catTitle . '</a>';
				echo '<div class="dots"><span>....................................................................................................................................................................................................................................................................</span></div>';
				echo '<span class="count">' . $count . ' books</span>';
			echo '</li>';
		}
	}
}
?>


</section>