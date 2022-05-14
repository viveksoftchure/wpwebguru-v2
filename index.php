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
        <div class="row">
            <div class="col-lg-10 offset-lg-1 post-list-wrap">
                <h2 class="h4 section-title"><span>Featured posts</span></h2>
                <?php
                if ( have_posts() ) :

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/post/content', get_post_format());

                    endwhile;

                    theme_blog_pagination();

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <div class="pagination-wrap text-center" id="pagination-wrap">
                <button class="btn" id="load-more"><span>Show more posts</span></button>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area  -->
<?php
get_footer();