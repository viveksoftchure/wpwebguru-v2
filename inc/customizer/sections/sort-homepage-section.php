<?php

/**
 * Rearrange Sections
 *
 * @package bootstrap_coach
 */
add_action( 'customize_register', 'theme_sort_homepage_sections' );
function theme_sort_homepage_sections( $wp_customize )
{
    $wp_customize->add_section( 'theme_sort_homepage_sections', array(
        'title'    => esc_html__( 'Rearrange Home Sections', 'wpwebguru' ),
        'panel'    => '',
        'priority' => 13,
    ) );
    
    $default = array(
        'section-1',
        'section-2',
        'section-3',
        'section-4',
        'section-5',
        'section-6',
    );
    $choices = array(
        'section-1'         => esc_html__( 'Section 1', 'wpwebguru' ),
        'section-2'         => esc_html__( 'Section 2', 'wpwebguru' ),
        'section-3'         => esc_html__( 'Section 3', 'wpwebguru' ),
        'section-4'         => esc_html__( 'Section 4', 'wpwebguru' ),
        'section-5'         => esc_html__( 'Section 5', 'wpwebguru' ),
        'section-6'         => esc_html__( 'Section 6', 'wpwebguru' ),
    );
    
    
    $wp_customize->add_setting( 'theme_sort_homepage', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'theme_sanitize_array',
        'default'           => $default,
    ) );
    $wp_customize->add_control( new Theme_Control_Sortable( 
        $wp_customize, 
        'theme_sort_homepage', array(
            'label'   => esc_html__( 'Drag and Drop Sections to rearrange.', 'wpwebguru' ),
            'section' => 'theme_sort_homepage_sections',
            'type'    => 'sortable',
            'choices' => $choices,
        ) 
    ));
}
