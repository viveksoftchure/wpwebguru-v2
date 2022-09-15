<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'post-grid-2';
$list_class = 'post-card post-small flex '.$item_class;     
?>

<!-- Start Post List  -->
<article id="post-<?php the_ID(); ?>" <?php post_class($list_class); ?>>
    <a href="<?php the_permalink(); ?>" class="post-img-wrap">
        <?php the_post_thumbnail() ?>
    </a>
    <div class="post-info-wrap">
        <div class="tag-wrap">
            <?php theme_post_category_meta(); ?>
        </div>
        <h2 class="h5 post-title"><a href="<?php the_permalink(); ?>" title="<?= the_title(); ?>"><?= the_title(); ?></a></h2>
    </div>
</article>
<!-- End Post List  -->