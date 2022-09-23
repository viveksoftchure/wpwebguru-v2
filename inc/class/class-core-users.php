<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Dashboard class
 *
 */
class WPWG_Core_Users {

    /**
     * Class constructor
     */
    public function __construct() {

        add_action( 'wpwg_account_content_dashboard', array( $this, 'dashboard_section' ), 10, 2 );
        add_action( 'wpwg_account_content_post', array( $this, 'posts_section' ), 10, 2 );
        add_action( 'wpwg_account_content_bookmark', array( $this, 'bookmark_section' ), 10, 2 );
        add_action( 'wpwg_account_content_edit-profile', array( $this, 'edit_profile_section' ), 10, 2 );
        add_action( 'wpwg_account_content_edit-profile', array( $this, 'update_profile' ));

        add_action( 'init', array( $this, 'submit_my_account_form' ), 10 );
        add_action( 'init', array( $this, 'submit_change_password_form' ), 10 );
        add_action( 'init',  array( $this, 'remove_filter_lostpassword' ), 10 );

        add_shortcode( 'wpwg_account', array( $this, 'my_account' ) );
        add_shortcode( 'wpwg_change_password', array( $this, 'change_password' ) );
        add_shortcode( 'custom-password-lost-form', array( $this, 'lost_password' ) );
        add_shortcode( 'custom-password-reset-form', array( $this, 'reset_password' ) );

        add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );
        add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
        add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
        
