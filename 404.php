<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WpWebGuru
 */

get_header();
?>
<!-- Start Error Area  -->
<div class="error-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/others/404.png" alt="Error Images">

                    <h1 class="title">Page not Found</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim, recusandae consectetur nesciunt magnam facilis aliquid amet earum alias?</p>
                    <div class="back-totop-button cerchio d-inline-block">
                        <a class="theme-button button-rounded hover-flip-item-wrapper" href="<?php echo esc_url( home_url( '/' ) );?>">
                            <span class="hover-flip-item">
                                <span data-text="Go back">Go Back</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Error Area  -->
<?php
get_footer();