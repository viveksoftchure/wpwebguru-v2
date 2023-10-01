<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'post-grid-2';
$list_class = 'post-card post-small '.$item_class;
$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
$base64_image = convert_image_to_base64($featured_img_url);  
?>

<!-- Start Post List  -->
<article id="post-<?php the_ID(); ?>" <?php post_class($list_class); ?>>
    <a href="<?php the_permalink(); ?>" class="post-img-wrap skeleton">
        <img data-src="<?= $base64_image ?>" src="" class="" alt="" loading="lazy">
        <?php //the_post_thumbnail() ?>
    </a>
    <div class="post-info-wrap">
        <div class="tag-wrap">
            <?php theme_post_category_meta(); ?>
        </div>
        <h2 class="h5 post-title"><a href="<?php the_permalink(); ?>" title="<?= the_title(); ?>"><?= the_title(); ?></a></h2>
    </div>
</article>
<!-- End Post List  -->