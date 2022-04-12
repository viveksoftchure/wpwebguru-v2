<?php

/**
 * Connect stylesheets & scripts
 *
 * @package WpWebGuru
 */

function wpwebguru_enqueue_scripts()
{
    $body_font_family = get_theme_mod( 'body_font_family', 'Nunito' );
    $heading_font_family = get_theme_mod( 'heading_font_family', 'Merriweather' );
    $site_identity_font_family = esc_attr( get_theme_mod( 'bs_site_identity_font_family', 'Merriweather' ) );

	// Style CSS
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), time());

	wp_enqueue_style( 'theme-googlefonts', 'https://fonts.googleapis.com/css?family=' . esc_attr( $body_font_family ) . ':200,300,400,500,600,700,800,900|' . esc_attr( $heading_font_family ) . ':200,300,400,500,600,700,800,900|' . esc_attr( $site_identity_font_family ) . ':200,300,400,500,600,700,800,900|' );

	// Google Font - Rubik
	//wp_enqueue_style('rubik', 'https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap', array());

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), time());

	// Main JS
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), time(), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) 
	{
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery' );

	// Remove Block Styles
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	// wp_dequeue_script('wp-embed');
	wp_deregister_script('wp-embed');
	// wp_deregister_script('jquery');

}
add_action('wp_enqueue_scripts', 'wpwebguru_enqueue_scripts');