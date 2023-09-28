<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'post-grid-2-big';
$article_class = 'post-list post-list-1';
$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
$base64_image = convert_image_to_base64($featured_img_url);
// echo '<pre>'; print_r($options); echo '</pre>'; //exit;
?>

<!-- Start Post List  -->
<article id="post-<?php the_ID(); ?>" <?php post_class($article_class); ?>>
    <a href="<?php the_permalink(); ?>" class="post-img-wrap">
        <img src="<?= $base64_image ?>" class="" alt="<?= the_title(); ?>">
        <?php //the_post_thumbnail() ?>
    </a>
    <div class="post-info-wrap">
        <div class="tag-wrap">
            <?php theme_post_category_meta(); ?>
        </div>
        <h2 class="<?= $options['title_type'] ?> post-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
        <div class="post-excerpt"><?php echo get_excerpt(160); ?></div>
        <div class="post-meta-wrap">
            <?= theme_card_authormeta() ?>
        </div>
    </div>
</article>
<!-- End Post List  -->