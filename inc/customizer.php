<?php

/**
 * relax spa Theme Customizer
 *
 * @package wpwebguru
 */
$panels = array('homepage-panel','theme-panel');

if ( !empty($panels) ) 
{
    foreach ( $panels as $panel ) 
    {
        require get_template_directory() . '/inc/customizer/panels/' . $panel . '.php';
    }
}

$theme_homepage_sections = array(
    'section-1',
    'categories',
    'section-3',
    'section-4',
    'latest-articles',
);

if ( !empty($theme_homepage_sections) ) 
{
    foreach ( $theme_homepage_sections as $section ) 
    {
        require get_template_directory() . '/inc/customizer/sections/homepage/' . $section . '.php';
    }
}

$theme_panel_sections = array(
    'header-panel',
);

if ( !empty($theme_panel_sections) ) 
{
    foreach ( $theme_panel_sections as $section ) 
    {
        require get_template_directory() . '/inc/customizer/sections/header/' . $section . '.php';
    }
}

require get_template_directory() . '/inc/customizer/sections/sort-homepage-section.php';
require get_template_directory() . '/inc/customizer/sections/colors-fonts.php';
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_customize_preview_js()
{
    wp_enqueue_script(
        'theme_customizer',
        get_theme_file_uri( '/inc/js/customizer.js' ),
        array( 'customize-preview', 'customize-selective-refresh' ),
        time(),
        true
    );
}

add_action( 'customize_preview_init', 'theme_customize_preview_js' );
function theme_customizer_scripts()
{
    wp_enqueue_script(
        'theme_customize',
        get_template_directory_uri() . '/inc/js/customize.js',
        array( 'jquery' ),
        time(),
        true
    );
    $array = array(
        'home' => get_home_url(),
    );
    wp_localize_script( 'theme_customize', 'data', $array );
}

add_action( 'customize_controls_enqueue_scripts', 'theme_customizer_scripts' );
/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';
require get_template_directory() . '/inc/google-fonts.php';