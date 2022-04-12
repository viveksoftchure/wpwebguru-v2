<?php
/**
 * section 5 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'tab-post-thumb';
?>
<?php 
if( get_theme_mod( 'latest_articles_display', true ) ) :

	$section_title = get_theme_mod( 'latest_articles_title', '' );
	$section_desc = get_theme_mod( 'latest_articles_desc', '' );

	$bgcolor = get_theme_mod( 'latest_articles_background_color', '' );
	$top_padding = get_theme_mod( 'latest_articles_top_padding', '' );
	$bottom_padding = get_theme_mod( 'latest_articles_bottom_padding', '' );
	
	$post_details = array( 'date', 'categories', 'tags' ) ;

    $blog_paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $blog_cat = get_theme_mod( 'latest_articles_category' ) ;
    $args = array(
        'post_type' => 'post',
        'category_name'       =>  $blog_cat ,
        'posts_per_page'    =>  '3',
        'ignore_sticky_posts' => 1 ,
        'paged'     => $blog_paged
    );
    $query = new WP_Query( $args );
    $max_pages = $query->max_num_pages;

    if ( $query->have_posts() ) 
    {
		?>
    <section class="blog-category-posts" style="background-color: <?= $bgcolor ?>;padding: <?= $top_padding ?>px 0px <?= $bottom_padding ?>px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="blog-category-posts-head col-xs-12 mb-5">
							<?php if(!empty($section_title))
							{ 
								?>
								<h2 class="title"><?php echo esc_html($section_title); ?></h2>
								<span><?php echo esc_html($section_desc); ?></span>
								<?php 
							} ?>
						</div>
						<div class="grid gap-6 md-gap-8 ">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php $thumb_size = 'post-grid-1'; ?>
								<?php get_template_part( 'template-parts/post-card/post-card', '1' ); ?>
							<?php endwhile; ?>  
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
					<div class="col-lg-4">
						<?php if (is_active_sidebar('sidebar-2')) : ?>
				            <aside class="widget-area row gy-3 justify-content-between">
				                <?php dynamic_sidebar('sidebar-2'); ?>
				            </aside><!-- .widget-area -->
					    <?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php 
	} 
endif; 