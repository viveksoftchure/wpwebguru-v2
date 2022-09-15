<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogar
 */

get_header();
// Get Value
$theme_blog_sidebar_class = 'col-lg-8 col-md-12 col-12 order-1 order-lg-2';
?>
<div class="main">
    <div class="container">
        <?php if ( have_posts() ): ?>

            <div class="grid gap-6 mb-4">
                <?php
                $i = 1;
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    if($i==1):
                        get_template_part('template-parts/post-list/list', 1);
                    endif;
                    $i++;
                endwhile; ?>
            </div>
            <div class="grid gap-6 md-gap-8 md-grid-cols-2 lg-grid-cols-3 post-list-wrap" id="default-posts">
                <?php
                /* Start the Loop */
                $i = 1;
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    if($i!=1):
                        get_template_part( 'template-parts/post-card/post-card', '2' );
                    endif;
                    $i++;
                endwhile;
                ?>
            </div>

        <?php else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

        <div class="col mt-4">
            <div class="pagination-wrap text-center" id="pagination-wrap">
                <button class="btn" id="more_posts" data-post-box="#default-posts" data-category="<?= $category->slug ?>"><span>Show more posts</span></button>
            </div>
        </div>
    </div>   
</div>
<!-- End Blog Area  -->
<?php
get_footer();