<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogar
 */

get_header();
// Get Value
$default = array(
    'section-1',
    'section-2',
    'section-3',
    'section-4',
    'section-5',
    'section-6',
);
?>
<!-- Start Blog Area  -->

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $sections = get_theme_mod('theme_sort_homepage', $default);
                if ( !empty($sections) && is_array( $sections ) ) 
                {
                    foreach ( $sections as $section ) 
                    {
                        get_template_part('template-parts/home-sections/' . $section, $section);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area  -->
<?php
get_footer();