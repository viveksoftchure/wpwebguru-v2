<?php

/**
 * Theme support functions
 *
 * @package WpWebGuru
 */

if (!function_exists('wpwebguru_setup')) :
	/**
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wpwebguru_setup()
	{
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
			'menu-1' => esc_html__('Main Menu', 'wpwebguru'),
			'menu-2' => esc_html__('Category Menu', 'wpwebguru'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets'
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Post Format
         */
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));


        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
        add_editor_style('style-editor.css');

        // for gutenberg support
        add_theme_support( 'align-wide' );
        add_theme_support( 'editor-color-palette', array(
            array(
                'name' => esc_html__( 'Primary', 'blogar' ),
                'slug' => 'blogar-primary',
                'color' => '#3858F6',
            ),
            array(
                'name' => esc_html__( 'Secondary', 'blogar' ),
                'slug' => 'blogar-secondary',
                'color' => '#D93E40',
            ),
            array(
                'name' => esc_html__( 'Tertiary', 'blogar' ),
                'slug' => 'blogar-tertiary',
                'color' => '#050505',
            ),
            array(
                'name' => esc_html__( 'White', 'blogar' ),
                'slug' => 'blogar-white',
                'color' => '#ffffff',
            ),
            array(
                'name' => esc_html__( 'Dark Light', 'blogar' ),
                'slug' => 'blogar-dark-light',
                'color' => '#1A1A1A',
            ),
        ) );

        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => esc_html__( 'Small', 'blogar' ),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__( 'Normal', 'blogar' ),
                'size' => 16,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__( 'Large', 'blogar' ),
                'size' => 36,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__( 'Huge', 'blogar' ),
                'size' => 50,
                'slug' => 'huge'
            )
        ) );

        /**
         * Add Custom Image Size
         */
        add_image_size('blog-thumb', 295, 250, true);
        add_image_size('single-blog-thumb', 1440, 720, true);
        add_image_size('main-slider-thumb', 1230, 615, true);
        add_image_size('tab-post-thumb', 390, 260, true);
        add_image_size('tab-big-post-thumb', 705, 660, true);
        add_image_size('tab-small-post-thumb', 495, 300, true);
        add_image_size('grid-big-post-thumb', 600, 500, true);
        add_image_size('grid-small-post-thumb', 285, 190, true);

        add_image_size('post-grid-1', 224, 224, array('center', 'center'));
        add_image_size('post-grid-1-small', 160, 172, array('center', 'center'));
        add_image_size('post-grid-2', 388, 204, array('center', 'center'));
        add_image_size('post-grid-2-big', 613, 404, array('center', 'center'));


		add_theme_support('custom-background', array(
			'default-color' => 'ffffff',
		));
		add_theme_support('custom-header', array(
			'height' => '40',
			'flex-height' => false,
			'width' => '140',
			'flex-width' => false,
			'uploads' => true,
			'header-text' => true,
		));

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
		add_theme_support('custom-logo', array(
            'width' => 466,
			'height' => 124,
			'flex-height' => true,
			'flex-weight' => true,
			)
		);

		// Set the content width in pixels, based on the theme's design and stylesheet
		// Priority 0 to make it available to lower priority callbacks.
		if (!isset($content_width)) {
			$content_width = 900;
		}
		function wpwebguru_content_width()
		{
			$GLOBALS['content-width'] = apply_filters('wpwebguru_content_width', 1400);
		}
		add_action('after_setup_theme', 'wpwebguru_content_width', 0);

		function wpwebguru_add_editor_styles()
		{
			add_editor_style('./assets/css/bootstrap.min.css');
		}
		add_action('admin_init', 'wpwebguru_add_editor_styles');

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WpWebGuru, use a find and replace
		 * to change 'wpwebguru' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('wpwebguru', WWG_ROOT . '/languages');

        // Disables the block editor from managing widgets in the Gutenberg plugin.
        add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
        // Disables the block editor from managing widgets.
        add_filter( 'use_widgets_block_editor', '__return_false' );
	}
