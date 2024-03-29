<?php
/**
 * @package wpwebguru
 */

if( !class_exists('wpwebguru_Info_Widget') )
{
    class wpwebguru_Info_Widget extends WP_Widget
    {
    	/**
         * Register widget with WordPress.
         */
        function __construct()
        {
            $widget_options = array(
                'description'                   => esc_html__('WpWebGuru: Info here', 'wpwebguru'),
                'customize_selective_refresh'   => true,
            );
            parent:: __construct('wpwebguru_Info_Widget', esc_html__( 'WpWebGuru: Info', 'wpwebguru'), $widget_options );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget( $args, $instance )
        {
        	echo wp_kses_post( $args['before_widget'] );
        	if ( ! empty( $instance['title'] ) ) 
            {
        		echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
        	}
            $light_logo = isset( $instance['light_logo'] ) ? $instance['light_logo'] : '';
        	$dark_logo = isset( $instance['dark_logo'] ) ? $instance['dark_logo'] : '';
        	$content = isset( $instance['content'] ) ? $instance['content'] : '';
        	?>
            
            <div class="widget-content">
                <div class="footer-logo-wrap">
                    <?php if (!empty($light_logo)): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-light-logo"><img src="<?php echo esc_url( $light_logo ) ; ?>" alt="<?php echo esc_attr('Logo'); ?>"></a>
                    <?php endif; ?>
                    <?php if (!empty($dark_logo)): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-dark-logo">
                            <img src="<?php echo esc_url( $dark_logo ) ; ?>" alt="<?php echo esc_attr('Logo'); ?>">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="site-description">
                    <?php if ( !empty($content) ): ?>
                        <?php echo wpautop( $content ); ?>
                    <?php endif ?>
                </div>
            </div>
        	<?php
        	echo wp_kses_post( $args['after_widget'] );
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update( $new_instance, $old_instance )
        {
        	$instance                  = array();
        	$instance['title']         = (!empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
            $instance['light_logo']     = (!empty( $new_instance['light_logo'] ) ) ? strip_tags ( $new_instance['light_logo'] ) : '';
        	$instance['dark_logo']     = (!empty( $new_instance['dark_logo'] ) ) ? strip_tags ( $new_instance['dark_logo'] ) : '';
        	$instance['content']       = (!empty( $new_instance['content'] ) ) ? strip_tags ( $new_instance['content'] ) : '';
        	if ( current_user_can( 'unfiltered_html' ) ) 
            {
                $instance['content'] = $new_instance['content'];
			} 
            else 
            {
                $instance['content'] = wp_kses_post( $new_instance['content'] );
			}
        	return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        { 
            $light_logo = !empty( $instance['light_logo'] ) ? $instance['light_logo'] : '';
        	$dark_logo = !empty( $instance['dark_logo'] ) ? $instance['dark_logo'] : '';
        	$title = !empty( $instance['title'] ) ? $instance['title'] : '';
        	$content = !empty( $instance['content'] ) ? $instance['content'] : ''; 
        	?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:' ,'wpwebguru') ?></label>
				<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_textarea( $title ); ?>">
			</p>
			<div class="image_box_wrap" style="margin:20px 0 15px 0; width: 100%;">
                <label for="<?php echo esc_attr($this->get_field_id('light_logo')); ?>"><?php echo esc_html__('Light Logo:' ,'wpwebguru') ?></label>
				<div class="image_box widefat">
					<img src="<?php if( !empty($light_logo)){echo esc_html($light_logo);} ?>" style="margin:15px 0 0 0;padding:0;max-width: 100%;display:inline-block; height: auto;" alt="<?php echo esc_attr(''); ?>" />
				</div>
				<input type="text" class="widefat image_link" name="<?php echo esc_attr($this->get_field_name('light_logo')); ?>" id="<?php echo esc_attr($this->get_field_id('light_logo')); ?>" value="<?php echo esc_attr($light_logo); ?>" style="margin:15px 0 0 0;">
                <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php echo esc_html__('Dark Logo:' ,'wpwebguru') ?></label>
                <div class="image_box widefat">
                    <img src="<?php if( !empty($dark_logo)){echo esc_html($dark_logo);} ?>" style="margin:15px 0 0 0;padding:0;max-width: 100%;display:inline-block; height: auto;" alt="<?php echo esc_attr(''); ?>" />
                </div>
                <input type="text" class="widefat image_link" name="<?php echo esc_attr($this->get_field_name('dark_logo')); ?>" id="<?php echo esc_attr($this->get_field_id('dark_logo')); ?>" value="<?php echo esc_attr($dark_logo); ?>" style="margin:15px 0 0 0;">
			</div>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php echo esc_html__('Content:' ,'wpwebguru') ?></label>
				<textarea  id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" rows="7" class="widefat" ><?php echo esc_textarea( $content ); ?></textarea>
			</p>
        	<?php
        }
	}
}
function wpwebguru_Info_Widget()
{
    register_widget('wpwebguru_Info_Widget');
}
add_action('widgets_init','wpwebguru_Info_Widget');