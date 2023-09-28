<?php if(is_user_logged_in()) : ?>

    <?php if ( isset($_GET['updated_pass']) && $_GET['updated_pass'] == 'true' ) : ?> 
        <div class="notification success closeable margin-bottom-35"><p><?php esc_html_e('Your password has been updated.', 'wpwg'); ?></p><a class="close" href="#"></a></div> 
    <?php endif; ?>

    <?php  if ( isset($_GET['err_pass']) && !empty($_GET['err_pass'])  ) : ?> 
        <div class="notification error closeable margin-bottom-35"><p>
            <?php
            switch ($_GET['err_pass']) {
                case 'error_1':
                    echo esc_html_e('Your current password does not match. Please retry.','wpwg');
                    break;
                case 'error_2':
                    echo esc_html_e('The passwords do not match. Please retry..','wpwg');
                    break;                      
                case 'error_3':
                    echo esc_html_e('A bit short as a password, don\'t you think?','wpwg');
                    break;                      
                case 'error_4':
                    echo esc_html_e('Password may not contain the character "\\" (backslash).','wpwg');
                    break;
                case 'error_5':
                    echo esc_html_e('An error occurred while updating your profile. Please retry.','wpwg');
                    break;
                case 'error_6':
                    echo esc_html_e('Please fill password fields.','wpwg');
                    break;
                
                default:
                    # code...
                    break;
             }  ?>
                
            </p><a class="close" href="#"></a>
        </div> 
    <?php endif; ?>
    <form name="resetpasswordform" action="" method="post">
        <label><?php esc_html_e('Current Password','wpwg'); ?></label>
        <input type="password" name="current_pass">

        <label for="pass1"><?php esc_html_e('New Password','wpwg'); ?></label>
        <input name="pass1" type="password">

        <label for="pass2"><?php esc_html_e('Confirm New Password','wpwg'); ?></label>
        <input name="pass2" type="password">

        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="<?php esc_html_e('Save Changes','wpwg'); ?>" />
        
        <input type="hidden" name="password-change" value="1" />
    </form>
<?php endif; ?>