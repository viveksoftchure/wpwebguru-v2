<?php
/**
 * Section 4 Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_section_4' );

function theme_customize_register_section_4( $wp_customize ) 
{
	$wp_customize->add_section( 'theme_section_4', array(
	    'title'          => esc_html__( 'Section 4', 'wpwebguru' ),
	    'description'    => esc_html__( 'Section 4 :', 'wpwebguru' ),
	    'panel'          => 'theme_homepage_panel',
	    'priority'       => 160,
	) );

    /*
    * Section display option
    */
    $wp_customize->add_setting( 'theme_section_4_display_option', array(
        'sanitize_callback'     =>  'theme_sanitize_checkbox',
        'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( 
        $wp_customize, 
        'theme_section_4_display_option', array(
            'label' => esc_html__( 'Hide / Show','wpwebguru' ),
            'section' => 'theme_section_4',
            'settings' => 'theme_section_4_display_option',
            'type'=> 'toggle',
        ) 
    ));

    /*
    * Section background color option
    */
    $wp_customize->add_setting( 'theme_section_4_background_color', array(
        'default' => '#fff',
    ));
    
    // Add Controls
    $wp_customize->add_control( new WP_Customize_Color_Control( 
        $wp_customize, 
        'theme_section_4_background_color', array(
            'label' => 'Background Color',
            'section' => 'theme_section_4',
            'settings' => 'theme_section_4_background_color'
        )
    ));

    /*
    * Section top padding option
    */
    $wp_customize->add_setting( 'theme_section_4_top_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_4_top_padding', array(
        'label' => esc_html__( 'Top Padding', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_top_padding',
        'type'=> 'number',
    ));

    /*
    * Section bottom padding option
    */
    $wp_customize->add_setting( 'theme_section_4_bottom_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_4_bottom_padding', array(
        'label' => esc_html__( 'Bottom Padding', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_bottom_padding',
        'type'=> 'number',
    ));

    /*
    * Section class option
    */
    $wp_customize->add_setting( 'theme_section_4_item_class', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_4_item_class', array(
        'label' => esc_html__( 'Item Class', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_item_class',
        'type'=> 'text',
    ));

    /*
    * Section post category option
    */
    $wp_customize->add_setting( 'theme_section_4_category', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '',
    ) );

    $wp_customize->add_control( new Theme_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'theme_section_4_category', array(
        'label' => esc_html__( 'Choose Category', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_category',
        'type'=> 'dropdown-taxonomies',
        'taxonomy'  =>  'category'
    ) ) );

    $wp_customize->add_setting( 'theme_section_4_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_4_title', array(
        'label' => esc_html__( 'Title', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_title',
        'type'=> 'text',
    ) );

    /*
    * Section Description
    */
    $wp_customize->add_setting( 'theme_section_4_desc', array(
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ));

    $wp_customize->add_control( 'theme_section_4_desc', array(
        'label' => esc_html__( 'Section Description', 'wpwebguru' ),
        'section' => 'theme_section_4',
        'settings' => 'theme_section_4_desc',
        'type'=> 'text',
    ));

    $wp_customize->selective_refresh->add_partial( 'theme_section_4_display_option', array(
	    'selector' => '.blogs > .container',
	) );

}