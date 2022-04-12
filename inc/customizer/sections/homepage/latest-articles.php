<?php
/**
 * Section 5 Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_section_5' );

function theme_customize_register_section_5( $wp_customize ) 
{
	$wp_customize->add_section( 'latest_articles', array(
	    'title'          => esc_html__( 'Latest Articles', 'wpwebguru' ),
	    'description'    => esc_html__( 'Latest articles with sidebar :', 'wpwebguru' ),
	    'panel'          => 'theme_homepage_panel',
	    'priority'       => 160,
	) );

    /*
    * Section display option
    */
    $wp_customize->add_setting( 'latest_articles_display', array(
        'sanitize_callback'     =>  'theme_sanitize_checkbox',
        'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( 
        $wp_customize, 
        'latest_articles_display', array(
            'label' => esc_html__( 'Hide / Show','wpwebguru' ),
            'section' => 'latest_articles',
            'settings' => 'latest_articles_display',
            'type'=> 'toggle',
        ) 
    ));

    /*
    * Section background color option
    */
    $wp_customize->add_setting( 'latest_articles_background_color', array(
        'default' => '#F0F2F5',
    ));
    
    // Add Controls
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'latest_articles_background_color', array(
            'label' => 'Background Color',
            'section' => 'latest_articles',
            'settings' => 'latest_articles_background_color'
        )
    ));

    /*
    * Section top padding option
    */
    $wp_customize->add_setting( 'latest_articles_top_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'latest_articles_top_padding', array(
        'label' => esc_html__( 'Top Padding', 'wpwebguru' ),
        'section' => 'latest_articles',
        'settings' => 'latest_articles_top_padding',
        'type'=> 'number',
    ));

    /*
    * Section bottom padding option
    */
    $wp_customize->add_setting( 'latest_articles_bottom_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'latest_articles_bottom_padding', array(
        'label' => esc_html__( 'Bottom Padding', 'wpwebguru' ),
        'section' => 'latest_articles',
        'settings' => 'latest_articles_bottom_padding',
        'type'=> 'number',
    ));

    /*
    * Section class option
    */
    $wp_customize->add_setting( 'latest_articles_item_class', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'latest_articles_item_class', array(
        'label' => esc_html__( 'Item Class', 'wpwebguru' ),
        'section' => 'latest_articles',
        'settings' => 'latest_articles_item_class',
        'type'=> 'text',
    ));

    /*
    * Section post category option
    */
    $wp_customize->add_setting( 'latest_articles_category', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '',
    ) );

    $wp_customize->add_control( new Theme_Customize_Dropdown_Taxonomies_Control( 
        $wp_customize, 
        'latest_articles_category', array(
            'label' => esc_html__( 'Choose Category', 'wpwebguru' ),
            'section' => 'latest_articles',
            'settings' => 'latest_articles_category',
            'type'=> 'dropdown-taxonomies',
            'taxonomy'  =>  'category'
        ) 
    ));

    /*
    * Section Title
    */
    $wp_customize->add_setting( 'latest_articles_title', array(
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ));

    $wp_customize->add_control( 'latest_articles_title', array(
        'label' => esc_html__( 'Section Title', 'wpwebguru' ),
        'section' => 'latest_articles',
        'settings' => 'latest_articles_title',
        'type'=> 'text',
    ));

    /*
    * Section Description
    */
    $wp_customize->add_setting( 'latest_articles_desc', array(
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ));

    $wp_customize->add_control( 'latest_articles_desc', array(
        'label' => esc_html__( 'Section Description', 'wpwebguru' ),
        'section' => 'latest_articles',
        'settings' => 'latest_articles_desc',
        'type'=> 'text',
    ));

    $wp_customize->selective_refresh->add_partial( 'latest_articles_display_option', array(
	    'selector' => '.blogs > .container',
	));
}