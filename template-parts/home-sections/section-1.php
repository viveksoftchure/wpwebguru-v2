<?php
/**
 * section 1 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'tab-post-thumb';
?>
<?php 
if( get_theme_mod( 'theme_section_1_display_option', true ) ) :
	$section_title = get_theme_mod( 'theme_section_1_title', '' );
	$section_desc = get_theme_mod( 'theme_section_1_desc', '' );

	$bgcolor = get_theme_mod( 'theme_section_1_background_color', '' );
	$top_padding = get_theme_mod( 'theme_section_1_top_padding', '' );
	$bottom_padding = get_theme_mod( 'theme_section_1_bottom_padding', '' );
	
	$post_details = array( 'date', 'categories', 'tags' ) ;

    $blog_paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $blog_cat = get_theme_mod( 'theme_section_1_category' ) ;
    $args = array(
        'post_type' => 'post',
        'category_name'       =>  $blog_cat ,
        'posts_per_page'    =>  '4',
        'ignore_sticky_posts' => 1 ,
        'paged'     => $blog_paged
    );
    $query = new WP_Query( $args );
    $max_pages = $query->max_num_pages;

    if ( $query->have_posts() ) 
    {
    	$i = 1;
		?>
    <section class="blog-category-posts" style="background-color: <?= $bgcolor ?>;padding: <?= $top_padding ?>px 0px <?= $bottom_padding ?>px;">
			<div class="container">
				<div class="blog-category-posts-head col-xs-12">
					<?php if(!empty($section_title))
					{ 
						global $_wp_additional_image_sizes; 
						// echo '<pre>'; print_r($_wp_additional_image_sizes); echo '</pre>'; //exit;
						?>
						<h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
	                    <p class="section-desc"><?php echo esc_html($section_desc); ?></p>
						<?php 
					} ?>
				</div>
				<div class="grid grid-cols-1 lg-grid-cols-2 gap-6 md-gap-8">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php if($i==1): ?>
							<?php get_template_part( 'template-parts/post-card/post-card', '2-big' ); ?>
						<?php endif; ?>
						<?php $i++; ?>
					<?php endwhile; ?>
					<div class="grid gap-6 md-gap-8">
						<?php $i=1; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php if($i!=1): ?>
								<?php get_template_part( 'template-parts/post-card/post-card', '1-small' ); ?>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
		<?php 
	} 
endif; 