<?php

/**
 * Used any time that get_search_form() is called.
 *
 * @package WpWebGuru
 */
$wpwebguru_unique_id = wp_unique_id('search-');
?>
<div class="inner">
    <form  id="<?php echo esc_attr($wpwebguru_unique_id); ?>"  action="<?php echo esc_url(home_url( '/' )); ?>" method="GET" class="blog-search">
        <div class="theme-search form-group">
            <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
            <input type="text"  name="s"  placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'blogar' ); ?>" value="<?php echo get_search_query(); ?>"/>
        </div>
    </form>
</div>