<?php

function register_acf_block_types() {

  // register a testimonial block.
  acf_register_block_type(array(
    'name'              => 'activities',
    'title'             => __('Activities'),
    'description'       => __('A block with the latest activities.'),
    'render_template'   => 'template-parts/blocks/activities/activities.php',
    'category'          => 'listing',
    'icon'              => 'admin-comments',
    'keywords'          => array( 'activities', 'listing' ),
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}
