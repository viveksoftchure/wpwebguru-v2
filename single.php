<?php

/**
 * The template for displaying all single posts
 *
 * @package WpWebGuru
 */
get_header();
?>
	<?php if (have_posts()) :
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content-single', get_post_type() );

			// theme_the_post_navigation();

		endwhile;
	endif; ?>
<?php
get_footer();
?>