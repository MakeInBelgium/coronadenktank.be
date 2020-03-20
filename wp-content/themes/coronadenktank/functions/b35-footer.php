<?php

// add_action( 'understrap_site_info', 'coronadenktank_add_site_info' );
if ( ! function_exists( 'coronadenktank_add_site_info' ) ) {
  /**
   * Add site info content.
   */
  function coronadenktank_add_site_info() {
    $footertext = "© " . date('YYYY');
    echo apply_filters( 'understrap_site_info_content', $footertext );
  }
}