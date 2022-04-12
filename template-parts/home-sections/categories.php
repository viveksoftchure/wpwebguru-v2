<?php
/**
 * section 2 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'tab-post-thumb';
?>
<?php 
if( get_theme_mod( 'categories_display_option', true ) ) :

    $section_title = get_theme_mod( 'categories_title', '' );
    $section_desc = get_theme_mod( 'categories_desc', '' );

	$bgcolor = get_theme_mod( 'categories_background_color', '' );
    $top_padding = get_theme_mod( 'categories_top_padding', '' );
	$bottom_padding = get_theme_mod( 'categories_bottom_padding', '' );

	$catsArray = get_theme_mod( 'categories_category', '' );
    $blog_section_title = get_theme_mod( 'categories_title', '' );
	$blog_section_desc = get_theme_mod( 'categories_desc', '' );
	$show_count = get_theme_mod( 'categories_show_count', '' );
	$hide_empty_category = get_theme_mod( 'categories_hide_empty_category', '' );
	$orderby = get_theme_mod( 'categories_orderby', '' );
	$order = get_theme_mod( 'categories_order', '' );

    $show_count 		  	= isset($show_count) && $show_count == 'yes' ? true : false;
    $hide_empty_category  	= isset($hide_empty_category) && $hide_empty_category == 'yes' ? true : false;
    $orderby  				= isset($orderby) ? $orderby : 'name';
    $order  				= isset($order) ? $order : 'ASC';

    $categories = get_terms( array(
        'taxonomy' 			=> 'category',
        'hide_empty' 		=> $hide_empty_category,
        'slug'              => $catsArray,
        'orderby'           => $orderby,
        'order'             => $order,
    ) );

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
            <div class="row">
                <div class="col-lg-12">
                    <!-- Start List Wrapper  -->
                    <div class="list-categories categories-activation axil-slick-arrow arrow-between-side">
                        <?php

                        // echo '<pre>'; print_r($categories); echo '</pre>'; exit;
                        
                              
                        foreach( $categories as $category )
                        { 
                        	?>
                            <!-- Start Single Category  -->
                            <div class="single-cat">
                                <div class="inner">
                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                        <?php 
									    $t_id = $category->term_id;
									    $cat_meta = get_option("category_$t_id");

                                        // echo '<pre>'; print_r($cat_meta['color']); echo '</pre>'; //exit;
                                        
                                        ?>
                                        <div class="thumbnail">
                                        	<img src="<?= $cat_meta['img'] ?>" class="img-responsive">
                                        </div>
                                        <?php if ( !empty($category->name) ): ?>
                                            <div class="content">
                                                <?php if ( $show_count): ?>
                                                    <div class="category-count" style="background: <?= $cat_meta['color'] ?>;">
                                                        <span class="counter"><?php echo wp_kses_post($category->count); ?></span>
                                                    </div>
                                                <?php endif ?>
                                                <h5 class="title"><?php echo esc_html($category->name); ?></h5>
                                            </div>
                                        <?php endif ?>
                                    </a>
                                </div>
                            </div>
                            <!-- End Single Category  -->
                        	<?php 
                        } ?>
                    </div>
                    <!-- Start List Wrapper  -->
                </div>
            </div>
        </div>
    </section>
   <?php
endif; 