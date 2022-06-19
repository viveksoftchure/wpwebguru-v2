<?php
/**
 * section 6 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'tab-post-thumb';
?>
<?php 
if( get_theme_mod('theme_section_6_display_option', true )) :
	$section_title = get_theme_mod('theme_section_6_title', '');
	$section_title_type = get_theme_mod('theme_section_6_title_type', 'h2');
	$section_desc = get_theme_mod('theme_section_6_desc', '');

	$bgcolor = get_theme_mod('theme_section_6_background_color', '#fff');
	$top_padding = get_theme_mod('theme_section_6_top_padding', '0');
	$bottom_padding = get_theme_mod('theme_section_6_bottom_padding', '0');
	$item_class = get_theme_mod( 'theme_section_6_item_class', '' );
	
	$post_details = array('date', 'categories', 'tags') ;

    $blog_paged = (get_query_var('page') ) ? get_query_var('page') : 1;
    $blog_cat = get_theme_mod('theme_section_6_category') ;
    $posts_per_page = get_theme_mod('theme_section_6_post_count', 4);
    $posts_style = get_theme_mod('theme_section_6_post_style', 'list');
    $post_excerpt_length = get_theme_mod('theme_section_6_post_excerpt_length', 80);

    $args = array(
        'post_type'				=> 'post',
        'category_name'			=>  $blog_cat ,
        'posts_per_page'		=>  $posts_per_page,
        'ignore_sticky_posts'	=> 1,
        'paged'					=> $blog_paged
    );
    $query = new WP_Query( $args );
    $max_pages = $query->max_num_pages;

    $options = [
    	'item_class' => $item_class,
    	'title_type' => $section_title_type,
    	'post_excerpt_length' => $post_excerpt_length,
    	'post_card_class' => '',
    ];

    if ( $query->have_posts() ) 
    {
    	$i = 1;
		?>
    	<section class="blog-category-posts featured-post-layout-one" style="background-color: <?= $bgcolor ?>;padding: <?= $top_padding ?>px 0px <?= $bottom_padding ?>px;">
			<div class="container">
				<div class="row">
					<div class="blog-category-posts-head col-xl-12">
						<?php if(!empty($section_title))
						{ 
							global $_wp_additional_image_sizes; 
							// echo '<pre>'; print_r($_wp_additional_image_sizes); echo '</pre>'; //exit;
							?>
							<h2 class="h4 section-title"><span><?php echo esc_html($section_title); ?></span></h2>
		                    <p class="section-desc"><?php echo esc_html($section_desc); ?></p>
							<?php 
						} ?>
					</div>
					<?php if ($posts_style=='grid'): ?>
						<div class="grid gap-6 md-gap-8 md-grid-cols-2 lg-grid-cols-3">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php include(locate_template('template-parts/post-card/post-card-1.php', false, false)); ?>
							<?php endwhile; ?>  
						</div>
					<?php elseif ($posts_style=='featured'): ?>
						<div class="grid grid-cols-1 lg-grid-cols-2 gap-6 md-gap-8">
							<div class="overflow-hidden h-full">
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<?php $options['post_card_class'] = 'post-big big-thumbnail'; ?>
									<?php if($i==1): ?>
										<?php include(locate_template('template-parts/post-card/post-card-1.php', false, false)); ?>
									<?php endif; ?>
									<?php $i++; ?>
								<?php endwhile; ?>
							</div>
							<div class="grid gap-6 md-gap-8 small-posts-wrap">
								<?php $i=1; ?>
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<?php if($i!=1): ?>
										<?php include(locate_template('template-parts/post-card/post-card-2.php', false, false)); ?>
									<?php endif; ?>
									<?php $i++; ?>
								<?php endwhile; ?>
							</div>
						</div>
					<?php else: ?>
						<div class="col-xs-12">
							<?php $options['post_card_class'] = 'post-list'; ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php get_template_part( 'template-parts/post/content', get_post_format()); ?>
							<?php endwhile; ?>  
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php 
	} 
endif; 