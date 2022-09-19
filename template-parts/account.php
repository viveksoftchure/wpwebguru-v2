<div class="wpwg-dashboard-container">
    <nav class="wpwg-dashboard-navigation">
        <ul>
            <?php
                if ( is_user_logged_in() ) {
                    foreach ( $sections as $section => $label ) {
                        // backward compatibility
                        if ( is_array( $label ) ) {
                            $section = $label['slug'];
                            $label   = $label['label'];
                        }


                        $default_active_tab = 'dashboard' ;
                        $active_tab         = false;

                        if ( ( isset( $_GET['section'] ) && $_GET['section'] == $section ) || ( !isset( $_GET['section'] ) && $default_active_tab == $section ) ) {
                            $active_tab = true;
                        }

                        $active = $active_tab ? $section . ' active' : $section;
                        echo sprintf(
                            '<li class="wpwg-menu-item %s"><a href="%s">%s</a></li>',
                            esc_attr( $active ),
                            esc_attr( add_query_arg( [ 'section' => $section ], get_permalink() ) ),
                            esc_attr( $label )
                         );
                    }
                    echo sprintf(
                        '<li class="wpwg-menu-item"><a href="%s">%s</a></li>',
                        esc_url( wp_logout_url(get_permalink()) ),
                        esc_attr( 'Logout' )
                     );
                }
            ?>
        </ul>
    </nav>

    <div class="wpwg-dashboard-content <?php echo ( !empty( $current_section ) ) ? esc_attr( $current_section ) : ''; ?>">
        <div class="account-notices-wrapper">
            <?php foreach (alert_shift() as $type => $value): ?>
                <?php if($value): ?>
                    <div class="alert alert-<?=$type?>" role="alert"><?=$value?></div>
                <?php endif; ?>
            <?php endforeach; ?> 
        </div>
        <?php
            if ( !empty( $current_section ) && is_user_logged_in() ) {
                do_action( "wpwg_account_content_{$current_section}", $sections, $current_section );
            }
        ?>
    </div>
</div>
