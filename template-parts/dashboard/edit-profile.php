<?php

global $current_user;
ob_start();

?>

<form class="wpwg-form wpwg-update-profile-form" action="" method="post">

    <div style="display: none;" class="wpwg-success">
        <?php esc_html_e( 'Profile updated successfully!', 'wp-user-frontend' ); ?>
    </div>
    <div style="display: none;" class="wpwg-error">
        <?php esc_html_e( 'Something went wrong!', 'wp-user-frontend' ); ?>
    </div>

    <div class="form-group">
        <label for="first_name"><?php esc_html_e( 'First Name ', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo esc_attr( $current_user->first_name ); ?>" required>
    </div>

    <div class="form-group">
        <label for="last_name"><?php esc_html_e( 'Last Name ', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo esc_attr( $current_user->last_name ); ?>" required>
    </div>

    <div class="form-group">
        <label for="email"><?php esc_html_e( 'Email Address ', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="email" class="input-text" name="email" id="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required>
    </div>

    <fieldset>
        <legend>Password change</legend>
        <div class="form-group">
            <label for="current_password"><?php esc_html_e( 'Current Password', 'wp-user-frontend' ); ?></label>
            <input type="password" class="input-text" name="current_password" id="current_password" size="16" value="" autocomplete="off" />
            <span class="wpwg-help"><?php esc_html_e( 'Leave this field empty to keep your password unchanged.', 'wp-user-frontend' ); ?></span>
        </div>

        <div class="form-group">
            <label for="pass1"><?php esc_html_e( 'New Password', 'wp-user-frontend' ); ?></label>
            <input type="password" class="input-text" name="pass1" id="pass1" size="16" value="" autocomplete="off" />
        </div>

        <div class="form-group">
            <label for="pass2"><?php esc_html_e( 'Confirm New Password', 'wp-user-frontend' ); ?></label>
            <input type="password" class="input-text" name="pass2" id="pass2" size="16" value="" autocomplete="off" />
        </div>
    </fieldset>

    <?php wp_nonce_field( 'wpwg-account-update-profile' ); ?>
    <input type="hidden" name="action" value="wpwg_account_update_profile">
    <button type="submit" name="update_profile" id="wpwg-account-update-profile" class="btn btn-primary"><?php esc_html_e( 'Update Profile', 'wp-user-frontend' ); ?></button>

</form>

<?php
    $output = apply_filters( 'wpwg_account_edit_profile_content', ob_get_clean() );
    echo $output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
?>
