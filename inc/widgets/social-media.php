<?php

class wpwebguru_social_widget extends WP_Widget 
{
    public $default_fields;
    /**
     * Sets up the widgets name etc
     */
    public function __construct() 
    {
        $widget_ops = array(
            'classname' => 'wpwebguru_social_widget',
            'description' => esc_html__('WpWebGuru: Social Media Widget', 'wpwebguru'),
        );
        $this->default_fields = array(
            'title' => '',
            'fb' => '#',
            'tw' => '#',
            'ins' => '#',
            'pin' => '#',
            'led' => '#',
            'youtube' => '#',
        );
        parent::__construct( 'wpwebguru_social_widget', esc_html__('WpWebGuru: Social Media Widget', 'wpwebguru'), $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) 
    {
        if ( ! isset( $args['widget_id'] ) ) 
        {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];
        if( $title ):
            echo $args['before_title'];
            echo esc_html( $title );
            echo $args['after_title'];
        endif;
        ?>
            <ul class="social-icon md-size justify-content-center">
                <?php if($instance['fb']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['fb'])?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                <?php }?>
                <?php if($instance['tw']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['tw'])?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                <?php }?>
                <?php if($instance['ins']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['ins'])?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                <?php }?>
                <?php if($instance['pin']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['pin'])?>">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                <?php }?>
                <?php if($instance['led']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['led'])?>">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                <?php }?>
                <?php if(isset($instance['youtube']) && $instance['youtube']){?>
                    <li>
                        <a href="<?php echo esc_url($instance['youtube'])?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                <?php }?>
            </ul>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) 
    {
        // outputs the options form on admin

        $instance = wp_parse_args( $instance, $this->default_fields );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>"><?php esc_attr_e( 'Facebook Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb' ) ); ?>" type="text" value="<?php print $instance['fb']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>"><?php esc_attr_e( 'Twitter Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw' ) ); ?>" type="text" value="<?php print $instance['tw']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>"><?php esc_attr_e( 'Instagram Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ins' ) ); ?>" type="text" value="<?php print $instance['ins']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pin' ) ); ?>"><?php esc_attr_e( 'Pinterest Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pin' ) ); ?>" type="text" value="<?php print $instance['pin']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'led' ) ); ?>"><?php esc_attr_e( 'Linkedin Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'led' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'led' ) ); ?>" type="text" value="<?php print $instance['led']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_attr_e( 'Youtube Link:', 'wpwebguru' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php print $instance['youtube']; ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) 
    {
        // processes widget options to be saved
        $instance = array();
        foreach($this->default_fields as $key => $def)
        {
            $instance[$key] = $new_instance[$key];
        }

        return $instance;
    }
}


function register_wpwebguru_social_widget()
{
    register_widget('wpwebguru_social_widget');
}
add_action('widgets_init', 'register_wpwebguru_social_widget');