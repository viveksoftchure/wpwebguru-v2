<!-- Start Login/Signup form  -->
<div class="login-container hidden" id="login-container">
    <div class="account-box">
        <div class="form-container sign-up-container">
            <form id="register" action="login" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="mb-4">or use your email for registration</span>
                <input type="text" id="username" name="username" placeholder="username">
                <input type="text" id="email" name="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password" />
                <button>Sign Up</button>
                <?php wp_nonce_field( 'ajax-register-nonce', 'register_security' ); ?>
                <div class="register_msg" style="display: none;"></div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form id="login" action="login" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="mb-4">or use your account</span>
                <input type="text" id="user_login" name="user_login" placeholder="username">
                <input type="password" name="user_password" id="user_password" placeholder="Password" />
                <label for="rememberme" class="rememberme">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e('Remember Me','listeo_core'); ?></label>
                <a href="<?php echo wp_lostpassword_url(); ?>" class="lost-password">Forgot your password?</a>
                <button type="submit" class="">Sign In</button>
                <?php wp_nonce_field( 'ajax-login-nonce', 'login_security' ); ?>
                <div class="login_msg" style="display: none;"></div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <button class="close-form left-btn">Hide</button>
                <button class="close-form right-btn">Hide</button>
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Login/Signup form  -->