<aside>
<div class="inner">
<?php
// echo '<div class="filter order select" data-type="order">';
// 	echo '<select id="order" default="null">';
// 		echo '<option class="order" data-slug="null">View</option>';
// 		echo '<option class="order" data-slug="null">Cover</option>';
// 		echo '<option class="order" data-slug="null">Title</option>';
// 	echo '</select>';
// echo '</div>';


// echo '<div class="filter order select" data-type="order">';
// 	echo '<select id="order" default="null">';
// 		echo '<option class="order" data-slug="null">Order</option>';
// 		echo '<option class="order" data-slug="null">A–Z</option>';
// 		echo '<option class="order" data-slug="null">Z–A</option>';
// 		echo '<option class="order" data-slug="null">Recent—Past</option>';
// 		echo '<option class="order" data-slug="null">Past—Recent</option>';
// 	echo '</select>';
// echo '</div>';

$categories = $pages->find( 'category' )->children()->visible();
echo '<div class="filter category select">';
	echo '<select id="category" default=null data-attr="categories">';
		echo '<option class="category" value=null>Category</option>';
		foreach( $categories as $category ) {
		  $catSlug = $category->slug();
	    $catTitle = $category->title();
	    echo '<option class="category" value="' . $catSlug . '">' . $catTitle . '</option>';
		}
	echo '</select>';
echo '</div>';

echo '<div class="filter decade select">';
	echo '<select id="decade" default=null data-attr="year">';
		echo '<option class="decade" value=null>Decade</option>';
		$decade = 1800;
		while( $decade < date( 'Y' ) ) {
	    echo '<option class="decade" value="' . $decade . '">' . $decade . '</option>';
	    $decade += 10;
		}
	echo '</select>';
echo '</div>';
?>
</div>
</aside>