<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <meta name="description" content="<?php echo $site->description()->html() ?>">
  <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
  <?php
  echo js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js',
    'assets/js/script.js',
  ));
  $local = array( '127.0.0.1','localhost', '::1' );
  if(in_array( $_SERVER['REMOTE_ADDR'], $local ) ):
    snippet( 'scss' );
  else:
    echo css( '/assets/css/style.css' );
  endif;
  ?>
</head>
<?php
// $endPaper = $page->files()->first();
// if($endPaper) { $endPaperUrl = $endPaper->url(); } else { $endPaperUrl = null; }
?>
<body class="<?php echo $page->template(); ?>">
  <header id="top">
  <?php
    echo '<div class="logo">';
      echo '<a href="/">Reading</br>Zimbabwe</a>';
    echo '</div>';
    #snippet( 'intro' );
    ?>
  </header>
  <div id="content">