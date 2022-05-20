<?php
/**
 * Section 5 Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_section_5' );

function theme_customize_register_section_5( $wp_customize ) 
{
	$wp_customize->add_section( 'theme_section_5', array(
	    'title'          => esc_html__( 'Section 5', 'wpwebguru' ),
	    'description'    => esc_html__( 'Section 5 :', 'wpwebguru' ),
	    'panel'          => 'theme_homepage_panel',
	    'priority'       => 160,
	) );

    /*
    * Section display option
    */
    $wp_customize->add_setting( 'theme_section_5_display_option', array(
        'sanitize_callback'     =>  'theme_sanitize_checkbox',
        'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( 
        $wp_customize, 
        'theme_section_5_display_option', array(
            'label' => esc_html__( 'Hide / Show','wpwebguru' ),
            'section' => 'theme_section_5',
            'settings' => 'theme_section_5_display_option',
            'type'=> 'toggle',
        ) 
    ));

    /*
    * Section background color option
    */
    $wp_customize->add_setting( 'theme_section_5_background_color', array(
        'default' => '#fff',
    ));
    
    // Add Controls
    $wp_customize->add_control( new WP_Customize_Color_Control( 
        $wp_customize, 
        'theme_section_5_background_color', array(
            'label' => 'Background Color',
            'section' => 'theme_section_5',
            'settings' => 'theme_section_5_background_color'
        )
    ));

    /*
    * Section top padding option
    */
    $wp_customize->add_setting( 'theme_section_5_top_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_5_top_padding', array(
        'label' => esc_html__( 'Top Padding', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_top_padding',
        'type'=> 'number',
    ));

    /*
    * Section bottom padding option
    */
    $wp_customize->add_setting( 'theme_section_5_bottom_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_5_bottom_padding', array(
        'label' => esc_html__( 'Bottom Padding', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_bottom_padding',
        'type'=> 'number',
    ));

    /*
    * Section class option
    */
    $wp_customize->add_setting( 'theme_section_5_item_class', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_5_item_class', array(
        'label' => esc_html__( 'Item Class', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_item_class',
        'type'=> 'text',
    ));

    /*
    * Section post category option
    */
    $wp_customize->add_setting( 'theme_section_5_category', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '',
    ) );

    $wp_customize->add_control( new Theme_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'theme_section_5_category', array(
        'label' => esc_html__( 'Choose Category', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_category',
        'type'=> 'dropdown-taxonomies',
        'taxonomy'  =>  'category'
    ) ) );

    /*
    * Section post style option
    */
    $wp_customize->add_setting( 'theme_section_5_post_style', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_sanitize_select',
        'default' => 'list',
    ) );

    $wp_customize->add_control( 'theme_section_5_post_style', array(
        'type' => 'select',
        'section' => 'theme_section_5', // Add a default or your own section
        'settings' => 'theme_section_5_post_style',
        'label' => __('Post Style', 'wpwebguru'),
        'choices' => array(
            'grid' => __( 'Grid', 'wpwebguru' ),
            'featured' => __( 'Featured', 'wpwebguru' ),
            'list' => __( 'List', 'wpwebguru' ),
        ),
    ) );

    /*
    * Section post count option
    */
    $wp_customize->add_setting( 'theme_section_5_post_count', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_5_post_count', array(
        'label' => esc_html__( 'Post count', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_post_count',
        'type'=> 'number',
    ));

    /*
    * Section section title option
    */
    $wp_customize->add_setting( 'theme_section_5_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'theme_section_5_title', array(
        'label' => esc_html__( 'Title', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_title',
        'type'=> 'text',
    ) );

    /*
    * Section title type option
    */
    $wp_customize->add_setting( 'theme_section_5_title_type', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'theme_sanitize_select',
        'default' => 'h2',
    ) );

    $wp_customize->add_control( 'theme_section_5_title_type', array(
        'type' => 'select',
        'section' => 'theme_section_5', // Add a default or your own section
        'settings' => 'theme_section_5_title_type',
        'label' => __('Title Type', 'wpwebguru'),
        'choices' => array(
            'h1' => __( 'H1', 'wpwebguru' ),
            'h2' => __( 'H2', 'wpwebguru' ),
            'h3' => __( 'H3', 'wpwebguru' ),
            'h4' => __( 'H4', 'wpwebguru' ),
            'h5' => __( 'H5', 'wpwebguru' ),
            'h6' => __( 'H6', 'wpwebguru' ),
        ),
    ) );

    /*
    * Section Description
    */
    $wp_customize->add_setting( 'theme_section_5_desc', array(
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ));

    $wp_customize->add_control( 'theme_section_5_desc', array(
        'label' => esc_html__( 'Section Description', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_desc',
        'type'=> 'text',
    ));

    /*
    * Section post excerpt length
    */
    $wp_customize->add_setting( 'theme_section_5_post_excerpt_length', array(
        'default'               =>  '80'
    ) );

    $wp_customize->add_control( 'theme_section_5_post_excerpt_length', array(
        'label' => esc_html__( 'Post excerpt length', 'wpwebguru' ),
        'section' => 'theme_section_5',
        'settings' => 'theme_section_5_post_excerpt_length',
        'type'=> 'number',
    ));

    $wp_customize->selective_refresh->add_partial( 'theme_section_5_display_option', array(
	    'selector' => '.blogs > .container',
	) );

}