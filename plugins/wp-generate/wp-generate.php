<?php
/**
 * Plugin Name:       WP Generate
 * Plugin URI:        www.wpwebguru.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Wpwebguru
 * Author URI:        www.wpwebguru.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-enerate
 */

// Load the file if exist
if ( file_exists( dirname(__FILE__) . '/generators/cpt-generator.php' ) ) 
{
    require_once dirname(__FILE__) . '/generators/cpt-generator.php';
}  

/* ==========================================================================
================== Register Plugin Css/js
========================================================================== */
function wpg_plugin_scripts() 
{
	if ( is_page( 'post-type-generator' ) ) {
	    wp_enqueue_style( 'user-css', plugin_dir_url ( __FILE__ ) . 'assets/css/plugin.css' );
	    wp_enqueue_style( 'prettify', plugin_dir_url ( __FILE__ ) . 'assets/css/prettify/desert.css' );
	    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' );

		wp_enqueue_script( 'user_script', plugin_dir_url ( __FILE__ ) . 'assets/js/user-scripts.js', array( 'jquery' ), '1.0.0', true );
		wp_localize_script( 'user_script', 'wpgenerate', 
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'shopurl' => get_permalink( woocommerce_get_page_id( 'shop' ) ),
			) 
		);

		wp_enqueue_script( 'prettify', plugin_dir_url ( __FILE__ ) . 'assets/js/prettify/prettify.js', array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'wpg_plugin_scripts' );

/*===================================================================
========= genrate cpt by ajax
====================================================================*/
add_action('wp_ajax_nopriv_wp_cpt_generator', 'wp_cpt_generator');
add_action('wp_ajax_wp_cpt_generator', 'wp_cpt_generator');
function wp_cpt_generator()
{
	// here we are verifying does this request is post back and have correct nonce
    if ( isset($_REQUEST['wpg-security']) && wp_verify_nonce($_REQUEST['wpg-security'])):

    	$function_name = isset($_POST['function_name']) ? $_POST['function_name'] : '';
		$text_domain = isset($_POST['text_domain']) ? $_POST['text_domain'] : '';
		$post_type = isset($_POST['post_type']) ? $_POST['post_type'] : '';
		$description = isset($_POST['description']) ? $_POST['description'] : '';
		
		$plural_name = isset($_POST['plural_name']) ? $_POST['plural_name'] : '';
		$singular_name = isset($_POST['singular_name']) ? $_POST['singular_name'] : '';

		$add_new = isset($_POST['add_new']) ? $_POST['add_new'] : '';
		$add_new_item = isset($_POST['add_new_item']) ? $_POST['add_new_item'] : '';
		$edit_item = isset($_POST['edit_item']) ? $_POST['edit_item'] : '';
		$new_item = isset($_POST['new_item']) ? $_POST['new_item'] : '';
		$view_item = isset($_POST['view_item']) ? $_POST['view_item'] : '';
		$view_items = isset($_POST['view_items']) ? $_POST['view_items'] : '';
		$not_found = isset($_POST['not_found']) ? $_POST['not_found'] : '';
		$not_found_in_trash = isset($_POST['not_found_in_trash']) ? $_POST['not_found_in_trash'] : '';
		$parent_item_colon = isset($_POST['parent_item_colon']) ? $_POST['parent_item_colon'] : '';
		$all_items = isset($_POST['all_items']) ? $_POST['all_items'] : '';
		$archives = isset($_POST['archives']) ? $_POST['archives'] : '';
		$attributes = isset($_POST['attributes']) ? $_POST['attributes'] : '';
		$insert_into_item = isset($_POST['insert_into_item']) ? $_POST['insert_into_item'] : '';
		$uploaded_to_this_item = isset($_POST['uploaded_to_this_item']) ? $_POST['uploaded_to_this_item'] : '';
		$featured_image = isset($_POST['featured_image']) ? $_POST['featured_image'] : '';
		$set_featured_image = isset($_POST['set_featured_image']) ? $_POST['set_featured_image'] : '';
		$remove_featured_image = isset($_POST['remove_featured_image']) ? $_POST['remove_featured_image'] : '';
		$use_featured_image = isset($_POST['use_featured_image']) ? $_POST['use_featured_image'] : '';
		$menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
		$filter_items_list = isset($_POST['filter_items_list']) ? $_POST['filter_items_list'] : '';
		$filter_by_date = isset($_POST['filter_by_date']) ? $_POST['filter_by_date'] : '';
		$items_list_navigation = isset($_POST['items_list_navigation']) ? $_POST['items_list_navigation'] : '';
		$items_list = isset($_POST['items_list']) ? $_POST['items_list'] : '';
		$item_published = isset($_POST['item_published']) ? $_POST['item_published'] : '';
		$item_published_privately = isset($_POST['item_published_privately']) ? $_POST['item_published_privately'] : '';
		$item_reverted_to_draft = isset($_POST['item_reverted_to_draft']) ? $_POST['item_reverted_to_draft'] : '';
		$item_scheduled = isset($_POST['item_scheduled']) ? $_POST['item_scheduled'] : '';
		$item_updated = isset($_POST['item_updated']) ? $_POST['item_updated'] : '';
		$item_link = isset($_POST['item_link']) ? $_POST['item_link'] : '';
		$item_link_description = isset($_POST['item_link_description']) ? $_POST['item_link_description'] : '';
		$name_admin_bar = isset($_POST['name_admin_bar']) ? $_POST['name_admin_bar'] : '';
		$update_item = isset($_POST['update_item']) ? $_POST['update_item'] : '';
		$search_items = isset($_POST['search_items']) ? $_POST['search_items'] : '';

		$taxonomies = isset($_POST['taxonomies']) ? implode("', '", explode(',', $_POST['taxonomies'])) : '';
		$hierarchical = isset($_POST['hierarchical']) ? $_POST['hierarchical'] : '';
		
		$supports = [];
		$supports_title = isset($_POST['supports_title'])&&$_POST['supports_title']?$supports[]='title':'';
		$supports_editor = isset($_POST['supports_editor'])&&$_POST['supports_editor']?$supports[]='editor':'';
		$supports_excerpt = isset($_POST['supports_excerpt'])&&$_POST['supports_excerpt']?$supports[]='excerpt':'';
		$supports_author = isset($_POST['supports_author'])&&$_POST['supports_author']?$supports[]='author':'';
		$supports_thumbnail = isset($_POST['supports_thumbnail'])&&$_POST['supports_thumbnail']?$supports[]='thumbnail':'';
		$supports_comments = isset($_POST['supports_comments'])&&$_POST['supports_comments']?$supports[]='comments':'';
		$supports_trackbacks = isset($_POST['supports_trackbacks'])&&$_POST['supports_trackbacks']?$supports[]='trackbacks':'';
		$supports_revisions = isset($_POST['supports_revisions'])&&$_POST['supports_revisions']?$supports[]='revisions':'';
		$supports_custom_fields = isset($_POST['supports_custom_fields'])&&$_POST['supports_custom_fields']?$supports[]='custom-fields':'';
		$supports_page_attributes = isset($_POST['supports_page_attributes'])&&$_POST['supports_page_attributes']?$supports[]='page-attributes':'';
		$supports_post_formats = isset($_POST['supports_post_formats'])&&$_POST['supports_post_formats']?$supports[]='post-formats':'';

		$exclude_from_search = isset($_POST['exclude_from_search']) ? $_POST['exclude_from_search'] : '';
		$can_export = isset($_POST['can_export']) ? $_POST['can_export'] : '';
		$delete_with_user = isset($_POST['delete_with_user']) ? $_POST['delete_with_user'] : '';
		$has_archive = isset($_POST['has_archive']) ? ($_POST['has_archive']=='custom') ? "'".$_POST['custom_archive_slug']."'" : $_POST['has_archive'] : '';
		$public = isset($_POST['public']) ? $_POST['public'] : '';
		$show_ui = isset($_POST['show_ui']) ? $_POST['show_ui'] : '';
		$show_in_menu = isset($_POST['show_in_menu']) ? $_POST['show_in_menu'] : '';
		$menu_position = isset($_POST['menu_position']) ? $_POST['menu_position'] : '';
		$menu_icon = isset($_POST['menu_icon']) ? $_POST['menu_icon'] : '';
		$show_in_admin_bar = isset($_POST['show_in_admin_bar']) ? $_POST['show_in_admin_bar'] : '';
		$show_in_nav_menus = isset($_POST['show_in_nav_menus']) ? $_POST['show_in_nav_menus'] : '';
		
		$query_var = isset($_POST['query_var']) ? $_POST['query_var'] : '';
		$publicly_queryable = isset($_POST['publicly_queryable']) ? $_POST['publicly_queryable'] : '';
		$custom_query_variable = isset($_POST['custom_query_variable']) ? $_POST['custom_query_variable'] : '';

		$generator = isset($_POST['generator']) ? $_POST['generator'] : '';

		$supports = $supports ? "array('".implode("', '", $supports)."')" : "false";


		// Rewrite functionality
		$rewrite = isset($_POST['rewrite']) ? $_POST['rewrite'] : '';
		$rewrite_slug = isset($_POST['rewrite_slug']) ? $_POST['rewrite_slug'] : '';
		$rewrite_with_front = isset($_POST['rewrite_with_front']) ? $_POST['rewrite_with_front'] : '';
		$rewrite_pages = isset($_POST['rewrite_pages']) ? $_POST['rewrite_pages'] : '';
		$rewrite_feeds = isset($_POST['rewrite_feeds']) ? $_POST['rewrite_feeds'] : '';


		// Capabilities functionality
		$capabilities = isset($_POST['capabilities']) ? $_POST['capabilities'] : '';
		$capabilities_read_post = isset($_POST['capabilities_read_post']) ? $_POST['capabilities_read_post'] : '';
		$capabilities_read_private_posts = isset($_POST['capabilities_read_private_posts']) ? $_POST['capabilities_read_private_posts'] : '';
		$capabilities_publish_posts = isset($_POST['capabilities_publish_posts']) ? $_POST['capabilities_publish_posts'] : '';
		$capabilities_delete_post = isset($_POST['capabilities_delete_post']) ? $_POST['capabilities_delete_post'] : '';
		$capabilities_edit_post = isset($_POST['capabilities_edit_post']) ? $_POST['capabilities_edit_post'] : '';
		$capabilities_edit_posts = isset($_POST['capabilities_edit_posts']) ? $_POST['capabilities_edit_posts'] : '';
		$capabilities_edit_others_posts = isset($_POST['capabilities_edit_others_posts']) ? $_POST['capabilities_edit_others_posts'] : '';

		$show_in_rest = isset($_POST['show_in_rest']) ? $_POST['show_in_rest'] : '';
		$rest_base = isset($_POST['rest_base']) ? $_POST['rest_base'] : '';
		$rest_controller_class = isset($_POST['rest_controller_class']) ? $_POST['rest_controller_class'] : '';


	$data = "
	// Register Custom Post Type
	function ".$function_name."() {
		\$labels = array(
			'name'                  	=> _x( '".$plural_name."', 'Post Type General Name', '".$text_domain."' ),
			'singular_name'         	=> _x( '".$singular_name."', 'Post Type Singular Name', '".$text_domain."' ),
			'add_new'               	=> __( '".$add_new."', '".$text_domain."' ),
			'add_new_item'          	=> __( '".$add_new_item."', '".$text_domain."' ),
			'edit_item'             	=> __( '".$edit_item."', '".$text_domain."' ),
			'new_item'              	=> __( '".$new_item."', '".$text_domain."' ),
			'view_item'             	=> __( '".$view_item."', '".$text_domain."' ),
			'view_items'            	=> __( '".$view_items."', '".$text_domain."' ),
			'not_found'             	=> __( '".$not_found."', '".$text_domain."' ),
			'not_found_in_trash'    	=> __( '".$not_found_in_trash."', '".$text_domain."' ),
			'parent_item_colon'     	=> __( '".$parent_item_colon."', '".$text_domain."' ),
			'all_items'             	=> __( '".$all_items."', '".$text_domain."' ),
			'archives'              	=> __( '".$archives."', '".$text_domain."' ),
			'attributes'            	=> __( '".$attributes."', '".$text_domain."' ),
			'insert_into_item'      	=> __( '".$insert_into_item."', '".$text_domain."' ),
			'uploaded_to_this_item' 	=> __( '".$uploaded_to_this_item."', '".$text_domain."' ),
			'featured_image'        	=> __( '".$featured_image."', '".$text_domain."' ),
			'set_featured_image'    	=> __( '".$set_featured_image."', '".$text_domain."' ),
			'remove_featured_image' 	=> __( '".$remove_featured_image."', '".$text_domain."' ),
			'use_featured_image'    	=> __( '".$use_featured_image."', '".$text_domain."' ),
			'menu_name'             	=> __( '".$menu_name."', '".$text_domain."' ),
			'filter_items_list'    		=> __( '".$filter_items_list."', '".$text_domain."' ),
			'filter_by_date '     		=> __( '".$filter_by_date ."', '".$text_domain."' ),
			'items_list_navigation' 	=> __( '".$items_list."', '".$text_domain."' ),
			'items_list'			=> __( '".$items_list."', '".$text_domain."' ),
			'item_published'		=> __( '".$item_published."', '".$text_domain."' ),
			'item_published_privately'	=> __( '".$item_published_privately."', '".$text_domain."' ),
			'item_reverted_to_draft'	=> __( '".$item_reverted_to_draft."', '".$text_domain."' ),
			'item_scheduled'		=> __( '".$item_scheduled."', '".$text_domain."' ),
			'item_updated'			=> __( '".$item_updated."', '".$text_domain."' ),
			'item_link'			=> __( '".$item_link."', '".$text_domain."' ),
			'item_link_description'		=> __( '".$item_link_description."', '".$text_domain."' ),
			'name_admin_bar'        	=> __( '".$name_admin_bar."', '".$text_domain."' ),
			'update_item'           	=> __( '".$update_item."', '".$text_domain."' ),
			'search_items'          	=> __( '".$search_items."', '".$text_domain."' ),
		);";

	if ($rewrite=='custom') {
		$data.= "
		\$rewrite = array(
			'slug'			=> '".$rewrite_slug."',
			'with_front'		=> '".$rewrite_with_front."',
			'feeds'			=> '".$rewrite_feeds."',
			'pages'          	=> '".$rewrite_pages."',
		);";
	}

	if ($capabilities=='custom') {
		$data.= "
		\$capabilities = array(
			'edit_post'				=> '".$capabilities_edit_post."',
			'read_post'             => '".$capabilities_read_post."',
			'delete_post'           => '".$capabilities_delete_post."',
			'edit_posts'            => '".$capabilities_edit_posts."',
			'edit_others_posts'     => '".$capabilities_edit_others_posts."',
			'publish_posts'         => '".$capabilities_publish_posts."',
			'read_private_posts'    => '".$capabilities_read_private_posts."',
		);";
	}

	$data.= "
		\$args = array(
			'label'                 => __( '".$singular_name."', '".$text_domain."' ),
			'labels'                => \$labels,
			'description'           => __( '".$description."', '".$text_domain."' ),
			'public'                => ".$public.",
			'hierarchical'          => ".$hierarchical.",
			'exclude_from_search'   => ".$exclude_from_search.",
			'publicly_queryable'    => ".$publicly_queryable.",
			'show_ui'               => ".$show_ui.",
			'show_in_menu'          => ".$show_in_menu.",
			'show_in_nav_menus'     => ".$show_in_nav_menus.",
			'show_in_admin_bar'     => ".$show_in_admin_bar.",";

	if ($show_in_rest!='') {
		$data.= "
			'show_in_rest'		=> '".$_POST['show_in_rest']."',";
	}

	if ($rest_base!='') {
		$data.= "
			'rest_base'             => '".$_POST['rest_base']."',";
	}

	if ($rest_controller_class!='') {
		$data.= "
			'rest_controller_class'	=> '".$_POST['rest_controller_class']."',";
	}

	$data.= "
			'menu_position'         => ".$menu_position.",";

	if ($menu_icon!='') {
		$data.= "
			'menu_icon'             => '".$_POST['menu_icon']."',";
	}

	if ($capabilities=='custom') {
		$data.= "
			'capabilities'          => \$capabilities,";
	} else {
		$data.= "
			'capability_type'       => '".$_POST['capability_type']."',";
	}

	$data.= "
			'supports'              => ".$supports.",
			'taxonomies'            => array( '".$taxonomies."' ),
			'has_archive'           => ".$has_archive.",";

	if ($rewrite=='custom') {
		$data.= "
			'rewrite'          	=> \$rewrite,";
	} elseif ($rewrite=='false'){
		$data.= "
			'rewrite'          	=> ".$_POST['rewrite'];
	}

	if ($query_var=='true') {
		$data.= "
			'query_var'             => '".$_POST['custom_query_variable']."',";
	}

	$data.= "
			'can_export'            => ".$can_export.",
			'supports'              => ".$supports.",";

	if ($delete_with_user!='') {
		$data.= "
			'delete_with_user'	=> '".$_POST['delete_with_user']."',";
	}

	$data.= "
		);
		register_post_type( '".$post_type."', \$args );
	}
	add_action( 'init', '".$function_name."', 0 );";

	wp_send_json_success( $data ); 
	wp_die();
	endif;
}