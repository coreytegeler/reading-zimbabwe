<div id="subscribe" class="subscribe pattern">
	<div class="inner">
		<form action="//readingzimbabwe.us14.list-manage.com/subscribe/post?u=a901b2accc0e9dad04b58a5f0&amp;id=35874d620e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<div class="row">
				<input type="email" value="" name="EMAIL" class="half required email" placeholder="Email">
			</div>
			<div class="row">
				<input type="text" value="" name="FNAME" class="half" placeholder="First Name">
			</div>
			<div class="row">
				<input type="text" value="" name="LNAME" class="half" placeholder="Surname">
			</div>
			<div id="mce-responses" class="row">
				<div class="response" id="mce-error-response" style="display:none"></div>
				<div class="response" id="mce-success-response" style="display:none"></div>
			</div>
			<div class="row">
		    <input type="submit" value="Cancel" class="cancel"/>
		    <input type="submit" value="Subscribe" name="subscribe" class="subscribe">
			</div>
		</form>
	</div>
</div>

<!--End mc_embed_signup-->

<footer>
<?php if( $page->slug() != 'search' ) { ?>
	<div class="row search">
		<?php
		echo '<form action="/search/" autocomplete="off">';
			if( !isset( $query ) ) {
				$query = null;
			}
			echo '<input type="text" name="q" placeholder="Search">';
		echo '</form>';
		?>
	</div>
<?php } ?>
<?php snippet( 'categories' ) ?>
<div class="row social instagram">
	<a href="https://www.instagram.com/<?php echo $site->instagram() ?>/" target="_blank">
		<span>@<?php echo $site->instagram() ?></span>
	</a>
</div>
<div class="row social twitter">
	<a href="https://www.twitter.com/<?php echo $site->twitter() ?>/" target="_blank">
		<span>@<?php echo $site->twitter() ?></span>
	</a>
</div>
<div class="row social soundcloud">
	<a href="https://www.soundcloud.com/<?php echo $site->soundcloud() ?>/" target="_blank">
		<span>Listen to Reading Zimbabwe</span>
	</a>
</div>
<div class="row mail">
	<a href="mailto:<?php echo $site->email() ?>" target="_blank">
		<span><?php echo $site->email() ?></span>
	</a>
</div>
<div class="row subscribe">
	<a href="#">
		<span>Join our mailing list</span>
	</a>
</div>
</footer>
</main>
</body>
<?php
echo js( 'assets/js/script.js' );
?>
</html>