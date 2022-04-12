<?php

/**
 * WpWebGuru functions and definitions
 *
 * @package WpWebGuru
 */

/**
 * Set up theme defaults and register support for various WordPress features
 */
require get_template_directory() . '/inc/after-setup-theme.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue-scripts.php';

/**
 * Add preload for CDN
 */
require get_template_directory() . '/inc/resource-hints.php';

/**
 * template Functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom control
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Register Custom Widget Area
 */
require get_template_directory() . '/inc/widgets-init.php';

/**
 * custom WordPress nav walker
 */
require get_template_directory() . '/inc/bootstrap_walker_nav_menu.php';

/**
 * Register Custom Fonts
 */
require get_template_directory() . '/inc/register-custom-fonts.php';

/**
 * Register Custom widgets
 */
require get_template_directory() . '/inc/widgets/custom-widget-register.php';

/**
 * Related Post
 */
require get_template_directory() . '/template-parts/post-related-grid.php';

/**
 * breadcrumb
 */
require get_template_directory() . '/template-parts/title/breadcrumb.php';

/**
 * allow svg
 */
require get_template_directory() . '/inc/allow-svg.php';

/**
 * Customizer changes css
 */
require get_template_directory() . '/inc/dynamic-css.php';








//add extra fields to category edit form hook
add_action( 'category_add_form_fields', 'extra_category_fields', 10 );
add_action( 'category_edit_form_fields', 'extra_category_fields', 10, 2 );
function extra_category_fields( $tag ) 
{    
    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option("category_$t_id");
    ?>
    <tr class="form-field">
    	<th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Category Image Url'); ?></label></th>
    	<td>
    		<input type="text" name="cat_meta[img]" id="cat_meta[img]" size="3" style="width:60%;" value="<?php echo $cat_meta['img'] ? $cat_meta['img'] : ''; ?>"><br />
    		<span class="description"><?php _e('Image for category: use full url with '); ?></span>
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
