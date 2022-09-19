<?php

/**
 * WpWebGuru functions and definitions
 *
 * @package WpWebGuru
 */
define( 'WWG_ROOT', __DIR__ );

/**
 * Set up theme defaults and register support for various WordPress features
 */
require WWG_ROOT . '/inc/after-setup-theme.php';

/**
 * Enqueue scripts and styles.
 */
require WWG_ROOT . '/inc/enqueue-scripts.php';

/**
 * Add preload for CDN
 */
require WWG_ROOT . '/inc/resource-hints.php';

/**
 * template Functions
 */
require WWG_ROOT . '/inc/template-functions.php';

/**
 * Custom control
 */
require WWG_ROOT . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require WWG_ROOT . '/inc/customizer.php';

/**
 * template tags
 */
require WWG_ROOT . '/inc/template-tags.php';

/**
 * Register Custom Widget Area
 */
require WWG_ROOT . '/inc/widgets-init.php';

/**
 * custom WordPress nav walker
 */
require WWG_ROOT . '/inc/bootstrap_walker_nav_menu.php';

/**
 * Register Custom Fonts
 */
require WWG_ROOT . '/inc/register-custom-fonts.php';

/**
 * Register Custom widgets
 */
require WWG_ROOT . '/inc/widgets/custom-widget-register.php';

/**
 * Related Post
 */
require WWG_ROOT . '/template-parts/post-related-grid.php';

/**
 * breadcrumb
 */
require WWG_ROOT . '/template-parts/title/breadcrumb.php';

/**
 * allow svg
 */
require WWG_ROOT . '/inc/allow-svg.php';

/**
 * Customizer changes css
 */
require WWG_ROOT . '/inc/dynamic-css.php';


// global classes/functions
require WWG_ROOT . '/inc/class/frontend-account.php';








/*
* add extra fields to category edit form hook
*/
add_action( 'category_add_form_fields', 'extra_category_fields', 10 );
add_action( 'category_edit_form_fields', 'extra_category_fields', 10, 2 );
function extra_category_fields( $tag ) 
{    
    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option("category_$t_id");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_background_url"><?php _e('Category Background Url'); ?></label></th>
        <td>
            <input type="text" name="cat_meta[background_img]" id="cat_meta[background_img]" size="3" style="width:60%;" value="<?php echo $cat_meta['background_img'] ? $cat_meta['background_img'] : ''; ?>"><br />
            <span class="description"><?php _e('Background Image for category: use full url with '); ?></span>
        </td>
    </tr>
    <tr class="form-field">
    	<th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Category Logo Image Url'); ?></label></th>
    	<td>
    		<input type="text" name="cat_meta[img]" id="cat_meta[img]" size="3" style="width:60%;" value="<?php echo $cat_meta['img'] ? $cat_meta['img'] : ''; ?>"><br />
    		<span class="description"><?php _e('Logo Image for category: use full url with '); ?></span>
    	</td>
    </tr>
    <tr class="form-field">
    	<th scope="row" valign="top"><label for="icon"><?php _e('Category icon'); ?></label></th>
    	<td>
    		<input type="text" name="cat_meta[icon]" id="cat_meta[icon]" size="25" style="width:60%;" value="<?php echo $cat_meta['icon'] ? $cat_meta['icon'] : ''; ?>"><br />
    		<span class="description"><?php _e('extra field'); ?></span>
    	</td>
    </tr>
    <tr class="form-field">
    	<th scope="row" valign="top"><label for="color"><?php _e('Category color'); ?></label></th>
    	<td>
    		<input type="text" name="cat_meta[color]" id="cat_meta[color]" size="25" style="width:60%;" value="<?php echo $cat_meta['color'] ? $cat_meta['color'] : ''; ?>"><br />
    		<span class="description"><?php _e('extra field'); ?></span>
    	</td>
    </tr>
    <?php
}