endif;
add_action('after_setup_theme', 'wpwebguru_setup');


add_action("after_switch_theme", "create_bookmark_table");
function create_bookmark_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "bookmarks";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NULL DEFAULT NULL,
        user_id int(11) NULL DEFAULT NULL,
        date_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}


/*
* add custom count to post page
*/
function custom_columns($columns) 
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'featured_image' => 'Image',
        'title' => 'Title',
        'categories' => 'Categories',
        'tags' => 'Tags',
        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        'date' => 'Date'
     );
    return $columns;
}
add_filter('manage_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) 
{
    switch ( $column ) 
    {
    case 'featured_image':
        the_post_thumbnail( 'thumbnail' );
        break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_columns_data', 10, 2 ); 

/*
* Ajax LOGIN function
*/
add_action( 'wp_ajax_nopriv_addbookmark', 'add_bookmark' );
add_action( 'wp_ajax_addbookmark', 'add_bookmark' );
function add_bookmark() {

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

/*
* Ajax LOGIN function
*/
add_action( 'wp_ajax_nopriv_deletebookmark', 'delete_bookmark' );
add_action( 'wp_ajax_deletebookmark', 'delete_bookmark' );
function delete_bookmark() {

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


/*
* add login and logout to menu
*/
add_filter( 'wp_nav_menu_items', 'my_account_loginout_link', 10, 2 );
function my_account_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'menu-1') { 
        $items .= '<li><a class="nav-link" href="'. wp_logout_url(get_permalink()) .'">Logout</a></li>'; 
    } elseif (!is_user_logged_in() && $args->theme_location == 'menu-1') {
        $items .= '<li><a class="nav-link site-login" id="site-login" href="#">Login</a></li>';
    }

    return $items;
}

/*
* Ajax LOGIN function
*/
add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
add_action( 'wp_ajax_ajaxlogin', 'ajax_login' );
function ajax_login(){

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
    
/*
* Ajax register function
*/
add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
add_action( 'wp_ajax_ajaxregister', 'ajax_register' );
function ajax_register() {


          echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    
          

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
    if(get_option('listeo_strong_password')){
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
    }

    $result = register_user( $email, $user_login, $password );

    if ( is_wp_error($result) ){
        echo json_encode(array('registered'=>false, 'message'=> $result->get_error_message()));
    } else {
        echo json_encode(array('registered'=>true, 'message'=>esc_html__('You have been successfully registered, you will be logged in a moment.','listeo_core')));
    }

    die();
}

function register_user( $email, $user_login, $password ) {
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
        wp_new_user_notification( $user_id, $password,'both' );
        if(get_option('listeo_autologin')){
            wp_set_current_user($user_id); // set the current wp user
            wp_set_auth_cookie($user_id);   
        }
    }
    
    return $user_id;
}

    
/*
* Auth user login
*/
function auth_user_login($user_login, $password, $remember, $from) {
    $info = array();
    $info['user_login']     = $user_login;
    $info['user_password']  = $password;
    $info['remember']       = $remember;

    $user_signon = wp_signon( $info, '' );    
      
    if ( is_wp_error($user_signon) ) {
        
        if ( isset( $user_signon->errors[ 'invalid_username' ] ) ) {
            $username_error = true;
        } else{
            $username_error = false;
        }
        if ( isset( $user_signon->errors[ 'incorrect_password' ] ) ) {
            $password_error = true;
        } else{
            $password_error = false;
        }               
        $error_string = $user_signon->get_error_message();
        
        echo json_encode( array(
            'loggedin' => false, 
            // 'message' => $error_string,
            'message'=>__('Wrong username or password.'),
            'invalid_username' => $username_error,
            'incorrect_password' => $password_error,
        ) );
    } else {
        wp_set_current_user($user_signon->ID);

        $args = array(
            'loggedin'  => true,
            'message'   => __( 'Login successful, redirecting...' ),
            'redirect'  => get_permalink( get_page_by_path( 'account' ) ),
        );  
            
        echo json_encode( $args );
    }
    
    die();
}