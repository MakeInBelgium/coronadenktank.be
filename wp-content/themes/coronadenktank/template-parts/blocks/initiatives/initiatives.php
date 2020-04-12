<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


$v = get_field("visualisation");

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$args = array(
  'post_type' => 'initiative',
  'post_status' => 'publish',
  'posts_per_page'=> get_field("nbr_items"),
  'order'=>'DESC',
  'orderby'=>'date',
);

$categories = get_field("category");

if ($categories) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'initiatives_category',
      'field'    => 'term_id',
      'terms'    => $categories,
    )
  );
}

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
  print("<div class='row initiative-listing'>");
  $posts = $the_query->posts;
  foreach ($posts as $post) {
    print getThemedInitiativeBlock($post,getThemedInitiativeTemplate($v));
  }
  print("</div>");
}

/* Restore original Post Data */
wp_reset_postdata();
