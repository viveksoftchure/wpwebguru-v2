<?php
/**
 * Template Name: User Account Template
 * Template Post Type: post, page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();
?>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo do_shortcode('[wpwg_account]');
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();