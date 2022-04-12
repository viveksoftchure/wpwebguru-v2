<?php
/**
* The template part for displaying an Author biography
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package blogar
*/
$author_id = get_the_author_meta('ID');
$author_info = get_userdata(get_the_author_meta( 'ID' ));
$author_role = implode(', ', $author_info->roles);
?>
<!-- Start Author  -->
<div class="about-author">
    <div class="media">
        <div class="thumbnail">
            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                <?php
                $axil_author_bio_avatar_size = apply_filters( 'axil_author_bio_avatar_size', 105 );
                echo get_avatar( get_the_author_meta( 'user_email' ), $axil_author_bio_avatar_size );
                ?>
            </a>
        </div>
        <div class="media-body">
            <div class="author-info">
                <h5 class="mb-0">Meet The Author</h5>
                <h5 class="title">
                    <a class="hover-flip-item-wrapper" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                        <span class="hover-flip-item">
                            <span data-text="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></span>
                        </span>
                    </a>
                </h5>
            </div>
            <div class="content">
                <?php
                if(get_the_author_meta( 'user_description' )){ ?>
                <p class="b1 description"><?php the_author_meta( 'user_description' ); ?></p>
                <?php }  ?>

            </div>
        </div>
    </div>
</div>