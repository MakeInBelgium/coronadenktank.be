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
      'taxonomy' => 'category',
      'field'    => 'term_id',
      'terms'    => $categories,
    )
  );
}

$the_query = new WP_Query( $args );


switch ($v) {
  case "large":
    $template = <<<TEMPLATE
    <div class='col-md-3 col-12 large'>
    <div><a href="{{link}}">{{img}}</a></div>
      <div class="initiative">
        <div class="date">{{date}}</div>
        <h4><a href="{{link}}">{{title}}</a></h4>
<!--         <p>{{excerpt}}</p>-->
        <a href="{{link}}" class="link">{{readmore}}</a>
      </div>
    </div>
TEMPLATE;
    break;
  case "compact":
    $template = <<<TEMPLATE
    <div class='col-md-3 col-12 compact'>
      <div class="initiative">
        <div class="date">{{date}}</div>
        <h4><a href="{{link}}">{{title}}</a></h4>
<!--         <p>{{excerpt}}</p>-->
        <a href="{{link}}" class="link">{{readmore}}</a>
      </div>
    </div>
TEMPLATE;
    break;
}

// The Loop
if ( $the_query->have_posts() ) {
  print("<div class='row initiative-listing'>");
  $posts = $the_query->posts;
  foreach ($posts as $post) {
    $vars['title'] = $post->post_title;
    $vars['link'] = get_permalink($post->ID);

    // Featured Image
    $classes = "";
    $defaultimgid = 48;
    $postimgid = get_post_thumbnail_id($post->ID);
    if(!$postimgid) {
      $postimgid = $defaultimgid;
      $classes .= ' default'; // set default image class
    }
    $vars['img'] = wp_get_attachment_image($postimgid, 'thumbnail',false, ["class" => $classes]);
    $vars['date'] = get_the_date("d.m.y", $post->ID);

    remove_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
    $vars['excerpt'] = substr(get_the_excerpt($post->ID), 0, 75);
    add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
    $vars['readmore'] = __("Read more", "coronadenktank");

    $template = b35_renderTemplate($template, $vars);

    print(trim(preg_replace('/\n/', '', $template)));
  }
  print("</div>");
}

/* Restore original Post Data */
wp_reset_postdata();