// save extra category extra fields hook
add_action ( 'created_category', 'save_extra_category_fileds' );
add_action ( 'edited_category', 'save_extra_category_fileds');
function save_extra_category_fileds( $term_id ) 
{
    if ( isset( $_POST['cat_meta'] ) ) 
    {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['cat_meta']);

        foreach ($cat_keys as $key)
        {
            if (isset($_POST['cat_meta'][$key]))
            {
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}


/*
* add extra fields to user profile
*/
add_action('show_user_profile', 'crf_show_extra_profile_fields' );
add_action('edit_user_profile', 'crf_show_extra_profile_fields' );
function crf_show_extra_profile_fields( $user ) 
{
    $user_birth = get_the_author_meta('user_birth', $user->ID );
    $user_phone = get_the_author_meta('user_phone', $user->ID );

    $user_street = get_the_author_meta('user_street', $user->ID );
    $user_city = get_the_author_meta('user_city', $user->ID );
    $user_state = get_the_author_meta('user_state', $user->ID );
    $user_country = get_the_author_meta('user_country', $user->ID );

    $user_facebook = get_the_author_meta('user_facebook', $user->ID );
    $user_twitter = get_the_author_meta('user_twitter', $user->ID );
    $user_instagram = get_the_author_meta('user_instagram', $user->ID );
    ?>
    <h3><?php esc_html_e('Personal Information', 'theme'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_birth"><?php esc_html_e('Date of birth', 'theme'); ?></label></th>
            <td>
                <input type="date" name="user_birth" id="user_birth" value="<?php echo esc_attr($user_birth); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_phone"><?php esc_html_e('Phone No.', 'theme'); ?></label></th>
            <td>
                <input type="tel" name="user_phone" id="user_phone" value="<?php echo esc_attr($user_phone); ?>" class="regular-text"/>
            </td>
        </tr>
    </table>

    <h3><?php esc_html_e('Address Information', 'theme'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_street"><?php esc_html_e('Street address', 'theme'); ?></label></th>
            <td>
                <input type="text" name="user_street" id="user_street" value="<?php echo esc_attr($user_street); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_city"><?php esc_html_e('City', 'theme'); ?></label></th>
            <td>
                <input type="text" name="user_city" id="user_city" value="<?php echo esc_attr($user_city); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_state"><?php esc_html_e('State', 'theme'); ?></label></th>
            <td>
                <input type="text" name="user_state" id="user_state" value="<?php echo esc_attr($user_state); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_country"><?php esc_html_e('Country', 'theme'); ?></label></th>
            <td>
                <input type="text" name="user_country" id="user_country" value="<?php echo esc_attr($user_country); ?>" class="regular-text"/>
            </td>
        </tr>
    </table>

    <h3><?php esc_html_e('Social Information', 'theme'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook url', 'theme'); ?></label></th>
            <td>
                <input type="url" name="user_facebook" id="user_facebook" value="<?php echo esc_attr($user_facebook); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter url', 'theme'); ?></label></th>
            <td>
                <input type="url" name="user_twitter" id="user_twitter" value="<?php echo esc_attr($user_twitter); ?>" class="regular-text"/>
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram url', 'theme'); ?></label></th>
            <td>
                <input type="url" name="user_instagram" id="user_instagram" value="<?php echo esc_attr($user_instagram); ?>" class="regular-text"/>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'user_profile_update_errors', 'crf_user_profile_update_errors', 10, 3 );
function crf_user_profile_update_errors( $errors, $update, $user ) 
{
    if ( ! $update ) 
    {
        return;
    }

    if (empty( $_POST['user_birth'])) 
    {
        $errors->add('user_birth_error', __('<strong>ERROR</strong>: Please enter your date of birth.', 'crf'));
    }

    if (empty( $_POST['user_phone'])) 
    {
        $errors->add('user_phone_error', __('<strong>ERROR</strong>: Please enter your phone no.', 'crf'));
    }
}


add_action( 'personal_options_update', 'crf_update_profile_fields' );
add_action( 'edit_user_profile_update', 'crf_update_profile_fields' );
function crf_update_profile_fields( $user_id ) 
{
    if ( ! current_user_can('edit_user', $user_id ) ) 
    {
        return false;
    }

    if (!empty($_POST['user_birth'])) 
    {
        update_user_meta($user_id, 'user_birth', $_POST['user_birth']);
    }
    if (!empty($_POST['user_phone'])) 
    {
        update_user_meta($user_id, 'user_phone', $_POST['user_phone']);
    }

    if (!empty($_POST['user_street'])) 
    {
        update_user_meta($user_id, 'user_street', $_POST['user_street']);
    }
    if (!empty($_POST['user_city'])) 
    {
        update_user_meta($user_id, 'user_city', $_POST['user_city']);
    }
    if (!empty($_POST['user_state'])) 
    {
        update_user_meta($user_id, 'user_state', $_POST['user_state']);
    }
    if (!empty($_POST['user_country'])) 
    {
        update_user_meta($user_id, 'user_country', $_POST['user_country']);
    }

    if (!empty($_POST['user_facebook'])) 
    {
        update_user_meta($user_id, 'user_facebook', $_POST['user_facebook']);
    }
    if (!empty($_POST['user_twitter'])) 
    {
        update_user_meta($user_id, 'user_twitter', $_POST['user_twitter']);
    }
    if (!empty($_POST['user_instagram'])) 
    {
        update_user_meta($user_id, 'user_instagram', $_POST['user_instagram']);
    }
}




/*===================================================================
========= load more post ajax
====================================================================*/
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
function more_post_ajax()
{
    $ppp = isset($_POST["ppp"])&&!empty($_POST["ppp"]) ? $_POST["ppp"] : 3;
    $offset = isset($_POST["offset"])&&!empty($_POST["offset"]) ? $_POST["offset"] : 3;
    $page = isset($_POST['pageNumber'])&&!empty($_POST['pageNumber']) ? $_POST['pageNumber'] : 0;
    $category = isset($_POST['category'])&&!empty($_POST['category']) ? $_POST['category'] : '';
    $author = isset($_POST['author'])&&!empty($_POST['author']) ? $_POST['author'] : '';
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'paged'    => $page,
        'offset' => $offset,
        'author' => $author,
        'category_name' => $category,
        'post_status' => 'publish',
    );

    $loop = new WP_Query($args);

    $path = WWG_ROOT .'/template-parts/post-card/post-card-2.php';

    if ($loop -> have_posts()) : 

        while ($loop -> have_posts()) : $loop -> the_post();
            include($path);
        endwhile;

    endif;
    wp_reset_postdata();
    die();
}