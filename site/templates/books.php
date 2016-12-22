<?php
snippet( 'header' );
echo '<div class="relative">';
	snippet( 'filter' );
	snippet( 'shelf', array( 'paginate' => true ) );
echo '</div>';
snippet( 'footer' );
?>