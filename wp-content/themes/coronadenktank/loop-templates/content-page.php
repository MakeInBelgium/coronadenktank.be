<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  <div class="section-highlighted">
  <img src='<?php echo get_stylesheet_directory_uri(); ?>/img/coronadenktank-background.jpg' alt="" class="background-image">
    <div class="container">
  <header class="entry-header">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

  </header><!-- .entry-header -->

  <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

  <div class="entry-content">

    <?php
    $c = get_the_content();

    $blocks = explode("<hr class=\"wp-block-separator\"/>", $c);

    echo array_shift($blocks);
    ?>
  </div>
  </div>
  </div>
  <div class="entry-content">
    <?php
    echo implode($blocks, "<hr class=\"wp-block-separator\"/>");
    ?>

    <?php
    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
        'after'  => '</div>',
      )
    );
    ?>

  </div><!-- .entry-content -->

  <footer class="entry-footer">

    <?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

  </footer><!-- .entry-footer -->

</article><!-- #post-## -->
