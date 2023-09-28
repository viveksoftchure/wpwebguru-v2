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

	// Google Font - Rubik
	//wp_enqueue_style('rubik', 'https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap', array());

	// wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), time());

	if( is_singular() ) {
		wp_enqueue_style( 'prettify', get_template_directory_uri() . '/assets/css/prettify/desert.css' );
		wp_enqueue_script( 'prettify', get_template_directory_uri() . '/assets/js/prettify/prettify.js', array( 'jquery' ), '1.0.0', true );
	}
	
	// Main JS
	// wp_enqueue_script('main_js', get_template_directory_uri() . '/assets/js/main.js#asyncload', array('jquery'), time(), true);
 //    wp_localize_script( 'main_js', 'ajax_posts', array(
	// 	'js_option' => ['load_more' => '6','posts_per_page' => '10'],
	// 	'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
	// ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) 
	{
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_home() && is_front_page()) {
		wp_dequeue_style('post-views-counter-frontend');
	}
	

	wp_enqueue_script( 'jquery' );

	// Remove Block Styles
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('dashicons');
	wp_dequeue_style('classic-theme-styles');
	// wp_dequeue_script('wp-embed');
	wp_deregister_script('wp-embed');
	wp_deregister_script('jquery');
	
	if(!is_page('contact-us') )    
	{		
		wp_dequeue_script('contact-form-7'); // Dequeue JS Script file.
		wp_dequeue_style('contact-form-7');  // Dequeue CSS file. 
	}

	wp_enqueue_style( 'theme-googlefonts', 'https://fonts.googleapis.com/css?family=' . esc_attr( $body_font_family ) . ':200,300,400,500,600,700,800,900|' . esc_attr( $heading_font_family ) . ':200,300,400,500,600,700,800,900|' . esc_attr( $site_identity_font_family ) . ':200,300,400,500,600,700,800,900|' );

}
add_action('wp_enqueue_scripts', 'wpwebguru_enqueue_scripts');




function add_async_forscript($url)
{
    if (strpos($url, '#asyncload')===false)
        return $url;
    else if (is_admin())
        return str_replace('#asyncload', '', $url);
    else
        return str_replace('#asyncload', '', $url)."' async='async"; 
}
add_filter('clean_url', 'add_async_forscript', 11, 1);





/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}