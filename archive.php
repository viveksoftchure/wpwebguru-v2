<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WpWebGuru
 */
get_header();
// Get Value
$theme_blog_sidebar_class = 'col-lg-8 col-md-12 col-12 order-1 order-lg-2';

$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$cat_meta = get_option("category_$cat_id");

// echo '<pre>'; print_r($cat_meta); echo '</pre>';
?>
<!-- Start Blog Area  -->
<div class="main">
    <div class="container">
        <div class="archive-cover">
            <div class="archive-cover-inner cover-tag flex has-image">
                <img class="cover-image lazy" loading="lazy" src="<?= $cat_meta['background_img'] ?>" alt="tag feature image">
                <div class="cover-content-wrapper">
                    <div class="tag-info-wrap text-center">
                        <h1 class="tag-name h2"><?= $category->name; ?></h1>
                        <div class="archive-info">
                            <span class="post-count"><?= $category->count; ?> Posts</span>
                        </div>
                        <div class="tag-description">
                            <?= $category->description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 post-list-wrap" id="archive-posts">
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
                        get_template_part( 'template-parts/post/content', get_post_format() );

                    endwhile;

                    // theme_blog_pagination();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
            </div>
        </div>
    </div>
    <?php if($category->count>10): ?>
        <div class="row">
            <div class="col">
                <div class="pagination-wrap text-center" id="pagination-wrap">
                    <button class="btn" id="more_posts" data-post-box="#archive-posts" data-category="<?= $category->slug ?>"><span>Show more posts</span></button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- End Blog Area  -->
<?php
get_footer();