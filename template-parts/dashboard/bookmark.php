<?php

$post_type = 'post';

global $userdata;

$userdata = get_userdata( $userdata->ID ); //wp 3.3 fix

$bookmarkdata = user_bookmarkes();
global $post;

if ($bookmarkdata) {
    $featured_img_size = 'thumbnail';
    ?>
    <div class="items-table-container">
        <table class="items-table bookmark-table <?php echo esc_attr( $post_type ); ?>" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="items-list-header">
                    <th></th>
                    <th><?php esc_html_e( 'Title', 'wp-user-frontend' ); ?></th>
                    <th><?php esc_html_e( 'Updated Time', 'wp-user-frontend' ); ?></th>
                    <th><?php esc_html_e( 'Options', 'wp-user-frontend' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($bookmarkdata as $key => $bookmark) {

                    $post_id = isset($bookmark['post_id']) ? $bookmark['post_id'] : 0;
                    $post = get_post( $post_id );

                    if ( $post ) { 
                        $title  = $post->post_title;
                        ?>
                        <tr>
                            <td data-label="<?php esc_attr_e( 'Featured Image: ', 'wp-user-frontend' ); ?>">
                                <?php
                                echo $show_link ? wp_kses_post( '<a href="' . get_permalink( $post_id ) . '">' ) : '';

                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( $featured_img_size );
                                } else {
                                    printf( '<img src="%1$s" class="attachment-thumbnail wp-post-image" alt="%2$s" title="%2$s" />', esc_attr( apply_filters( 'wpwg_no_image', plugins_url( '../assets/images/no-image.png', __DIR__ ) ) ), esc_html( __( 'No Image', 'wp-user-frontend' ) ) );
                                }

                                echo $show_link ? '</a>' : '';
                                ?>
                            </td>
                            <td data-label="<?php esc_attr_e( 'Title: ', 'wp-user-frontend' ); ?>" class="<?php echo 'on' === $featured_img ? 'data-column' : '' ; ?>">
                                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-user-frontend' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a>
                            </td>
                            <td data-label="<?php esc_attr_e( 'Status: ', 'wp-user-frontend' ); ?>" class="data-column">
                                <?= get_post_field( 'post_modified', $post_id ); ?>
                            </td>
                            <td data-label="<?php esc_attr_e( 'Options: ', 'wp-user-frontend' ); ?>" class="data-column">
                                <a class="bookmark-btn bookmarked" data-action="deletebookmark" data-post="<?= $post_id ?>" data-bookmark-active="true" data-item="true" title="Remove from Favorites" aria-label="Remove from Favorites"><i class="fas fa-trash-alt"></i></a>
                                <a class="button pf-view-item-button wpf-transition-all" href="<?php the_permalink(); ?>" title="View"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }

                wp_reset_postdata();
                ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    ?>
    <div class="notification warning">
        <p><i class="fas fa-info-circle"></i> We couldn't find a favorite record.</p>
    </div>
    <?php
}
wp_reset_postdata();