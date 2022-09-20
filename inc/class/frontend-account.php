<?php

/**
 * Dashboard class
 *
 */
class WPWG_Frontend_Account {
    /**

     * Class constructor
     */
    public function __construct() {
        add_shortcode( 'wpwg_account', [ $this, 'shortcode' ] );
        add_action( 'wpwg_account_content_dashboard', [ $this, 'dashboard_section' ], 10, 2 );
        add_action( 'wpwg_account_content_post', [ $this, 'posts_section' ], 10, 2 );
        add_action( 'wpwg_account_content_bookmark', [ $this, 'bookmark_section' ], 10, 2 );
        add_action( 'wpwg_account_content_edit-profile', [ $this, 'edit_profile_section' ], 10, 2 );
        add_action('wpwg_account_content_edit-profile', [ $this, 'update_profile' ]);
    }

    /**
     * Handle's user account functionality
     *
     * Insert shortcode [wpwg_account] in a page to
     * show the user account
     */
    public function shortcode( $atts ) {
        //phpcs:ignore
        extract( shortcode_atts( [], $atts ) );

        ob_start();

        if ( is_user_logged_in() ) {
            $default_active_tab = 'dashboard';
            $section            = isset( $_REQUEST['section'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['section'] ) ) : $default_active_tab;

            $sections = apply_filters( 'wpwg_my_account_tab_links', wpwg_get_account_sections() );

            $current_section    = [];

            foreach ( $sections as $slug => $label ) {
                if ( $section === $slug ) {
                    $current_section = $slug;
                    break;
                }
            }

            wpwg_load_template(
                'account.php', [
                    'sections' => $sections,
                    'current_section' => $current_section,
                ]
            );
        } else {
            $message = 'wpwg_dashboard';
            wpwg_load_template( 'unauthorized.php', [ 'message' => $message ] );
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Display the dashboard section
     *
     * @param array  $sections
     * @param string $current_section
     *
     * @return void
     */
    public function dashboard_section( $sections, $current_section ) {
        wpwg_load_template(
            'dashboard/dashboard.php',
            [
                'sections' => $sections,
                'current_section' => $current_section,
            ]
        );
    }

    /**
     * Display the bookmark section
     *
     * @param array  $sections
     * @param string $current_section
     *
     * @return void
     */
    public function bookmark_section( $sections, $current_section ) {
        wpwg_load_template(
            'dashboard/bookmark.php',
            [
                'sections' => $sections,
                'current_section' => $current_section,
            ]
        );
    }

    /**
     * Display the posts section
     *
     * @param array  $sections
     * @param string $current_section
     *
     * @return void
     */
    public function posts_section( $sections, $current_section ) {
        wpwg_load_template(
            'dashboard/posts.php',
            [
                'sections' => $sections,
                'current_section' => $current_section,
            ]
        );
    }

    /**
     * Display the edit profile section
     *
     * @param array  $sections
     * @param string $current_section
     *
     * @return void
     */
    public function edit_profile_section( $sections, $current_section ) {
        wpwg_load_template(
            'dashboard/edit-profile.php',
            [
                'sections' => $sections,
                'current_section' => $current_section,
            ]
        );
    }

    /**
     * Update profile via Ajax
     *
     * @since  2.4.2
     *
     * @return json
     */
    public function update_profile() {
        $nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_key( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';

        if ( isset( $nonce ) && ! wp_verify_nonce( $nonce, 'wpwg-account-update-profile' ) ) {
            return;
        }

        global $current_user;

        $first_name       = ! empty( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
        $last_name        = ! empty( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
        $email            = ! empty( $_POST['email'] ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : '';
        $current_password = ! empty( $_POST['current_password'] ) ? sanitize_text_field( wp_unslash( $_POST['current_password'] ) ) : '';
        $pass1            = ! empty( $_POST['pass1'] ) ? sanitize_text_field( wp_unslash( $_POST['pass1'] ) ) : '';
        $pass2            = ! empty( $_POST['pass2'] ) ? sanitize_text_field( wp_unslash( $_POST['pass2'] ) ) : '';
        $save_pass        = true;

        if ( empty( $first_name ) ) {
            alert_push('First Name is a required field.', 'danger');
        }

        if ( empty( $last_name ) ) {
            alert_push('Last Name is a required field.', 'danger');
        }

        if ( empty( $email ) ) {
            alert_push('Email is a required field.', 'danger');
        }

        $user             = new stdClass();
        $user->ID         = $current_user->ID;
        $user->first_name = $first_name;
        $user->last_name  = $last_name;

        if ( $email ) {
            $email = sanitize_email( $email );

            if ( ! is_email( $email ) ) {
                alert_push('Please provide a valid email address.', 'danger');
            } elseif ( email_exists( $email ) && $email !== $current_user->user_email ) {
                alert_push('This email address is already registered.', 'danger');
            }
            $user->user_email = $email;
        }

        if ( ! empty( $current_password ) && empty( $pass1 ) && empty( $pass2 ) ) {
            alert_push('Please fill out all password fields.', 'danger');
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && empty( $current_password ) ) {
            alert_push('Please enter your current password.', 'danger');
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
            alert_push('Please re-enter your password.', 'danger');
            $save_pass = false;
        } elseif ( ( ! empty( $pass1 ) || ! empty( $pass2 ) ) && $pass1 !== $pass2 ) {
            alert_push('New passwords do not match.', 'danger');
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && ! wp_check_password( $current_password, $current_user->user_pass, $current_user->ID ) ) {
            alert_push('Your current password is incorrect.', 'danger');
            $save_pass = false;
        }

        if ( $pass1 && $save_pass ) {
            $user->user_pass = $pass1;
        }

        $result = wp_update_user( $user );

        if ( is_wp_error( $result ) ) {
            alert_push('Your current password is incorrect.', 'danger');
        } 
        if ( !is_wp_error( $result ) && $save_pass ) {
            alert_push('Profile updated successfully!');
        }

        wp_safe_redirect( get_permalink( get_page_by_path( 'account' ) ).'?section=edit-profile' );
    }
}
new WPWG_Frontend_Account();