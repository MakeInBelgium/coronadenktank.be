<?php

function b35_enqueue_scripts() {

  // Get the theme data
  $the_theme = wp_get_theme();
  // Via accpount van Bram Esposito bram.esposito@gmail.com
  wp_enqueue_style('Adobe Font-Upgrade', "https://use.typekit.net/uud8syv.css", [], $the_theme->get('Version'));

  $minimized = "";

  if (b35_isProduction()) {
    $minimized = ".min";
  }

  wp_enqueue_script('vue', get_stylesheet_directory_uri() . '/js/vue' . $minimized . '.js');
  wp_enqueue_script('vue-resource', get_stylesheet_directory_uri() . '/js/vue-resource' . $minimized . '.js');

  wp_localize_script( 'vue', 'coronadenktank',
    array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

  //Check if we are viewing a page
  if(!is_page()) return;
  global $wp_query;

  //Check which template is assigned to current page we are looking at
  $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
  if ($template_name == 'templatename.php') {

  }
}

add_action( 'wp_enqueue_scripts', 'b35_enqueue_scripts' );


// helper functions

function b35_isProduction() {
  if (defined('WP_ENV')) {
    return (WP_ENV == "production");
  }
  return $_SERVER['SERVER_ADDR'] != "127.0.0.1";
}
