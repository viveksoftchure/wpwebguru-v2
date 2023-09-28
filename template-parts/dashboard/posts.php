<?php

$post_type = $_GET['section'];

global $userdata;

$userdata = get_userdata( $userdata->ID ); //wp 3.3 fix

global $post;

$pagenum = isset( $_GET['pagenum'] ) ? intval( wp_unslash( $_GET['pagenum'] ) ) : 1;
$action = isset( $_REQUEST['action'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : '';
// delete post
if ( $action == 'del' ) {
    $nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_key( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';

    if ( isset( $nonce ) && !wp_verify_nonce( $nonce, 'wpwg_del' ) ) {
        return ;
    }

    //check, if the requested user is the post author
    $pid  = isset( $_REQUEST['pid'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['pid'] ) ) : '';
    $type = isset( $_REQUEST['section'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['section'] ) ) : '';
    $maybe_delete = get_post( $pid );

    if ( ( $maybe_delete->post_author == $userdata->ID ) || current_user_can( 'delete_others_pages' ) ) {
        wp_trash_post( $pid );

        //redirect
        $redirect = add_query_arg( [ 'section' => $type, 'msg' => 'deleted'], get_permalink() );
        wp_redirect( $redirect );
        exit;
    } else {
        echo wp_kses_post( '<div class="error">' . __( 'You are not the post author. Cheating huh!', 'wp-user-frontend' ) . '</div>' );
    }
}

// show delete success message
$msg = isset( $_GET['msg'] ) ? sanitize_text_field( wp_unslash( $_GET['msg'] ) ) : '';
if ( $msg == 'deleted' ) {?>
    <div id="wpwg-delete-msg">
        <p><?php esc_attr_e( 'Item Deleted successfully !', 'wp-user-frontend' ); ?></p>
        <span class="dashicons-before dashicons-dismiss"></span>
    </div>
    <script>
        (function ($) {
            var delete_div = $("#wpwg-delete-msg");
            if ((location.search.split('msg' + '=')[1] || '').split('&')[0]==='deleted'){
                delete_div.css({display:'flex'});
                if (delete_div.is(':visible')){
                    setTimeout(function (e) {
                        delete_div.css({display:'none'});
                    },5000)
                }
            }

            $("#wpwg-delete-msg span").on('click',function (e) {
                delete_div.toggle('slow',function () {
                    delete_div.css({display:'none'});
                });
            })
        })(jQuery);
    </script>
<?php
}

$args = [
    'author'         => get_current_user_id(),
    'post_status'    => ['draft', 'future', 'pending', 'publish', 'private'],
    'post_type'      => $post_type,
    'posts_per_page' => 5,
    'paged'          => $pagenum,
];

$original_post   = $post;
$dashboard_query = new WP_Query( apply_filters( 'wpwg_dashboard_query', $args ) );
$post_type_obj   = get_post_type_object( $post_type );

?>

<?php do_action( 'wpwg_account_posts_top', $userdata->ID, $post_type_obj ); ?>

<?php if ( $dashboard_query->have_posts() ) { ?>

    <?php
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
                global $post;
                $stickies      = get_option( 'sticky_posts' );
                while ( $dashboard_query->have_posts() ) {
                    $dashboard_query->the_post();
                    $show_link        = !in_array( $post->post_status, ['draft', 'future', 'pending'] );
                    $payment_status   = get_post_meta( $post->ID, '_wpwg_payment_status', true );
                    $is_featured      = in_array( intval( $post->ID ), $stickies, true ) ? ' - ' . esc_html__( 'Featured', 'wp-user-frontend' ) . ucfirst( $post_type ) : '';
                    $title            = wp_trim_words( get_the_title(), 5 ) . $is_featured;
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
                                <span class="post-edit-icon">
                                    &#x25BE;
                                </span>
                            </td>
                        <td data-label="<?php esc_attr_e( 'Title: ', 'wp-user-frontend' ); ?>" class="<?php echo 'on' === $featured_img ? 'data-column' : '' ; ?>">
                            <?php if ( ! $show_link ) { ?>

                                <?php echo $title ?>

                            <?php } else { ?>

                                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-user-frontend' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a>

                            <?php } ?>
                        </td>
                        <td data-label="<?php esc_attr_e( 'Status: ', 'wp-user-frontend' ); ?>" class="data-column">
                            <?php
                            $current_post_status = $post->post_status;
                            if ( 'publish' === $current_post_status ) {
                                $link_text = esc_html__( 'View', 'wp-user-frontend' );
                                $the_link  = get_permalink();
                            } else {
                                $link_text = esc_html__( 'Preview', 'wp-user-frontend' );
                                $the_link  = get_preview_post_link();
                            }
                            echo $current_post_status;
                            echo apply_filters( 'wpwg_preview_link_separator', '&nbsp;|&nbsp;' );
                            printf(
                                '<a href="%s" target="_blank">%s</a>',
                                $the_link,
                                $link_text
                            );
                            ?>
                        </td>

                        <?php do_action( 'wpwg_account_posts_row_col', $args, $post ); ?>


                                <td data-label="<?php esc_attr_e( 'Options: ', 'wp-user-frontend' ); ?>" class="data-column">

                                </td>
                            </tr>
                            <?php
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
            do_action( 'wpwg_account_posts_nopost', $userdata->ID, $post_type_obj );
        }

        wp_reset_postdata();
