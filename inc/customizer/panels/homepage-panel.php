<?php
/**
 * Homepage Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_homepage_panel' );

function theme_customize_register_homepage_panel( $wp_customize ) 
{
	$wp_customize->add_panel( 'theme_homepage_panel', array(
	    'title'       => esc_html__( 'Home page Options', 'wpwebguru' ),
        'capability' => 'edit_theme_options',
        'priority'    => 11,
	) );
}