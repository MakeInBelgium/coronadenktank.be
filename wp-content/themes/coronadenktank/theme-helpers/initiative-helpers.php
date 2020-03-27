<?php

function getThemedInitiativeBlock($post, $template) {
  $renderedTemplate = b35_renderTemplate($template, getInitiativeBlockData($post));

  return (trim(preg_replace('/\n/', '', $renderedTemplate)));
}

function getInitiativeBlockData($post) {
  $vars = [];
  $vars['title'] = $post->post_title;
  $vars['link'] = get_permalink($post->ID);

  // Featured Image
  $classes = "";
  $defaultimgid = 48;
  $postimgid = get_post_thumbnail_id($post->ID);
  if (!$postimgid) {
    $postimgid = $defaultimgid;
    $classes .= ' default'; // set default image class
  }
  $vars['img'] = wp_get_attachment_image($postimgid, 'medium', FALSE, ["class" => $classes]);
  $vars['date'] = get_the_date("d.m.y", $post->ID);

  remove_filter('wp_trim_excerpt', 'understrap_all_excerpts_get_more_link');
  $vars['excerpt'] = substr(get_the_excerpt($post->ID), 0, 75);
  add_filter('wp_trim_excerpt', 'understrap_all_excerpts_get_more_link');
  $vars['readmore'] = __("Read more", "coronadenktank");
  return $vars;
}

function getThemedInitiativeTemplate($format = "large") {
  switch ($format) {
    case "large":
      $template = <<<TEMPLATE
    <div class='col-md-3 col-12 large'>
    <div><a href="{{link}}">{{img}}</a></div>
      <div class="initiative">
        <div class="date">{{date}}</div>
        <h4 class="title"><a href="{{link}}">{{title}}</a></h4>
         <p class="excerpt"><a href="{{link}}">{{excerpt}}</a></p>
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
        <h4 class="title"><a href="{{link}}">{{title}}</a></h4>
         <p class="excerpt"><a href="{{link}}">{{excerpt}}</a></p>
        <a href="{{link}}" class="link">{{readmore}}</a>
      </div>
    </div>
TEMPLATE;
      break;
  }
  return $template;
}