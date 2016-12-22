<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <?php
  if( !$page->text()->empty() ) {
    echo '<meta name="description" content="' . $page->text()->html() . '" />';
  } else {
    echo '<meta name="description" content="' . $pages->find('home')->intro()->html() . '" />';
  }
  $keywords = $site->keywords()->html();
  if( !$page->tags()->empty() ) { $keywords .= ',' . $page->tags()->html(); }

  echo '<meta name="keywords" content="' . $keywords . '"/>';
  $template = $page->intendedTemplate();
  if( $template == 'book' ) {
    $files = $page->files();
    if( $files->first() ) {
      $cover = $files->first()->url();
    } else {
      $cover = false;
    }
    echo '<meta property="description" content="' . $page->synopsis()->kirbytext() . '" />';
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:title" content="' . $page->title() . '" />';
    echo '<meta property="og:description" content="' . $page->synopsis()->kirbytext() . '" />';
    echo '<meta property="og:image" content="' . $cover . '" />';
    echo '<meta property="og:image:width" content="200" />';
    echo '<meta property="og:image:height" content="200" />';
    echo '<meta property="fb:app_id" content="1588195108157048" />';
  } else if( $template == 'cities' ) {
    echo '<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>';
    echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />';
  }

  $local = array( '127.0.0.1','localhost', '::1' );
  if(in_array( $_SERVER['REMOTE_ADDR'], $local ) ) {
    snippet( 'scss' );
  } else {
    $cssPath = '/assets/css/style.css';
    echo css( $cssPath );
  }
  echo js(array(
    'assets/js/jquery.js',
    'assets/js/lazyload.js',
    'assets/js/imagesloaded.js'
  ));
  ?>
</head>
<?php
// $endPaper = $page->files()->first();
// if($endPaper) { $endPaperUrl = $endPaper->url(); } else { $endPaperUrl = null; }
?>
<body class="<?php echo $page->template() ?>">
<main>
  <!-- <div class="wrapper"> -->
    <?php snippet( 'side' ) ?>