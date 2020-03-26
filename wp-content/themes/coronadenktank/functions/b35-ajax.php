<?php

function b35_get_initiatives($args) {
  $args = array(
    'post_type' => 'initiative',
    'post_status' => 'publish',
    'order'=>'DESC',
    'orderby'=>'date',
  );


  $the_query = new WP_Query( $args );

  $initiatives = [];

  foreach ($the_query->posts as $post) {
    $initiative['title'] = $post->post_title;
    $initiative['link'] = get_permalink($post->ID);
    // Featured Image
    $classes = "";
    $defaultimgid = 48;
    $postimgid = get_post_thumbnail_id($post->ID);
    if(!$postimgid) {
      $postimgid = $defaultimgid;
      $classes .= ' default'; // set default image class
    }
    $initiative['img'] = wp_get_attachment_image($postimgid, 'thumbnail',false, ["class" => $classes]);
    $initiative['date'] = get_the_date("d.m.y", $post->ID);
    remove_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
    $initiative['excerpt'] = substr(get_the_excerpt($post->ID), 0, 75);
    add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
    $initiative['readmore'] = __("Read more", "coronadenktank");
    $initiative['terms'] = get_the_terms($post->ID, "initiatives_category");

    $initiatives[] = $initiative;
  }


  $response = ["initiatives" => $initiatives];

  header('Content-Type: application/json');
  echo(json_encode($response));

  die();
}

add_action( 'wp_ajax_get_initiatives', 'b35_get_initiatives' );
add_action( 'wp_ajax_nopriv_get_initiatives', 'b35_get_initiatives' );
