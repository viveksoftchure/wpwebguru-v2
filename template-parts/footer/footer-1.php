<div class="blog-footr-sbscrb-wgt">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h2>Give Your Business <br class="visible-lg"> the <b>Cloudways</b> Edge</h2>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="blog-footr-sbscrb-form-wrap">
                    <form action="">
                        <input type="hidden" name="cat" id="subscribe_nl_type" value="default">
                        <input type="email" name="email" id="subscribe_email" placeholder="Enter Your Email Address">
                        <input type="button" value="Subscribe Now" id="subscribe_go" class="btn blog-footr-sbscrb-sbmt-btn">
                        <label for="checkbox_consent" class="blog-footr-sbscrb-chkbox">
                            <input type="checkbox" required="" name="checkbox_consent" class="" id="checkbox_consent">
                            <span class="checkmark"></span>I agree to the Cloudways
                            <a href="#">Terms of Service</a> &amp;
                            <a href="#">Privacy Policy</a>
                        </label>
                    </form>
                    <div id="subscribe_error-messages"></div>
                    <div id="subscribe_success-messages"></div>
                    <div id="consent_error-messages"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
    <!-- Start Footer Top Area -->
    <div class="container">
        <div class="footer-top">
            <div class="footer-nav-wrap">
                <!-- BEGIN Product links navigation -->
                <div class="footer-nav">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php endif; ?>
                </div>
                <!-- END Product links navigation -->
                <!-- BEGIN support content -->
                <div class="footer-nav">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php endif; ?>
                </div>
                <!-- END support navigation -->
                <!-- BEGIN Company navigation -->
                <div class="footer-nav">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <?php dynamic_sidebar('footer-4'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-brand-Info">
                <div class="footer-nav">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top Area -->
    <!-- Start Copyright Area  -->
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-right text-center">
                &copy; <?php echo date('Y'); ?>. All rights reserved by <a href="<?php echo esc_url(home_url()); ?>" target="_blank" rel="noopener"><?php echo get_bloginfo('name'); ?></a>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</div>