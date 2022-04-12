<?php
/**
 * Theme color Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_theme_color_panel' );

function theme_customize_register_theme_color_panel( $wp_customize ) 
{
	$wp_customize->add_panel( 'theme_color_panel', array(
	    'title'       => esc_html__( 'Theme colors', 'wpwebguru' ),
        'capability' => 'edit_theme_options',
        'priority'    => 11,
	) );
}