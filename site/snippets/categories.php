<?php
echo '<section id="categories" class="categories bricks pattern toggleWrap">';
echo '<div class="pattern right"></div>';
echo '<div class="category brick toggle">';
	echo '<div class="title horz open"><span>View Categories</span></div>';
	echo '<div class="title horz close"><span>Close Categories</span></div>';
echo '</div>';
echo '<div class="category brick">';
	echo '<a href="/books">';
		echo '<div class="title vert">All Books</div>';
		$categorySymbol = 'default';
		if( in_array( $page->slug(), array( 'lexicon', 'about' ) ) ) {
    	$categorySymbol .= '-invert';
    }
    $symbolUrl = kirby()->urls()->assets() . '/images/symbols/' . $categorySymbol . '.svg';
		echo '<div class="pattern" style="background-image:url(' . $symbolUrl . ')"></div>';
	echo '</a>';
echo '</div>';
$categories = $pages->find( 'category' )->children()->visible();
if( $categories ) {
	$index = 0;
	foreach( $categories as $category ) {
		$index++;
		$categorySlug = $category->slug();
		$categoryText = $category->text()->kirbytext();
		$categoryTitle = $category->title();

		$categorySymbol = $category->symbol();
		if( $categorySymbol->empty() ) {
			$categorySymbol = 'default';
		}
		if( $page->slug() == 'about' ) {

    	$categorySymbol .= '-invert';
    } else if( $page->slug() == 'lexicon' ) {
    	$categorySymbol .= '-black';
    }
		$symbolUrl = kirby()->urls()->assets() . '/images/symbols/' . $categorySymbol . '.svg';
		echo '<div class="category brick" data-category="' . $categorySlug . '">';
			echo '<a href="/category/' . $categorySlug . '">';
					echo '<div class="title vert">' . $categoryTitle . '</div>';
					echo '<div class="pattern" style="background-image:url(' . $symbolUrl . ')"></div>';
				echo '</a>';
		echo '</div>';
	}
}
echo '</section>';
?>