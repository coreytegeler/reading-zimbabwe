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
<div class="row mail">
	<a href="mailto:info@readingzimbabwe.com" target="_blank">
		<span>info@readingzimbabwe.com</span>
	</a>
</div>
<div class="row social twitter">
	<a href="https://www.twitter.com/readingzw/" target="_blank">
		<span>@readingzw</span>
	</a>
</div>
<div class="row social instagram">
	<a href="https://www.instagram.com/readingzw/" target="_blank">
		<span>@readingzw</span>
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
echo js(array(
  'assets/js/jquery.min.js',
  'assets/js/masonry.pkgd.min.js',
  'assets/js/script.js',
));
?>
</html>