        add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );

        add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_reset' ) );
        add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_reset' ) );

        add_action( 'login_form_rp', array( $this, 'do_password_reset' ) );
        add_action( 'login_form_resetpass', array( $this, 'do_password_reset' ) );
        add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );

        add_filter('get_avatar', array( $this, 'core_gravatar_filter' ), 10, 6);

        // Ajax login
        add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'ajax_login' ) );
        add_action( 'wp_ajax_ajaxlogin', array( $this, 'ajax_login' ) );
        // Ajax registration
        add_action( 'wp_ajax_nopriv_ajaxregister', array( $this, 'ajax_register' ) );
        add_action( 'wp_ajax_ajaxregister', array( $this, 'ajax_register' ) );


        add_action( 'wp_ajax_nopriv_addbookmark', array( $this, 'add_bookmark' ) );
        add_action( 'wp_ajax_addbookmark', array( $this, 'add_bookmark' ) );
        add_action( 'wp_ajax_nopriv_deletebookmark', array( $this, 'delete_bookmark' ) );
        add_action( 'wp_ajax_deletebookmark', array( $this, 'delete_bookmark' ) );

        add_action( 'wp_body_open',array($this, 'login_form'));
    }


    /**
     * Display the login form
     */
    public function login_form() {
        if( !is_page_template( 'template-account.php' ) ) :
            get_template_part( 'template-parts/account/login-form' ); 
        endif;
    } 

    /**
     * Handle's user account functionality
     *
     * Insert shortcode [wpwg_account] in a page to
     * show the user account
     */
    public function my_account( $atts ) {
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
     * Display the change password page
     *
     * @param array $atts
     *
     * @return void
     */
    public function change_password( $atts = array() ) {
        ob_start();
        get_template_part( 'template-parts/account/change_password' ); 
        return ob_get_clean();
    }  

    /**
     * Display the lost password page
     *
     * @param array $atts
     *
     * @return void
     */
    public function lost_password( $atts = array() ) {
        $errors = array();
        if ( isset( $_REQUEST['errors'] ) ) {
            $error_codes = explode( ',', $_REQUEST['errors'] );
            foreach ( $error_codes as $error_code ) {
                $errors[]= $this->get_error_message( $error_code );
            }
        } 
        ob_start();
        get_template_part( 'template-parts/account/lost_password' ); 
        return ob_get_clean();
    }

    /**
     * Display the reset password page
     *
     * @param array $atts
     *
     * @return void
     */
    public function reset_password( $atts = array() ) {
        $attributes = array();
        if ( is_user_logged_in() ) {
            return '<div class="notification success closeable">
                            <p>'. __( 'You are already signed in.', 'listeo_core' ).'</p>
                    </div>';
            
        } else {
            if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
                $attributes['login'] = $_REQUEST['login'];
                $attributes['key'] = $_REQUEST['key'];
                // Error messages
                $errors = array();
                if ( isset( $_REQUEST['error'] ) ) {
                    $error_codes = explode( ',', $_REQUEST['error'] );
                    foreach ( $error_codes as $code ) {
                        $errors []= $this->get_error_message( $code );
                    }
                }
                $attributes['errors'] = $errors;
                ob_start();
                get_template_part( 'account/reset_password' ); 
                return ob_get_clean();
            } else if(isset( $_GET['password'] ) ) {
                return '<div class="notification success closeable">
                            '. __( 'Password has been changed.', 'listeo_core' ).'
                        </div>';
                
            } else if(isset( $_GET['checkemail'] ) ) {

                return '<div class="notification success closeable">'
                            .__( 'A confirmation link has been sent to your email address.', 'listeo_core' ).'
                        </div>';

            } else {
                return '<div class="notification success closeable">'
                            .__( 'Invalid password reset link.', 'listeo_core' ).'
                        </div>';
            }
        }
        
    }
    
    /**
     * Redirect the user to the custom login page instead of wp-login.php.
     */
    public function redirect_to_custom_login() {
        if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
         
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user( $redirect_to );
                exit;
            }
     
            // The rest are redirected to the login page
            $login_url = get_permalink(get_page_by_path( 'my-account' ));
            if ( ! empty( $redirect_to ) ) {
                $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
            }
     
            wp_redirect( $login_url );
            exit;
        }
    }

    /**
     * Redirects the user to the custom "Forgot your password?" page instead of
     * wp-login.php?action=lostpassword.
     */
    public function redirect_to_custom_lostpassword() {

        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
                exit;
            }
     
            $lost_password_page = get_page_by_path( 'lost-password' );
            if(!empty($lost_password_page)) {
                wp_redirect(get_permalink($lost_password_page ));   
            } else {
                esc_html_e("Please set a Lost Password Page in Listeo_Core Options -> Pages",'listeo_core');
            }
            
            exit;
        }
    }

    /**
     * Initiates password reset.
     */
    public function do_password_lost() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $errors = retrieve_password();
            if ( is_wp_error( $errors ) ) {
                // Errors found
                $redirect_url = get_permalink(get_page_by_path( 'reset-password' ));
                $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
            } else {
                // Email sent
                $redirect_url = get_permalink(get_page_by_path( 'reset-password' ));
                $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
                if ( ! empty( $_REQUEST['redirect_to'] ) ) {
                    $redirect_url = $_REQUEST['redirect_to'];
                }
            }
            wp_safe_redirect( $redirect_url );
            exit;
        }
    }

    /**
     * Redirects to the custom password reset page, or the login page
     * if there are errors.
     */
    public function redirect_to_custom_password_reset() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            // Verify key / login combo
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
            if ( ! $user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    wp_redirect( get_permalink(get_page_by_path( 'lost-password' )).'?login=expiredkey' );
                } else {
                    wp_redirect( get_permalink(get_page_by_path( 'lost-password' )).'?login=invalidkey');
                }
                exit;
            }
            $redirect_url = get_permalink(get_page_by_path( 'reset-password' ));
            $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
            $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
            wp_redirect( $redirect_url );
            exit;
        }
    }

    /**
     * Redirects the user to the custom registration page instead
     * of wp-login.php?action=register.
     */
    public function redirect_to_custom_register() {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
            } else {
                wp_redirect( get_permalink(get_page_by_path( 'my-account' )) );
            }
            exit;
        }
    }

    /**
     * get user gravatar
     *
     * @return image
     */
    public function core_gravatar_filter($avatar, $id_or_email, $size, $default, $alt, $args) {
        
        if(is_object($id_or_email)) {
          // Checks if comment author is registered user by user ID
          
          if($id_or_email->user_id != 0) {
            $email = $id_or_email->user_id;

          // Checks that comment author isn't anonymous
          } elseif(!empty($id_or_email->comment_author_email)) {
            // Checks if comment author is registered user by e-mail address
            $user = get_user_by('email', $id_or_email->comment_author_email);
            // Get registered user info from profile, otherwise e-mail address should be value
            $email = !empty($user) ? $user->ID : $id_or_email->comment_author_email;
          }
          $alt = $id_or_email->comment_author;
          
        } else {
          if(!empty($id_or_email)) {
            // Find user by ID or e-mail address
            $user = is_numeric($id_or_email) ? get_user_by('id', $id_or_email) : get_user_by('email', $id_or_email);
          } else {
            // Find author's name if id_or_email is empty
            $author_name = get_query_var('author_name');
            if(is_author()) {
              // On author page, get user by page slug
              $user = get_user_by('slug', $author_name);
            } else {
              // On post, get user by author meta
              $user_id = get_the_author_meta('ID');
              $user = get_user_by('id', $user_id);
            }
          }
          // Set user's ID and name
          if(!empty($user)) {
            $email = $user->ID;
            $alt = $user->display_name;
          }

        }


        if( isset($email) && is_email( $email ) && ! email_exists( $email ) ) {
            return $avatar;
        }else if(isset($email) &&  is_numeric($email)) {
               $user = get_user_by('id', $email);
          } else {
            $email = false;
          }
    

        $class = array( 'avatar', 'avatar-' . (int) $args['size'], 'photo' );

        if ( ! $args['found_avatar'] || $args['force_default'] ) {
            $class[] = 'avatar-default';
        }

        if ( $args['class'] ) {
            if ( is_array( $args['class'] ) ) {
                $class = array_merge( $class, $args['class'] );
            } else {
                $class[] = $args['class'];
            }
        }
        if(isset($user) && !empty($user) ){
            $custom_avatar_id = get_user_meta($user->ID, 'listeo_core_avatar_id', true); 
        
            $custom_avatar = wp_get_attachment_image_src($custom_avatar_id,'listeo_core-avatar');
            if ($custom_avatar)  {
                $return = '<img src="'.$custom_avatar[0].'" class="'.esc_attr( join( ' ', $class ) ).'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
            } elseif ($avatar) {
                $return = $avatar;
            } else {
                $return = '<img src="'.$default.'" class="'.esc_attr( join( ' ', $class ) ).'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
            }
        } else {
            $return = $avatar;
        }
        
        return $return;
        
    }

    /**
     * Ajax login
     *
     * @return json
     */
    public function ajax_login(){

        // First check the nonce, if it fails the function will break
        //check_ajax_referer( 'ajax-login-nonce', 'security' );
        if( !check_ajax_referer( 'ajax-login-nonce', 'login_security', false) ) :
            echo json_encode(
                array(
                    'loggedin'=>false, 
                    'message'=> __('Session token has expired, please reload the page and try again', 'listeo_core')
                )
            );
            die();
        endif;

        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_login'] = sanitize_text_field(trim($_POST['username']));
        $info['user_password'] = sanitize_text_field(trim($_POST['password']));
        $info['remember'] = isset($_POST['remember-me']) ? true : false;

        if(empty($info['user_login'])) {
             echo json_encode(
                array(
                    'loggedin'=>false, 
                    'message'=> esc_html__( 'You do have an email address, right?', 'listeo_core' )
                )
             );
             die();
        } 
        if(empty($info['user_password'])) {
             echo json_encode(array('loggedin'=>false, 'message'=> esc_html__( 'You need to enter a password to login.', 'listeo_core' )));
             die();
        }

        // $user_signon = wp_signon( $info, is_ssl() );
        $user_signon = wp_signon( $info, '' );
        if ( is_wp_error($user_signon) ){
            
            echo json_encode(
                array(
                    'loggedin'=>false, 
                    'message'=>esc_html__('Wrong username or password.','listeo_core')
                )
            );

        } else {
            wp_clear_auth_cookie();
            wp_set_current_user($user_signon->ID);
            wp_set_auth_cookie($user_signon->ID, true);
            echo json_encode(
                array(
                    'loggedin'  =>  true, 
                    'message'   =>  esc_html__('Login successful, redirecting...','listeo_core'),
                
                )
            );
        }

        die();
    }

    /**
     * Ajax Register
     *
     * @return json
     */
    public function ajax_register() {
        if ( !get_option('users_can_register') ) :
                echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> esc_html__( 'Registration is disabled', 'listeo_core' ),
                )
            );
            die();
        endif;

        if( !check_ajax_referer( 'ajax-register-nonce', 'register_security', false) ) :
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> __('Session token has expired, please reload the page and try again', 'listeo_core')
                )
            );
            die();
        endif;

        //get email
        $email = sanitize_email($_POST['email']);
        if ( !$email ) {
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> __('Please fill email address', 'listeo_core')
                )
            );
            die();
        }       
        if ( !is_email($email)  ) {
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> __('This is not valid email address', 'listeo_core')
                )
            );
            die();
        }

        $user_login = sanitize_user(trim($_POST['username']));
        if(empty($user_login)) {
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> esc_html__( 'Please provide your username', 'listeo_core' )
                )
            );
            die();
        }  

        $password = sanitize_text_field(trim($_POST['password']));
        if(empty($password)) {
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> esc_html__( 'Please provide password', 'listeo_core' )
                )
            );
            die();
        } 
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            
            echo json_encode(
                array(
                    'registered'=>false, 
                    'message'=> esc_html__( 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.', 'listeo_core' )
                )
            );
            die();
        }

        $result = $this->register_user( $email, $user_login, $password );

        if ( is_wp_error($result) ){
            echo json_encode(array('registered'=>false, 'message'=> $result->get_error_message()));
        } else {
            echo json_encode(array('registered'=>true, 'message'=>esc_html__('You have been successfully registered, you will be logged in a moment.','listeo_core')));
        }

        die();
    }


    /**
     * Returns the URL to which the user should be redirected after the (successful) login.
     *
     * @param string           $redirect_to           The redirect destination URL.
     * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
     * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
     *
     * @return string Redirect URL
     */
    public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
        $redirect_url = home_url();

        if ( ! isset( $user->ID ) ) {
            return $redirect_url;
        }
     
        if ( user_can( $user, 'manage_options' ) ) {
            $redirect_url = admin_url();
        } else {
            $redirect_url = get_permalink(get_page_by_path( 'my-account' ));
        }
     
        return wp_validate_redirect( $redirect_url, home_url() );
    }

    /**
     * Redirects the user to the correct page depending on whether he / she
     * is an admin or not.
     *
     * @param string $redirect_to   An optional redirect_to URL for admin users
     */
    private function redirect_logged_in_user( $redirect_to = null ) {
        $user = wp_get_current_user();
        if ( user_can( $user, 'manage_options' ) ) {
            if ( $redirect_to ) {
                wp_safe_redirect( $redirect_to );
            } else {
                wp_redirect( admin_url() );
            }
        } else {
            wp_redirect( home_url( get_permalink(get_page_by_path( 'my-account' )) ) );
        }
    }

    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $email         The new user's email address
     * @param string $user_login    The new user's username
     * @param string $password      The new user's password
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function register_user( $email, $user_login, $password ) {
        $errors = new WP_Error();
     
        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if ( ! is_email( $email ) ) {
            $errors->add( 'email', $this->get_error_message( 'email' ) );
            return $errors;
        }
     
        if ( email_exists( $email ) ) {
            $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
            return $errors;
        }

        if ( username_exists( $user_login ) ) {
            $errors->add( 'username_exists', $this->get_error_message( 'username_exists') );
            return $errors;
        }

        $user_data = array(
            'user_login'    => $user_login,
            'user_email'    => $email,
            'user_pass'     => $password,
        );
     
        $user_id = wp_insert_user( $user_data );

        if ( ! is_wp_error( $user_id ) ) {
            wp_set_current_user($user_id); // set the current wp user
            wp_set_auth_cookie($user_id);   
        }
        
        return $user_id;
    }

    /**
     * Resets the user's password if the password reset form was submitted.
     */
    public function do_password_reset() {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $rp_key = $_REQUEST['rp_key'];
            $rp_login = $_REQUEST['rp_login'];
            $user = check_password_reset_key( $rp_key, $rp_login );
            if ( ! $user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    wp_redirect( home_url( 'member-login?login=expiredkey' ) );
                } else {
                    wp_redirect( home_url( 'member-login?login=invalidkey' ) );
                }
                exit;
            }
            if ( isset( $_POST['pass1'] ) ) {
                if ( $_POST['pass1'] != $_POST['pass2'] ) {
                    // Passwords don't match
                    $redirect_url = get_permalink(get_option( 'listeo_reset_password_page' ));
                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );
                    wp_redirect( $redirect_url );
                    exit;
                }
                if ( empty( $_POST['pass1'] ) ) {
                    // Password is empty
                    $redirect_url = get_permalink(get_option( 'listeo_reset_password_page' ));
                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );
                    wp_redirect( $redirect_url );
                    exit;
                }
                // Parameter checks OK, reset password
                reset_password( $user, $_POST['pass1'] );
                $redirect_url = get_permalink(get_option( 'listeo_reset_password_page' ));
                $redirect_url = add_query_arg( 'password', 'changed', $redirect_url );
                wp_redirect(  $redirect_url );
            } else {
                echo "Invalid request.";
            }
            exit;
        }
    }

    function remove_filter_lostpassword() {
      remove_filter( 'lostpassword_url', 'wc_lostpassword_url', 10 );
    }

    /**
     * Update profile via Ajax
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

    /**
     * Save user account info
     *
     * @return void
     */
    function submit_my_account_form() {
        global $blog_id, $wpdb;
        if ( isset( $_POST['my-account-submission'] ) && '1' == $_POST['my-account-submission'] ) {
            $current_user = wp_get_current_user();
            $error = array();  

            if ( !empty( $_POST['url'] ) ) {
                wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_attr( $_POST['url'] )));
            }

            if ( isset( $_POST['email'] ) ){

                if (!is_email(esc_attr( $_POST['email'] ))) {
                    $error = 'error_1'; // __('The Email you entered is not valid.  please try again.', 'profile');
                    
                } else {
                    if(email_exists(esc_attr( $_POST['email'] ) ) ) {
                        if(email_exists(esc_attr( $_POST['email'] ) ) != $current_user->ID) {
                            $error = 'error_2'; // __('This email is already used by another user.  try a different one.', 'profile');  
                        }
                        
                    } else {
                    $user_id = wp_update_user( 
                        array (
                            'ID' => $current_user->ID, 
                            'user_email' => esc_attr( $_POST['email'] )
                        )
                    );
                    }
                }
            }

            if ( isset( $_POST['first-name'] ) ) {
                update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
            }
            
            if ( isset( $_POST['last-name'] ) ){
                update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
            }           

            if ( isset( $_POST['phone'] ) ){
                update_user_meta($current_user->ID, 'phone', esc_attr( $_POST['phone'] ) );
            }                               

            
            
            if ( isset( $_POST['display_name'] ) ) {
                wp_update_user(array('ID' => $current_user->ID, 'display_name' => esc_attr( $_POST['display_name'] )));
                update_user_meta($current_user->ID, 'display_name' , esc_attr( $_POST['display_name'] ));
            }
            if ( !empty( $_POST['description'] ) ) {
                update_user_meta( $current_user->ID, 'description', sanitize_textarea_field( $_POST['description'] ) );
            }

            if ( isset( $_POST['listeo_core_avatar_id'] ) ) {
                update_user_meta( $current_user->ID, 'listeo_core_avatar_id', esc_attr( $_POST['listeo_core_avatar_id'] ) );
            }
            


            if ( count($error) == 0 ) {
                //action hook for plugins and extra fields saving
                //do_action('edit_user_profile_update', $current_user->ID);
                wp_redirect( get_permalink().'?updated=true' ); 
                exit;
            } else {
                wp_redirect( get_permalink().'?user_err_pass='.$error ); 
                exit;
                 
            } 
        } // end if

    }

    /**
     * Update user password
     *
     * @return json
     */
    public function submit_change_password_form(){
        $error = false;
        if ( isset( $_POST['listeo_core-password-change'] ) && '1' == $_POST['listeo_core-password-change'] ) {
            $current_user = wp_get_current_user();
            if ( !empty($_POST['current_pass']) && !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {

                if ( !wp_check_password( $_POST['current_pass'], $current_user->user_pass, $current_user->ID) ) {
                    /*$error = 'Your current password does not match. Please retry.';*/
                    $error = 'error_1';
                } elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
                    /*$error = 'The passwords do not match. Please retry.';*/
                    $error = 'error_2';
                } elseif ( strlen($_POST['pass1']) < 4 ) {
                    /*$error = 'A bit short as a password, don\'t you think?';*/
                    $error = 'error_3';
                } elseif ( false !== strpos( wp_unslash($_POST['pass1']), "\\" ) ) {
                    /*$error = 'Password may not contain the character "\\" (backslash).';*/
                    $error = 'error_4';
                } else {
                    $user_id  = wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
                    
                    if ( is_wp_error( $user_id ) ) {
                        /*$error = 'An error occurred while updating your profile. Please retry.';*/
                        $error = 'error_5';
                    } else {
                        $error = false;
                        do_action('edit_user_profile_update', $current_user->ID);
                        wp_redirect( get_permalink().'?updated_pass=true' ); 
                        exit;
                    }
                }
            
                if ( !$error ) {
                    do_action('edit_user_profile_update', $current_user->ID);
                    wp_redirect( get_permalink().'?updated_pass=true' ); 
                    exit;
                } else {
                    wp_redirect( get_permalink().'?err_pass='.$error ); 
                    exit;
                     
                }
                
            } else {
                $error = 'error_6';
                wp_redirect( get_permalink().'?err_pass='.$error ); 
                    exit;
            }
        } // end if
    }


    /**
     * Finds and returns a matching error message for the given error code.
     *
     * @param string $error_code    The error code to look up.
     *
     * @return string               An error message.
     */
    private function get_error_message( $error_code ) {
        switch ( $error_code ) {
            case 'email_exists':
                return __( 'This email is already registered', 'listeo_core' );
            break;
            case 'username_exists':
                return __( 'This username already exists', 'listeo_core' );
            break;
            case 'empty_username':
                return __( 'You do have an email address, right?', 'listeo_core' );
            break;
            case 'empty_password':
                return __( 'You need to enter a password to login.', 'listeo_core' );
            break;
            case 'invalid_username':
                return __(
                    "We don't have any users with that email address. Maybe you used a different one when signing up?", 'listeo_core' );
            break;
            case 'incorrect_password':
                $err = __(
                    "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
                    'listeo_core'
                );
                return sprintf( $err, wp_lostpassword_url() );
            break;
            default:
                break;
        }
         
        return __( 'An unknown error occurred. Please try again later.', 'listeo_core' );
    }

    /**
     * add post to bookmark
     *
     * @return json
     */
    public function add_bookmark() {

        if ( !empty($_POST['id']) ) {
            // Nonce is checked, get the POST data and sign user on
            global $current_user;
            global $wpdb;
            $table_name = $wpdb->prefix . 'bookmarks';

            $wpdb->insert($table_name, array(
               "post_id"        => $_POST['id'],
               "user_id"        => $current_user->ID,
               "date_created"   => date('Y-m-d H:i'),
            ));
            echo json_encode( array(
                'success' => true, 
                // 'message' => $error_string,
                'data'=>__('Please fill all required fields.'),
            ) );
            die();

        } else {
            echo json_encode( array(
                'success' => false, 
                // 'message' => $error_string,
                'data'=>__('Please fill all required fields.'),
            ) );
            die();
        }
    }

    /**
     * delete post from bookmark
     *
     * @return json
     */
    public function delete_bookmark() {

        if ( !empty($_POST['id']) ) {
            // Nonce is checked, get the POST data and sign user on
            global $current_user;
            global $wpdb;
            $table_name = $wpdb->prefix . 'bookmarks';

            $post_id = isset($_POST['id']) ? $_POST['id'] : '';
            $user_id = $current_user->ID;

            $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE post_id = $post_id and user_id = $user_id "));

            echo json_encode( array(
                'success' => true, 
                // 'message' => $error_string,
                'data'=>__('Please fill all required fields.'),
            ) );
            die();

        } else {
            echo json_encode( array(
                'success' => false, 
                // 'message' => $error_string,
                'data'=>__('Please fill all required fields.'),
            ) );
            die();
        }
    }
}
new WPWG_Core_Users();