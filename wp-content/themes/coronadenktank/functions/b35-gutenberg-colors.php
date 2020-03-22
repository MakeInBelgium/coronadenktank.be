<?php

function coronadenktank_gutenberg_color_palette() {
  add_theme_support( 'disable-custom-colors' );
  add_theme_support(
    'editor-color-palette', array(
      array(
        'name'  => esc_html__( 'Purple Heart', 'coronadenktank' ),
        'slug' => 'purple-heart',
        'color' => '#7242E0',
      ),
      array(
        'name'  => esc_html__( 'True V', 'coronadenktank' ),
        'slug' => 'true-v',
        'color' => '#8064D5',
      ),
      array(
        'name'  => esc_html__( 'Blue gem', 'coronadenktank' ),
        'slug' => 'blue-gem',
        'color' => '#2D0E89',
      ),
      array(
        'name'  => esc_html__( 'Portica', 'coronadenktank' ),
        'slug' => 'portica',
        'color' => '#F6F061',
      ),
      array(
        'name'  => esc_html__( 'Catskill White', 'coronadenktank' ),
        'slug' => 'catskill-white',
        'color' => '#F1F3F8',
      )
    )
  );
}
add_action( 'after_setup_theme', 'coronadenktank_gutenberg_color_palette' );