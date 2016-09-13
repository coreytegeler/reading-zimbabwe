<?php snippet( 'header' ) ?>
<main>
	<?
	$category = $page;
	$slug = $category->slug();
	$title = $category->title();
	$text = $category->text();

	?>
	<?php snippet( 'sections/shelf', array( 'category' => $slug ) ) ?>
</main>
<?php snippet( 'footer' ) ?>