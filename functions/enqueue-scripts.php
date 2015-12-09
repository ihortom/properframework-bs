<?php
/* 
 * Link to the required javascript files and stylesheets in the controlled manner
 */
add_action( 'wp_enqueue_scripts', 'pweb_scripts_and_styles' );

function pweb_scripts_and_styles() {
    
    // Removes WP version of jQuery
    wp_deregister_script('jquery');
	
    wp_enqueue_script( 
        'jquery', 
        get_template_directory_uri() . '/js/vendor/jquery.min.js',
        array(), '2.1.4', true 
    );
    
    wp_enqueue_script( 
        'bootstrap', 
        get_template_directory_uri() . '/js/bootstrap.min.js', 
        array( 'jquery' ), '3.3.6', true 
    );

    wp_enqueue_script( 
        'site-js', 
        get_template_directory_uri() . '/js/app.js',
        array( 'jquery' ), '', true 
    );
    
    wp_enqueue_style(
        'bootstrap', 
        get_template_directory_uri().'/css/bootstrap.min.css'
    );

    wp_enqueue_style(
        'site-css', 
        get_stylesheet_directory_uri().'/style.css'
    );
}

?>
