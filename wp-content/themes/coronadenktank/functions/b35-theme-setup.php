<?php

function b35_theme_setup() {
  add_theme_support( 'post-thumbnails' );
}

add_action('after_setup_theme','b35_theme_setup');
