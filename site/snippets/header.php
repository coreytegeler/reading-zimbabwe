<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <meta name="description" content="<?php echo $site->description()->html() ?>">
  <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
  <?php
  $alt = '';
  if($page->alt()) {
    $alt = ' alt';
  }
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
<body class="<?php echo $page->template() . $alt ?>">
<main>
  <!-- <div class="wrapper"> -->
    <?php snippet( 'side' ) ?>