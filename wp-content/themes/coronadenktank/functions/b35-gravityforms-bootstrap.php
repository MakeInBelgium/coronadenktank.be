<?php
// THEME GRAVITY FORMS  WITH BOOTSTRAP

// apply to all forms
add_filter( 'gform_field_content', function ( $field_content, $field ) {
  if (preg_match("/(<input [^>]*class=')/i",$field_content) == 0) {
    $field_content =  preg_replace( '(<input)', '<input class="form-control" ', $field_content );
  } else {
    $field_content =  preg_replace( '/(<input [^>]*class=\')/i', '$0form-control ', $field_content );
    $field_content =  preg_replace( '/<input(((?!class).)*)>/i', '<input class="form-control" $1>', $field_content );
    $field_content =  preg_replace( '(<select .*class=\')', '$0form-control ', $field_content );
    $field_content =  preg_replace( '(<textarea .*class=\')', '$0form-control ', $field_content );
  }

  return $field_content;
}, 10, 2 );

add_filter( 'gform_submit_button', function ( $button, $form ) {
  $button =  preg_replace( '(<input .*class=\')', '$0btn btn-primary form-control ', $button );
  return $button;
}, 10, 2 );

//add_filter("gform_name_first", "change_name_first", 10, 2);
//function change_name_first($label, $form_id){
//  return "";
//}
//
//add_filter("gform_name_last", "change_name_last", 10, 2);
//function change_name_last($label, $form_id){
//  return "";
//}
//
//
//add_filter("gform_address_zip_2", "change_zip", 10, 2);
//function change_zip($label, $form_id){
//  return "";
//}

// // delete entries from gravity forms
// function gravity_after_submission( $entry ) {
//   GFAPI::delete_entry( $entry['id'] );
// }
// add_action( 'gform_after_submission', 'gravity_after_submission', 10, 2 );
