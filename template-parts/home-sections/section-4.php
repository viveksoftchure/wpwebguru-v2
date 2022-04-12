<?php
/**
 * section 4 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'tab-post-thumb';
?>
<?php 
if( get_theme_mod( 'theme_section_4_display_option', true ) ) :
	$section_title = get_theme_mod( 'theme_section_4_title', '' );
	$section_desc = get_theme_mod( 'theme_section_4_desc', '' );

	$bgcolor = get_theme_mod( 'theme_section_4_background_color', '' );
	$top_padding = get_theme_mod( 'theme_section_4_top_padding', '' );
	$bottom_padding = get_theme_mod( 'theme_section_4_bottom_padding', '' );
	$item_class = get_theme_mod( 'theme_section_4_item_class', '' );
	
	$post_details = array( 'date', 'categories', 'tags' ) ;

    $blog_paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $blog_cat = get_theme_mod( 'theme_section_4_category' ) ;
    $args = array(
        'post_type' => 'post',
        'category_name'       =>  $blog_cat ,
        'posts_per_page'    =>  '3',
        'ignore_sticky_posts' => 1 ,
        'paged'     => $blog_paged
    );
    $query = new WP_Query( $args );
    $max_pages = $query->max_num_pages;

    $options = array(
    	'item_class' => $item_class,
    );
    // echo '<pre>'; print_r($options); echo '</pre>';

    if ( $query->have_posts() ) 
    {
		?>
    <section class="blog-category-posts" style="background-color: <?= $bgcolor ?>;padding: <?= $top_padding ?>px 0px <?= $bottom_padding ?>px;">
			<div class="container">
				<div class="blog-category-posts-head col-xs-12">
					<?php if(!empty($section_title))
					{ 
						?>
						<h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
	                    <p class="section-desc"><?php echo esc_html($section_desc); ?></p>
						<?php 
					} ?>
				</div>
				<div class="grid gap-6 md-gap-8 md-grid-cols-2 lg-grid-cols-3">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php 
						include( locate_template( 'template-parts/post-card/post-card-2.php', false, false ) ); 
						// get_template_part( 'template-parts/post-card/post-card', '2', $options ); 
						?>
					<?php endwhile; ?>  
				</div>
				<?php wp_reset_postdata(); ?>
			</div>
		</section>
		<?php 
	} 
endif; 