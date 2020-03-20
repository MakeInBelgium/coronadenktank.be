<?php
// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
  'supporting' => __( 'Supporting navigation', 'coronadenktank' ),
  'primary' => __( 'Primary Menu', 'coronadenktank' ),
) );


/**
 * Add SLACK link to menu
 */
add_filter('wp_nav_menu_items','primary_navigation_lang', 10, 2);
function primary_navigation_lang( $items, $args ) {
  if( $args->theme_location == 'supporting')  {
    $items .= "<li class=\"menu-item nav-item nav-link\"><a title=\"Join us on Slack\" href=\"https://join.coronadenktank.be/\" class=\"nav-link slack-link\" target='_blank'><img src='".get_stylesheet_directory_uri()."/img/slack.svg' width='37px' height='37px'> slack</a></li>";
  }
  return $items;
}
