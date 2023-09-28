<?php

global $current_user;
ob_start();

?>

<form class="wpwg-form wpwg-update-profile-form" action="" method="post">

    <div class="form-group">
        <label for="username"><?php esc_html_e( 'Username', 'wp-user-frontend' ); ?></label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo esc_attr( $current_user->user_login ); ?>" disabled="disabled">
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
        <input type="email" class="input-text" name="email" id="email" value="<?php echo esc_attr( $current_user->user_email ); ?>">
    </div>

    <div class="form-group">
        <label for="username"><?php esc_html_e( 'Nickname (Display Name)', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo esc_attr( $current_user->nickname ); ?>" required>
    </div>

    <div class="form-group">
        <label for="user_birth"><?php esc_html_e( 'Date of birth', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="date" class="form-control" name="user_birth" id="user_birth" value="<?php echo esc_attr( $current_user->user_birth ); ?>">
    </div>

    <div class="form-group">
        <label for="user_phone"><?php esc_html_e( 'User Phone', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <input type="text" class="form-control" name="user_phone" id="user_phone" value="<?php echo esc_attr( $current_user->user_phone ); ?>">
    </div>

    <div class="form-group">
        <label for="description"><?php esc_html_e( 'Biographical Info:', 'wp-user-frontend' ); ?><span class="required">*</span></label>
        <textarea name="description" class="textarea mini no-resize" id="description"><?php echo esc_attr( $current_user->description ); ?></textarea>
    </div>

    <?php wp_nonce_field( 'wpwg-account-update-profile' ); ?>
    <input type="hidden" name="action" value="wpwg_account_update_profile">
    <button type="submit" name="update_profile" id="wpwg-account-update-profile" class="btn btn-primary"><?php esc_html_e( 'Update Profile', 'wp-user-frontend' ); ?></button>

</form>