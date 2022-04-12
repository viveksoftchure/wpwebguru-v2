<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WpWebGuru
 */

// Add a pingback url auto-discovery header for single posts, pages, or attachments
function theme_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action('wp_head', 'theme_pingback_header');


/**
* get content estimated reading time
*/
if (!function_exists('theme_content_estimated_reading_time')) 
{
    /**
     * Function that estimates reading time for a given $content.
     * @param string $content Content to calculate read time for.
     * @paramint $wpm Estimated words per minute of reader.
     * @returns int $time Esimated reading time.
     */
    function theme_content_estimated_reading_time($content = '', $wpm = 200)
    {
        $clean_content = strip_shortcodes($content);
        $clean_content = strip_tags($clean_content);
        $word_count = str_word_count($clean_content);
        $time = ceil($word_count / $wpm);
        $output = $time . esc_attr__(' min read', 'wpwebguru');
        return $output;
    }
}

/**
 * Blog Pagination
 */
if(!function_exists('theme_blog_pagination'))
{
    function theme_blog_pagination()
    {
        GLOBAL $wp_query;
        if ($wp_query->post_count < $wp_query->found_posts) {
            ?>
            <div class="post-pagination"> <?php
                the_posts_pagination(array(
                    'prev_text'          => '<i class="fal fa-arrow-left"></i>',
                    'next_text'          => '<i class="fal fa-arrow-right"></i>',
                    'type'               => 'list',
                    'show_all'  	     => false,
                    'end_size'           => 1,
                    'mid_size'           => 8,
                )); ?>
            </div>
            <?php
        }
    }
}

/**
 * Short Title
 */
if (!function_exists('theme_short_title'))
{
    function theme_short_title($title, $length = 30) 
    {
        if (strlen($title) > $length) 
        {
            return substr($title, 0, $length) . ' ...';
        }
        else 
        {
            return $title;
        }
    }
}

/**
 * @param $url
 * @return string
 */
if ( !function_exists('theme_getEmbedUrl') )
{
    function theme_getEmbedUrl($url) 
    {
        // function for generating an embed link
        $finalUrl = '';

        if (strpos($url, 'facebook.com/') !== false) 
        {
            // Facebook Video
            $finalUrl.='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';

        } 
        else if(strpos($url, 'vimeo.com/') !== false) 
        {
            // Vimeo video
            $videoId = isset(explode("vimeo.com/",$url)[1]) ? explode("vimeo.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false)
            {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://player.vimeo.com/video/'.$videoId;

        } 
        else if (strpos($url, 'youtube.com/') !== false) 
        {
            // Youtube video
            $videoId = isset(explode("v=",$url)[1]) ? explode("v=",$url)[1] : null;
            if (strpos($videoId, '&') !== false)
            {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } 
        else if(strpos($url, 'youtu.be/') !== false) 
        {
            // Youtube  video
            $videoId = isset(explode("youtu.be/",$url)[1]) ? explode("youtu.be/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) 
            {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } 
        else if (strpos($url, 'dailymotion.com/') !== false) 
        {
            // Dailymotion Video
            $videoId = isset(explode("dailymotion.com/",$url)[1]) ? explode("dailymotion.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) 
            {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.dailymotion.com/embed/'.$videoId;

        } 
        else
        {
            $finalUrl.=$url;
        }

        return $finalUrl;
    }
}

/**
* Social sharing icons
*/
if ( ! function_exists('post_sharing_icon_links') ) 
{
    function post_sharing_icon_links( ) 
    {
        $html = '<ul class="social-share-transparent justify-content-end">';

        // facebook
        $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
        $html .= '<li><a href="'. esc_url( $facebook_url ) .'" target="_blank" class="aw-facebook"><i class="fab fa-facebook-f"></i></a></li>';

        // twitter
        $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
        $html .= '<li><a href="'. esc_url( $twitter_url ) .'" target="_blank" class="aw-twitter"><i class="fab fa-twitter"></i></a></li>';

        // linkedin
        $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
        $html .= '<li><a href="'. esc_url( $linkedin_url ) .'" target="_blank" class="aw-linkdin"><i class="fab fa-linkedin-in"></i></a></li>';

        $html .= '<li><button class="axilcopyLink" title="'. esc_html('Copy Link', 'blogar') .'" data-link="'. esc_url(get_permalink()) .'"><i class="fas fa-link"></i></button></li>';

        $html .= '</ul>';

        echo wp_kses_post($html);
    }
}

/**
* Comment navigation
*/
function theme_get_post_navigation()
{
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
        require(get_template_directory() . '/inc/comment-nav.php');
    endif;
}

require get_template_directory() . '/inc/comment-form.php';
