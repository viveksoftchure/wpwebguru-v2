<?php
/**
 * Template part for displaying main header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */

if(get_theme_mod('header_style', true )) :
	$header_style = get_theme_mod('header_style', '');
endif;

/**
 * Load Header
 */
get_template_part('template-parts/header/header', $header_style);

/**
 * Load Page Title Wrapper
 */
get_template_part('template-parts/title/title-wrapper');


?>
<!-- Start Page Wrapper -->
<div class="main-wrapper">