<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'post-grid-2-big';
$article_class = 'post-card flex '.$options['post_card_class'];

// echo '<pre>'; print_r($options); echo '</pre>'; //exit;
?>

<!-- Start Post List  -->
<article id="post-<?php the_ID(); ?>" <?php post_class($article_class); ?>>
    <a href="<?php the_permalink(); ?>" class="post-img-wrap">
        <?php the_post_thumbnail($thumb_size) ?>
    </a>
    <div class="post-info-wrap">
        <div class="tag-wrap">
            <?php theme_post_category_meta(); ?>
        </div>
        <h2 class="<?= $options['title_type'] ?> post-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
        <div class="post-excerpt"><?php echo get_excerpt($options['post_excerpt_length']); ?></div>
        <div class="post-meta-wrap flex">
            <?= theme_card_authormeta() ?>
        </div>
    </div>
</article>
<!-- End Post List  -->