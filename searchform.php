<?php

/**
 * Used any time that get_search_form() is called.
 *
 * @package WpWebGuru
 */
$wpwebguru_unique_id = wp_unique_id('search-');
?>
<form  id="<?php echo esc_attr($wpwebguru_unique_id); ?>"  action="<?php echo esc_url(home_url( '/' )); ?>" method="GET" class="search-form">
    <div class="search-form-box flex">
    	<input type="text"  name="s"  placeholder="<?php echo esc_attr_x( 'Type to search', 'placeholder', 'blogar' ); ?>" value="<?php echo get_search_query(); ?>" class="search-input" id="search-input" aria-label="Type to search" role="searchbox">
    </div>
</form>