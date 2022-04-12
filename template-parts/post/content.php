<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpwebguru
 */
$thumb_size = 'blog-thumb';
?>

<!-- Start Post List  -->
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card flex'); ?>>
    <a href="<?php the_permalink(); ?>" class="post-img-wrap" title="<?php echo the_title(); ?>">
        <?php the_post_thumbnail($thumb_size) ?>
    </a>
    <div class="post-info-wrap">
        <div class="flex post-top-meta">
            <div class="tag-wrap"><a href="tag/lifestyle/index.html">Lifestyle</a></div>
            <div class="featured-icon" aria-label="Featured post icon"><svg><use xlink:href="#i-star"/></svg></div>
        </div>
        <h2 class="h3 post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-excerpt"><?php the_excerpt(); ?></div>
        <div class="post-meta">
            <time class="post-date" datetime="2021-05-02">May 02, 2021</time>
            <span class="read-time">3 min read</span>
            <span class="visibility">Public</span>
        </div>
    </div>
</article> 
<!-- End Post List  -->