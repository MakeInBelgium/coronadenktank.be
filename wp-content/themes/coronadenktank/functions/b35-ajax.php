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
    $initiatives[] = getInitiativeBlockData($post);
  }


  $response = ["initiatives" => $initiatives];

  header('Content-Type: application/json');
  echo(json_encode($response));

  die();
}

add_action( 'wp_ajax_get_initiatives', 'b35_get_initiatives' );
add_action( 'wp_ajax_nopriv_get_initiatives', 'b35_get_initiatives' );
