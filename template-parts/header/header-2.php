<header id="masthead" class="site-header theme-header theme-header-2" role="banner">
    <div class="header-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg blog-main-nav"> 
                <a class="navbar-brand fw-bold m-0 p-0 text-truncate" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
                	<?php
                	$logo = get_theme_mod( 'custom_logo' );
                	$logo_url = wp_get_attachment_image_src( $logo , 'full' );
                	if ( has_custom_logo() )
                	{
                		echo '<img src="' . esc_url( $logo_url[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                	} else {
                		echo '<img src="'.get_template_directory_uri().'/assets/images/logo-blue.svg" >';
                	}
                	?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                	<i class="fa fa-bars"></i>
                </button>
                <?php
				wp_nav_menu(array(
					'theme_location' => 'menu-1',
					'depth' => 2,
					'container' => 'div',
					'container_id' => 'mainNav',
					'container_class' => 'collapse navbar-collapse',
					'menu_id' => false,
					'menu_class' => 'nav navbar-nav ml-auto',
					'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
					'walker' => new Bootstrap_Walker_Nav_Menu()
				));
				?>
            </nav>
        </div>
    </div>
</header>