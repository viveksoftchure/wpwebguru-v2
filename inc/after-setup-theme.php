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