<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'post-grid-2-big';
?>

<!-- Start Post List  -->
<div id="post-<?php the_ID(); ?>" <?php post_class('post-card post-card-2 post-card-2-big'); ?>>
    <?php if(has_post_thumbnail()) : ?>
        <div class="post-card-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
                <?php the_post_thumbnail($thumb_size) ?>
            </a>
        </div>
    <?php endif; ?>
    <div class="post-card-content">
        <?php theme_post_category_meta(); ?>
        <h3 class="post-card-title line-clamp-2">
            <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="post-card-excerpt line-clamp-2"><?php echo get_excerpt(80); ?></div>
        <?php theme_card_authormeta(); ?>
        <?php theme_card_postmeta(); ?>
    </div>
</div>
<!-- End Post List  -->