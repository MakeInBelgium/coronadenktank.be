<?php 
// Disable access to author page
add_action('template_redirect', 'my_custom_disable_author_page');

function my_custom_disable_author_page() {
    global $wp_query;

    if ( is_author() ) {
        $wp_query->set_404();
        status_header(404);
        // Redirect to homepage
        // wp_redirect(get_option('home'));
    }
}
