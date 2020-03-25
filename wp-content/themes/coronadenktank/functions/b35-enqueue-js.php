<?php

function b35_enqueue_scripts() {
  // Get the theme data
  $the_theme = wp_get_theme();
  // Via accpount van Bram Esposito bram.esposito@gmail.com
  wp_enqueue_style( 'Adobe Font-Upgrade', "https://use.typekit.net/uud8syv.css", array(), $the_theme->get( 'Version' ) );

  $minimized = "";

  if (b35_isProduction()) {
    $minimized = ".min";
  }

  wp_enqueue_script( 'vue', get_stylesheet_directory_uri() .'/js/vue'.$minimized.'.js' );
  wp_enqueue_script( 'vue-resource', get_stylesheet_directory_uri() .'/js/vue-resource'.$minimized.'.js' );
}

add_action( 'wp_enqueue_scripts', 'b35_enqueue_scripts' );


// helper functions

function b35_isProduction() {
  if (defined('WP_ENV')) {
    return (WP_ENV == "production");
  }
  return true;
}
