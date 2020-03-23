<?php

function register_acf_block_types() {

  // register a testimonial block.
  acf_register_block_type(array(
    'name'              => 'initiatives',
    'title'             => __('Initiatives'),
    'description'       => __('A block with the latest initiatives.'),
    'render_template'   => 'template-parts/blocks/initiatives/initiatives.php',
    'category'          => 'listing',
    'icon'              => 'admin-comments',
    'keywords'          => array( 'initiatives', 'listing' ),
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}
