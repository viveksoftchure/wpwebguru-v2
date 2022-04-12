<?php
/**
 * Categories Settings
 *
 * @package wpwebguru
 */

add_action( 'customize_register', 'theme_customize_register_categories' );

function theme_customize_register_categories( $wp_customize ) 
{
	$wp_customize->add_section( 'categories', array(
	    'title'          => esc_html__( 'Categories', 'wpwebguru' ),
	    'description'    => esc_html__( 'Categories :', 'wpwebguru' ),
	    'panel'          => 'theme_homepage_panel',
	    'priority'       => 160,
	));

    /*
    * Section display option
    */
    $wp_customize->add_setting( 'categories_display_option', array(
          'sanitize_callback'     =>  'theme_sanitize_checkbox',
          'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( $wp_customize, 
        'categories_display_option', 
        array(
            'label' => esc_html__( 'Hide / Show','wpwebguru' ),
            'section' => 'categories',
            'settings' => 'categories_display_option',
            'type'=> 'toggle',
        ) 
    ));

    /*
    * Section background color option
    */
    $wp_customize->add_setting( 'categories_background_color', array(
        'default' => '#fff',
    ));
    
    // Add Controls
    $wp_customize->add_control( new WP_Customize_Color_Control( 
        $wp_customize, 
        'categories_background_color', array(
            'label' => 'Background Color',
            'section' => 'categories',
            'settings' => 'categories_background_color'
        )
    ));

    /*
    * Section top padding option
    */
    $wp_customize->add_setting( 'categories_top_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'categories_top_padding', array(
        'label' => esc_html__( 'Top Padding', 'wpwebguru' ),
        'section' => 'categories',
        'settings' => 'categories_top_padding',
        'type'=> 'number',
    ));

    /*
    * Section bottom padding option
    */
    $wp_customize->add_setting( 'categories_bottom_padding', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'categories_bottom_padding', array(
        'label' => esc_html__( 'Bottom Padding', 'wpwebguru' ),
        'section' => 'categories',
        'settings' => 'categories_bottom_padding',
        'type'=> 'number',
    ));

    /*
    * Section class option
    */
    $wp_customize->add_setting( 'categories_item_class', array(
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'categories_item_class', array(
        'label' => esc_html__( 'Item Class', 'wpwebguru' ),
        'section' => 'categories',
        'settings' => 'categories_item_class',
        'type'=> 'text',
    ));

    /*
    * Section post category option
    */
    $wp_customize->add_setting( 'categories_category', array(
        'capability'  => 'edit_theme_options',       
        'default'     => array(),
    ));

    $wp_customize->add_control( new Theme_Customize_Control_Multiple_Select( 
        $wp_customize, 
        'categories_category', 
        array(
            'label' => esc_html__( 'Choose Category', 'wpwebguru' ),
            'section' => 'categories',
            'settings' => 'categories_category',
            'type'=> 'multiple-taxonomies',
            'taxonomy'  =>  'category'
        ) 
    ));

    /*
    * Section title option
    */
    $wp_customize->add_setting( 'categories_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'categories_title', array(
        'label' => esc_html__( 'Title', 'wpwebguru' ),
        'section' => 'categories',
        'settings' => 'categories_title',
        'type'=> 'text',
    ) );

    /*
    * Section Description
    */
    $wp_customize->add_setting( 'categories_desc', array(
        'sanitize_callback'     =>  'sanitize_text_field',
        'default'               =>  ''
    ));

    $wp_customize->add_control( 'categories_desc', array(
        'label' => esc_html__( 'Section Description', 'wpwebguru' ),
        'section' => 'categories',
        'settings' => 'categories_desc',
        'type'=> 'text',
    ));

    /*
    * Section post count show option
    */
    $wp_customize->add_setting( 'categories_show_count', array(
        'sanitize_callback'     =>  'theme_sanitize_checkbox',
        'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( 
        $wp_customize, 
        'categories_show_count', array(
        'label' => esc_html__( 'Show count','wpwebguru' ),
            'section' => 'categories',
            'settings' => 'categories_show_count',
            'type'=> 'toggle',
        )
    ));

    /*
    * Section hide empty category option
    */
    $wp_customize->add_setting( 'categories_hide_empty_category', array(
        'sanitize_callback'     =>  'theme_sanitize_checkbox',
        'default'               =>  true
    ));

    $wp_customize->add_control( new Theme_Toggle_Control( 
        $wp_customize, 
        'categories_hide_empty_category', array(
        'label' => esc_html__( 'Hide empty category','wpwebguru' ),
            'section' => 'categories',
            'settings' => 'categories_hide_empty_category',
            'type'=> 'toggle',
        )
    ));

    /*
    * Section post orderby option
    */
    $wp_customize->add_setting( 'categories_orderby', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'themeslug_sanitize_select',
        'default' => 'Name',
    ) );

    $wp_customize->add_control( 'categories_orderby', array(
        'type' => 'select',
        'section' => 'categories', // Add a default or your own section
        'label' => __('Post Ordering', 'wpwebguru'),
        'choices' => array(
            'id' => __( 'ID', 'wpwebguru' ),
            'Count' => __( 'Count', 'wpwebguru' ),
            'Name' => __( 'Name', 'wpwebguru' ),
            'Slug' => __( 'Slug', 'wpwebguru' ),
        ),
    ) );

    /*
    * Section post order option
    */
    $wp_customize->add_setting( 'categories_order', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'themeslug_sanitize_select',
        'default' => 'ASC',
    ) );

    $wp_customize->add_control( 'categories_order', array(
        'type' => 'select',
        'section' => 'categories', // Add a default or your own section
        'label' => __('Ordering', 'wpwebguru'),
        'choices' => array(
            'ASC' => __( 'ASC', 'wpwebguru' ),
            'DESC' => __( 'DESC', 'wpwebguru' ),
        ),
    ) );


    $wp_customize->selective_refresh->add_partial( 'categories_display_option', array(
	    'selector' => '.blogs > .container',
	) );

}