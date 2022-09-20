<?php

$post_type = 'post';

global $userdata;

$userdata = get_userdata( $userdata->ID ); //wp 3.3 fix

$bookmarkdata = user_bookmarkes();

global $post;

$pagenum = isset( $_GET['pagenum'] ) ? intval( wp_unslash( $_GET['pagenum'] ) ) : 1;
$action = isset( $_REQUEST['action'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : '';

if ($bookmarkdata) {

    $featured_img_size = 'thumbnail';
    ?>
    <div class="items-table-container">
        <table class="items-table <?php echo esc_attr( $post_type ); ?>" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="items-list-header">
                    <?php
                        echo wp_kses_post( '<th>' . __( 'Featured Image', 'wp-user-frontend' ) . '</th>' );
                    ?>
                    <th><?php esc_html_e( 'Title', 'wp-user-frontend' ); ?></th>
                    <th><?php esc_html_e( 'Status', 'wp-user-frontend' ); ?></th>

                    <?php do_action( 'wpwg_account_posts_head_col', $args ); ?>


                    <th><?php esc_html_e( 'Options', 'wp-user-frontend' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($bookmarkdata as $key => $bookmark) {

                    $post = get_post( $bookmark['post_id'] );

                    if ( $post ) { 
                        $title  = $post->post_title;
                        ?>
                        <tr>
                            <td data-label="<?php esc_attr_e( 'Featured Image: ', 'wp-user-frontend' ); ?>">
                                <?php
                                echo $show_link ? wp_kses_post( '<a href="' . get_permalink( $post->ID ) . '">' ) : '';

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

                            </td>
                            <td data-label="<?php esc_attr_e( 'Options: ', 'wp-user-frontend' ); ?>" class="data-column"></td>
                        </tr>
                        <?php
                    }
                }

                wp_reset_postdata();
                ?>
            </tbody>
        </table>
    </div>

    <div class="wpwg-pagination">
        <?php
        $pagination = paginate_links( [
            'base'      => add_query_arg( 'pagenum', '%#%' ),
            'format'    => '',
            'prev_text' => __( '&laquo;', 'wp-user-frontend' ),
            'next_text' => __( '&raquo;', 'wp-user-frontend' ),
            'total'     => $dashboard_query->max_num_pages,
            'current'   => $pagenum,
            'add_args'  => false,
        ] );

        if ( $pagination ) {
            echo wp_kses( $pagination, [
                'span' => [
                    'aria-current' => [],
                    'class' => [],
                ],
                'a' => [
                    'href' => [],
                    'class' => [],
                ]
            ] );
        }
        ?>
    </div>
    <?php
} else {
    printf( '<div class="wpwg-message">' . esc_attr( __( 'No %s found', 'wp-user-frontend' ) ) . '</div>', esc_html( $post_type_obj->label ) );
}
wp_reset_postdata();