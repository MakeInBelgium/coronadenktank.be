<?php
// initiialize some strings:
$initiative = __("Initiatives", "coronadenktank");
$initiative_slug = __("initiative", "coronadenktank");

load_theme_textdomain('coronadenktank',get_stylesheet_directory() . '/languages' );

add_filter( 'register_post_type_args', 'wpse247328_register_post_type_args', 10, 2 );
function wpse247328_register_post_type_args( $args, $post_type ) {

  if ( 'initiative' === $post_type ) {
    $args['rewrite']['slug'] = __('initiative', "coronadenktank");
  }

  return $args;
}
