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
  <?#php echo js(' assets/js/jquery.js' ) ?>

</head>
<body class="<?php echo $page->template() ?>">
  <header id="top">
  <?php
    echo '<div class="logo">';
      echo '<span>Reading Zimbabwe</span>';
      // echo '<span>Reading </span>';
      // $categories = $pages->find( 'categories' )->children()->visible();
      // echo '<div class="select">';
      // echo '<span>Zimbabwe</span>';
      // echo '<select id="categories" default="zimbabwe">';
      // echo '<option>Zimbabwe</option>';
      // foreach( $categories as $catPath => $category ) {
      //   $catSlug = $category->slug();
      //   $books = $pages->find( 'books' )->children();
      //   if( sizeof( $books ) ) {
      //     $catTitle = $category->title();
      //     echo '<option class="category" data-slug="' . $catSlug . '">' . $catTitle . '</option>';
      //   }
      // }
      // echo '</select>';
      // echo '</div>';
    echo '</div>';
    #snippet( 'intro' );
    ?>
  </header>
  <div id="content">