<footer>
<div class="row search">
	<?php
	echo '<form action="/search/" autocomplete="off">';
		if( !isset( $query ) ) {
			$query = null;
		}
		echo '<input type="search" name="q" placeholder="Search">';
		echo '<input type="submit" value="Search">';
	echo '</form>';
	?>
</div>
<?php snippet( 'categories' ) ?>
<div class="row mail">
	<a href="mailto:<?php echo $site->email() ?>" target="_blank">
		<span><?php echo $site->email() ?></span>
	</a>
</div>
<div class="row social twitter">
	<a href="https://www.twitter.com/<?php echo $site->twitter() ?>/" target="_blank">
		<span>@<?php echo $site->twitter() ?></span>
	</a>
</div>
<div class="row social instagram">
	<a href="https://www.instagram.com/<?php echo $site->instagram() ?>/" target="_blank">
		<span>@<?php echo $site->instagram() ?></span>
	</a>
</div>
<!-- <div id="colophon">
	<div class="sitemap">
	<ul>
		<li><a href="/about">About</a></li>
		<li><a href="/books">Books</a></li>
		<li><a href="/authors">Authors</a></li>
		<li><a href="/library">Library</a></li>
		<li><a href="/search">Search</a></li>
	</ul>
</div> -->
</footer>
</main>
</body>
<?php
echo js( 'assets/js/script.js' );
?>
</html>