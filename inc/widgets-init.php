<?php

/**
 * Add widgets here, like sidebar widget and footer widget
 *
 * @package WpWebGuru
 */

function wpwebguru_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'wpwebguru'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'wpwebguru'),
        'before_widget' => '<div class="%1$s single-widget %2$s mt-4">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Latest Article Sidebar', 'wpwebguru'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here.', 'wpwebguru'),
        'before_widget' => '<div class="%1$s single-widget %2$s mt-4">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

	for ($i=1; $i < 5 ; $i++) 
	{ 
		register_sidebar(
			array(
				'name' => __('Footer '.$i, 'wpwebguru'),
				'id' => 'footer-'.$i,
				'description' => __('Add widgets here', 'wpwebguru'),
                'before_widget' => '<div class="%1$s widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title title h6">',
                'after_title' => '</h3>',
			)
		);
	}
}
add_action('widgets_init', 'wpwebguru_widgets_init');