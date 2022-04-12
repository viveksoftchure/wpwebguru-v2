<?php
/**
 * @package wpwebguru
 */
if( !class_exists('wpwebguru_categories') )
{
    class wpwebguru_categories extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {
            $widget_options = array(
                'description'                   => esc_html__('WpWebGuru: Categories here', 'wpwebguru'),
                'customize_selective_refresh'   => true,
            );
            parent:: __construct('wpwebguru_categories', esc_html__( 'WpWebGuru: Categories', 'wpwebguru'), $widget_options );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            if ( ! isset( $args['widget_id'] ) ) 
            {
                $args['widget_id'] = $this->id;
            }

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $show_count 		  	= isset($instance['show_count']) ? $instance['show_count'] : false;

            $args_val = array( 'hide_empty=0' );
            $excludeCat = isset($instance['wpwebguru_selected_categories']) ? $instance['wpwebguru_selected_categories'] : '';
            $wpwebguru_action_on_cat = isset($instance['wpwebguru_action_on_cat']) ? $instance['wpwebguru_action_on_cat'] : '';
            if($excludeCat && $wpwebguru_action_on_cat!='')
                $args_val[$wpwebguru_action_on_cat] = $excludeCat;

            $terms = get_terms( $instance['wpwebguru_taxonomy_type'], $args_val );

            echo $args['before_widget'];
            if( $title ):
                echo $args['before_title'];
                echo esc_html( $title );
                echo $args['after_title'];
            endif;
            ?>
            <?php if($instance['wpwebguru_taxonomy_type']){ ?>
            <!-- Start Single Widget  -->
            <?php
            if ( $terms ) 
            {
                ?>
                <ul>
                    <?php
                    foreach ( $terms as $term ) 
                    {
                        $term_link = get_term_link( $term );

                        if ( is_wp_error( $term_link ) ) 
                        {
                            continue;
                        }

                        if( $term->taxonomy=='category' && is_category())
                        {
                            $thisCat = get_category(get_query_var('cat'),false);
                            if($thisCat->term_id == $term->term_id)
                                $carrentActiveClass='class="active-cat"';
                        }

                        if(is_tax())
                        {
                            $currentTermType = get_query_var( 'taxonomy' );
                            $termId= get_queried_object()->term_id;
                            if(is_tax($currentTermType) && $termId==$term->term_id)
                                $carrentActiveClass = 'class="active-cat"';
                        }

                        ?>
                        <li class="cat-item">
                            <a href="<?php echo esc_url( $term_link ); ?>" class="inner">
                                <?php
                                $category_image_id 	= get_term_meta( $term->term_id, 'wpwebguru_category_background_image', true );
                                $image = wp_get_attachment_url($category_image_id);
                                if ($image)
                                { 
                                    ?>
                                    <div class="thumbnail">
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($term->name); ?>">
                                    </div>
                                    <?php 
                                } ?>
                                <?php if ( !empty($term->name) ): ?>
                                    <div class="content">
                                        <h5 class="title"><?php echo esc_html($term->name); ?>
                                            <?php if ( $show_count): ?>
                                                <span class="counter">(<?php echo wp_kses_post($term->count); ?>)</span>
                                            <?php endif ?>

                                        </h5>
                                    </div>
                                <?php endif ?>
                            </a>
                        </li>
                        <?php
                    }
                } ?>
                </ul>
             <!-- End Single Widget  -->
            <?php } ?>
            <?php echo $args['after_widget']; ?>

            <?php wp_reset_postdata();
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
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['show_count'] = isset( $new_instance['show_count'] ) ? (bool) $new_instance['show_count'] : false;
            $instance['hide_empty_category'] = isset( $new_instance['hide_empty_category'] ) ? (bool) $new_instance['hide_empty_category'] : false;

            $instance['wpwebguru_taxonomy_type'] = ( ! empty( $new_instance['wpwebguru_taxonomy_type'] ) ) ? strip_tags( $new_instance['wpwebguru_taxonomy_type'] ) : '';
            $instance['wpwebguru_selected_categories'] = ( ! empty( $new_instance['wpwebguru_selected_categories'] ) ) ? $new_instance['wpwebguru_selected_categories'] : '';
            $instance['wpwebguru_action_on_cat'] = ( ! empty( $new_instance['wpwebguru_action_on_cat'] ) ) ? $new_instance['wpwebguru_action_on_cat'] : '';

            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */

        public function form( $instance ) 
        {
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $show_count          = isset( $instance['show_count'] ) ? (bool) $instance['show_count'] : true;
            $wpwebguru_taxonomy_type = ! empty( $instance['wpwebguru_taxonomy_type'] ) ? $instance['wpwebguru_taxonomy_type'] : esc_html__( 'category', 'wpwebguru' );
            $wpwebguru_selected_categories = ! empty( $instance['wpwebguru_selected_categories'] ) && ! empty( $instance['wpwebguru_action_on_cat'] ) ? $instance['wpwebguru_selected_categories'] : esc_html__( '', 'wpwebguru' );
            $wpwebguru_action_on_cat = ! empty( $instance['wpwebguru_action_on_cat'] ) ? $instance['wpwebguru_action_on_cat'] : esc_html__( '', 'wpwebguru' );

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','wpwebguru' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>

            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_count ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_count' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'show_count' )); ?>"><?php echo esc_html__( 'Show Count?','wpwebguru' ); ?></label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'wpwebguru_taxonomy_type' ) ); ?>"><?php _e( esc_attr( 'Taxonomy Type:' ) ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wpwebguru_taxonomy_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wpwebguru_taxonomy_type' ) ); ?>">
                    <?php
                    $args = array(
                        'public'   => true,
                        '_builtin' => false

                    );
                    $output = 'names'; // or objects
                    $operator = 'and'; // 'and' or 'or'
                    $taxonomies = get_taxonomies( $args, $output, $operator );
                    array_push($taxonomies,'category');
                    if ( $taxonomies ) {
                        foreach ( $taxonomies as $taxonomy ) 
                        {

                            echo '<option value="'.$taxonomy.'" '.selected($taxonomy,$wpwebguru_taxonomy_type).'>'.$taxonomy.'</option>';
                        }
                    }

                    ?>
                </select>
            </p>

            <p>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wpwebguru_action_on_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wpwebguru_action_on_cat' ) ); ?>">
                    <option value="" <?php selected($wpwebguru_action_on_cat,'' )?> ><?php esc_html_e('Show All Category:', 'wpwebguru') ?></option>
                    <option value="include" <?php selected($wpwebguru_action_on_cat,'include' )?> ><?php esc_html_e('Include Selected Category:', 'wpwebguru') ?></option>
                    <option value="exclude" <?php selected($wpwebguru_action_on_cat,'exclude' )?> ><?php esc_html_e('Exclude Selected Category:', 'wpwebguru') ?></option>
                </select>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wpwebguru_selected_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wpwebguru_selected_categories' ) ); ?>[]" multiple>
                    <?php
                    if($wpwebguru_taxonomy_type){
                        $args = array( 'hide_empty=0' );
                        $terms = get_terms( $wpwebguru_taxonomy_type, $args );
                        echo '<option value="" '.selected(true, in_array('',$wpwebguru_selected_categories), false).'>None</option>';
                        if ( $terms ) {
                            foreach ( $terms as $term ) {
                                echo '<option value="'.$term->term_id.'" '.selected(true, in_array($term->term_id,$wpwebguru_selected_categories), false).'>'.$term->name.'</option>';
                            }

                        }
                    }
                    ?>
                </select>
            </p>
            <?php
        }
    }
}

// register Contact  Widget widget
function wpwebguru_categories()
{
    register_widget('wpwebguru_categories');
}
add_action('widgets_init','wpwebguru_categories');