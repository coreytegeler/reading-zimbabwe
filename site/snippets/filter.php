<aside>
<?php
echo '<div class="filter order select" data-type="order">';
	echo '<select id="order" default="null">';
		echo '<option class="order" data-slug="null">View</option>';
		echo '<option class="order" data-slug="null">Cover</option>';
		echo '<option class="order" data-slug="null">Title</option>';
	echo '</select>';
echo '</div>';


echo '<div class="filter order select" data-type="order">';
	echo '<select id="order" default="null">';
		echo '<option class="order" data-slug="null">Order</option>';
		echo '<option class="order" data-slug="null">A–Z</option>';
		echo '<option class="order" data-slug="null">Z–A</option>';
		echo '<option class="order" data-slug="null">Recent—Past</option>';
		echo '<option class="order" data-slug="null">Past—Recent</option>';
	echo '</select>';
echo '</div>';

$categories = $pages->find( 'categories' )->children()->visible();
echo '<div class="filter category select" data-type="category">';
	echo '<select id="category" default="null">';
		echo '<option class="category" data-slug="null">Category</option>';
		foreach( $categories as $category ) {
		  $catSlug = $category->slug();
		  $books = $pages->find( 'books' )->children();
		  if( sizeof( $books ) ) {
		    $catTitle = $category->title();
		    echo '<option class="category" data-slug="' . $catSlug . '">' . $catTitle . '</option>';
		  }
		}
	echo '</select>';
echo '</div>';

$years = range( 1940, date( 'Y' ) );
echo '<div class="filter year select" data-type="year">';
	echo '<select id="year" default="null">';
		echo '<option class="year" data-slug="null">Year</option>';
		foreach( $years as $year ) {
	    echo '<option class="year" data-slug="' . $year . '">' . $year . '</option>';
		}
	echo '</select>';
echo '</div>';
?>
</aside>