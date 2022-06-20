<?php

/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 *
 * @package WpWebGuru
 */
$fb_link = get_theme_mod('social_link_fb', '');
$twitter_link = get_theme_mod('social_link_twitter', '');
$instagram_link = get_theme_mod('social_link_instagram', '');
$git_link = get_theme_mod('social_link_git', '');
$youtube_link = get_theme_mod('social_link_youtube', '');

$subscribe = false;
?>
            <?php if($subscribe==true): ?>
                <section class="email-subs">
                    <div class="container">
                        <div class="email-subs-wrap text-center">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 122 55"><path d="M80.265 5.637a1.563 1.563 0 000 3.125h.045a1.563 1.563 0 000-3.125h-.045zM59.345 43.791a1.563 1.563 0 000 3.126h24.623a1.563 1.563 0 100-3.126H59.345z"/><path fill-rule="evenodd" d="M44.922 0h72.763a4.172 4.172 0 014.159 4.158v45.737a4.17 4.17 0 01-4.158 4.158H44.922a4.17 4.17 0 01-4.158-4.158V4.158A4.17 4.17 0 0144.922 0zm38.774 27.442l16.523-12.393h-5.43a1.563 1.563 0 010-3.126h9.597l4.215-3.161H86.715a1.563 1.563 0 010-3.125h25.328c.204 0 .399.039.578.11l3.504-2.629H46.482l32.43 24.324c.583.444 1.478.722 2.392.718.913.004 1.808-.274 2.392-.718zm6.451-.942l-4.582 3.437c-1.247.929-2.765 1.338-4.262 1.34-1.498-.003-3.015-.412-4.261-1.34L72.46 26.5 46.134 50.876a.2.2 0 01-.01.012l-.01.01-.01.009-.014.013-.006.006-.008.009h70.456l-.023-.023a.337.337 0 01-.035-.035L90.147 26.5zM69.95 24.617L43.883 5.067v43.634l26.066-24.084zm22.71 0l26.065-19.55V48.7L92.658 24.617z" clip-rule="evenodd"/><path d="M2.654 23.901a1.563 1.563 0 000 3.125h15.383a1.563 1.563 0 100-3.125H2.654zM24.288 25.464c0-.863.7-1.563 1.563-1.563h9.99a1.563 1.563 0 010 3.125h-9.99c-.863 0-1.563-.7-1.563-1.562zM5.373 17.876c0-.863.7-1.563 1.563-1.563h25.328a1.563 1.563 0 110 3.126H6.936c-.863 0-1.563-.7-1.563-1.563zM22.599 39.077a1.563 1.563 0 000 3.125h14.353a1.563 1.563 0 000-3.125H22.6zM.157 40.64c0-.864.7-1.563 1.562-1.563h14.354a1.563 1.563 0 010 3.125H1.719c-.863 0-1.562-.7-1.562-1.563zM15.662 31.489a1.563 1.563 0 000 3.125h16.602a1.563 1.563 0 100-3.125H15.662zM7.162 33.052c0-.864.7-1.563 1.562-1.563h.344a1.563 1.563 0 110 3.125h-.344c-.863 0-1.562-.7-1.562-1.562z"/></svg>            </div>
                            <h2 class="h1 email-subs-section-title">Subscribe to newsletter</h2>
                            <div class="email-subs-section-description">
                                Stay up to date! Get all the latest posts delivered straight to your inbox.
                            </div>
                            <div class="form-wrap">
                                <form class="subscribe-form text-left" data-members-form="subscribe">
                                    <div class="form-field-wrap field-group-inline">
                                        <label for="name" class="sr-only">Name</label>
                                        <input data-members-name="" type="text" class="name form-field input-field" id="name" placeholder="Your name" required="" autocomplete="off">
                                        <label for="email" class="sr-only">Email</label>
                                        <input data-members-email="" type="email" class="email form-field input-field" id="email" placeholder="Your email address" required="" autocomplete="off">
                                        <button class="btn form-field" type="submit"><span>Subscribe</span></button>
                                    </div>
                                    <div class="message-container">
                                        <div class="notification success form-notification">
                                            <a class="notification-close" href="javascript:;" aria-label="close notification"><span class="close-icon"><svg><use xlink:href="#i-close"/></svg></span></a>
                                            <strong>Great!</strong> Check your inbox and click the link to confirm your subscription.
                                        </div>
                                        <div class="notification error form-notification">
                                            <a class="notification-close" href="javascript:;" aria-label="close notification"><span class="close-icon"><svg><use xlink:href="#i-close"/></svg></span></a>
                                            <strong>Error!</strong> Please enter a valid email address!
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <footer class="site-footer">
                <div class="container">
                    <div class="footer-top">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="footer-widget widget-about">
                                    <div class="widget-content">
                                        <div class="footer-logo-wrap">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-light-logo">
                                                <?php
                                                $logo = get_theme_mod( 'custom_logo' );
                                                $logo_url = wp_get_attachment_image_src( $logo , 'full' );
                                                if ( has_custom_logo() )
                                                {
                                                    echo '<img src="' . esc_url( $logo_url[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                                                } else {
                                                    echo '<img src="'.get_template_directory_uri().'/assets/images/logo-blue.svg" >';
                                                }
                                                ?>
                                            </a>
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-img theme-dark-logo">
                                                <img src="<?= get_theme_mod('dark_logo') ?>" alt="wpwebguru">
                                            </a>
                                        </div>
                                        <div class="site-description">
                                            An architect, software developer, YouTuber and keynote speaker. On this site I write about my learning and experience.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="widget secondary-nav flex">
                                    <div class="nav-col">
                                        <?php if (is_active_sidebar('footer-2')) : ?>
                                            <?php dynamic_sidebar('footer-2'); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="nav-col">
                                        <?php if (is_active_sidebar('footer-3')) : ?>
                                            <?php dynamic_sidebar('footer-3'); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="nav-col">
                                        <?php if (is_active_sidebar('footer-4')) : ?>
                                            <?php dynamic_sidebar('footer-4'); ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-bottom flex justify-space-between">
                        <div class="social-links-wrap flex">
                            <span class="title">Follow:</span>
                            <div class="social-links flex">
                                <?php if($twitter_link): ?>
                                    <a href="<?= $twitter_link ?>" aria-label="twitter link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>
                                <?php endif; ?>
                                <?php if($fb_link): ?>
                                    <a href="<?= $fb_link ?>" aria-label="facebook link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>
                                <?php endif; ?>
                                <?php if($instagram_link): ?>
                                    <a href="<?= $instagram_link ?>" aria-label="instagram link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg></a>
                                <?php endif; ?>
                                <?php if($git_link): ?>
                                    <a href="<?= $git_link ?>" aria-label="github link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="copyright">&copy; <?php echo date('Y'); ?>. All rights reserved by <a href="<?php echo esc_url(home_url()); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo('name'); ?></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <div class="search-popup js-search-popup">
            <div class="search-popup-bg"></div>
        	<a href="#" class="close-button" id="search-close" aria-label="Close search">
        		<svg><use xlink:href="#i-close"/></svg>
        	</a>
        	<div class="popup-inner">
                <div class="inner-container">
                    <?= get_search_form(); ?>
                    <div class="search-close-note">Press ESC to close.</div>
                    <div class="search-result" id="search-results"></div>
                    <div class="suggested-tags tag-wrap" id="suggested-tags">
                        <h2 class="h6">See posts by Popular tags</h2>
                        <div class="tag-list">
                            <?php theme_all_category_meta(); ?>
                        </div>
                    </div>
                </div>
        	</div>
        </div>

        <div id="copied-success" class="copied">
            <span>The link has been Copied to clipboard!</span>
        </div>

        <!-- Start Back To Top  -->
        <a id="backto-top" class=""><i class="fa-solid fa-chevron-up"></i></a>
        <!-- End Back To Top  -->
        
        <?php wp_footer(); ?>
        <script>
            if(typeof(Storage) !== 'undefined') 
            {
                let themeMode = document.documentElement.getAttribute('data-theme');
                if (themeMode !== null && themeMode === 'system') {
                    setSysPrefColor();
                }
                const theme = localStorage.getItem('selected-theme');
                if (theme == 'light') {
                    setColorScheme('light');
                }
                else if (theme == 'dark') {
                    setColorScheme('dark');
                }
            }
            function setSysPrefColor() {
                if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
                    setColorScheme('dark');
                }
                window.matchMedia('(prefers-color-scheme: dark)').addListener(e => {
                    if (e.matches) {
                        setColorScheme('dark');
                    } else {
                        setColorScheme('light');
                    }
                });
            }
            function setColorScheme(scheme) {
                if (scheme=='dark') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
            }
        </script>
        <script>
            document.documentElement.classList.add('js');
            window.onload = function() {
                setTimeout(function() {
                    document.body.classList.add('loaded');
                }, 5000);
            }
        </script>
	</body>
</html>