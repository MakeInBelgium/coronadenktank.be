<?php

// always split with a WHOLE gutenberg block! parts of blocks remaining in the
// string breaks rendering without throwing errors
function b35_getHtmlForGutenbergBlocks($string) {
  $blocks = parse_blocks($string);
  $content_markup = "";

  foreach ( $blocks as $block ) {
    // render_block renders a single block into a HTML string
    $content_markup .= render_block( $block );
  }

  return apply_filters( 'the_content', $content_markup );
}
