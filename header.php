<?php

/**
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @package WpWebGuru
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> data-theme="" class="js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<?php
if(get_theme_mod('sticky_header', true )) :
	$sticky_header = get_theme_mod('sticky_header', '');
endif;
?>
<body <?php body_class('header-gradient'); ?> data-nav="<?= $sticky_header?'sticky':'' ?>">
	<div class="site-wrap">
		<?php wp_body_open(); ?>

		<header class="site-header">
		    <div class="container header-inner justify-space-between">
		        <div class="header-logo flex">
		        	<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-light-logo" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
		        		<?php
	                	$logo = get_theme_mod( 'custom_logo' );
	                	$logo_url = wp_get_attachment_image_src( $logo , 'full' );
	                	if ( has_custom_logo() )
	                	{
	                		echo '<img src="' . esc_url( $logo_url[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" width="198" height="40">';
	                	} else {
	                		echo '<img src="'.get_template_directory_uri().'/assets/images/logo-blue.svg" width="198" height="40">';
	                	}
	                	?>
		        	</a>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-dark-logo" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
					    <img src="<?= get_theme_mod('dark_logo') ?>" alt="WpWebGuru">
					</a>
				</div>
		        <input id="mobile-menu-toggle" class="mobile-menu-checkbox" type="checkbox">
		        <label for="mobile-menu-toggle" class="mobile-menu-icon" aria-label="menu toggle button">
		            <span class="line"></span>
		            <span class="line"></span>
		            <span class="line"></span>
		            <span class="sr-only">Menu toggle button</span>
		        </label>
		        <div class="header-right flex" data-theme-icon="true">
		        	<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'depth' => 2,
						'container' => 'div',
						'container_id' => 'mainNav',
						'container_class' => 'header-nav',
						'menu_id' => false,
						'menu_class' => 'header-nav-list no-style-list',
						'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
						'walker' => new Bootstrap_Walker_Nav_Menu()
					));
					?>
				    <div class="icon-items-wrap flex">
				    	<a href="#" class="nav-icon search-icon flex js-search-button" aria-label="Open search">
				    		<span><svg><use xlink:href="#i-search"/></svg></span>
				    	</a>
				    	<a href="#" class="nav-icon theme-icon flex js-toggle-dark-light" aria-label="Toggle theme">
				    		<div class="toggle-mode flex">
				    			<div class="light"><svg><use xlink:href="#i-sun"/></svg></div>
				    			<span class="dark"><svg><use xlink:href="#i-moon"/></svg></span>
				    		</div>
				    	</a>
				    </div>
				</div>
			</div>
		</header>