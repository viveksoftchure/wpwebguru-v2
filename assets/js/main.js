(function($) 
{
    'use strict';

    // Page loading
    $(window).on('load', function() 
    {
        $('.preloader').delay(450).fadeOut('slow');
    });
    
    var n = document.querySelectorAll(".js-toggle-dark-light"),
        l = document.documentElement;
    n.forEach(function (t) 
    {
        t.addEventListener("click", function () 
        {
            var t = l.getAttribute("data-theme");
            null !== t && "dark" === t ? (l.setAttribute("data-theme", "light"), localStorage.setItem("selected-theme", "light")) : (l.setAttribute("data-theme", "dark"), localStorage.setItem("selected-theme", "dark"));
        });
    });

    // Scroll progress
    var scrollProgress = function() 
    {
        var docHeight = $(document).height(),
            windowHeight = $(window).height(),
            scrollPercent;
        $(window).on('scroll', function() {
            scrollPercent = $(window).scrollTop() / (docHeight - windowHeight) * 100;
            $('.scroll-progress').width(scrollPercent + '%');
        });
    };

    // Off canvas sidebar
    var OffCanvas = function() {
        $('#off-canvas-toggle').on('click', function() {
            $('body').toggleClass("canvas-opened");
        });

        $('.dark-mark').on('click', function() {
            $('body').removeClass("canvas-opened");
        });
        $('.off-canvas-close').on('click', function() {
            $('body').removeClass("canvas-opened");
        });
    };

    // Search form
    var openSearchForm = function() 
    {
        $('.js-search-button').on('click', function() 
        {
            $('.search-popup').toggleClass("visible");
        });
        $('#search-close').on('click', function() 
        {
            $('.search-popup').toggleClass("visible");
        });
    };

    var SubMenu = function() {
        // $(".sub-menu").hide();
        $(".menu li.menu-item-has-children").on({
            mouseenter: function() {
                $('.sub-menu:first, .children:first', this).stop(true, true).slideDown('fast');
            },
            mouseleave: function() {
                $('.sub-menu:first, .children:first', this).stop(true, true).slideUp('fast');
            }
        });
    };

    var WidgetSubMenu = function() {
        //$(".sub-menu").hide();
        $('.menu li.menu-item-has-children').on('click', function() {
            var element = $(this);
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(200);
            } else {
                element.addClass('open');
                element.children('ul').slideDown(200);
                element.siblings('li').children('ul').slideUp(200);
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(200);
            }
        });
    };

    //Header sticky
    var headerSticky = function() {
        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();
            if (scroll < 80) {
                $(".site-header").removeClass("small");
            } else {
                $(".site-header").addClass("small");
            }
        });
    };

    //Mega menu
    var megaMenu = function() {
        $('.sub-mega-menu .nav-pills > a').on('mouseover', function(event) {
            $(this).tab('show');
        });
    };

    /* More articles*/
    var moreArticles = function() {
        $.fn.vwScroller = function(options) {
            var default_options = {
                delay: 500,
                /* Milliseconds */
                position: 0.7,
                /* Multiplier for document height */
                visibleClass: '',
                invisibleClass: '',
            }

            var isVisible = false;
            var $document = $(document);
            var $window = $(window);

            options = $.extend(default_options, options);

            var observer = $.proxy(function() {
                var isInViewPort = $document.scrollTop() > (($document.height() - $window.height()) * options.position);

                if (!isVisible && isInViewPort) {
                    onVisible();
                } else if (isVisible && !isInViewPort) {
                    onInvisible();
                }
            }, this);

            var onVisible = $.proxy(function() {
                isVisible = true;

                /* Add visible class */
                if (options.visibleClass) {
                    this.addClass(options.visibleClass);
                }

                /* Remove invisible class */
                if (options.invisibleClass) {
                    this.removeClass(options.invisibleClass);
                }

            }, this);

            var onInvisible = $.proxy(function() {
                isVisible = false;

                /* Remove visible class */
                if (options.visibleClass) {
                    this.removeClass(options.visibleClass);
                }

                /* Add invisible class */
                if (options.invisibleClass) {
                    this.addClass(options.invisibleClass);
                }
            }, this);

            /* Start observe*/
            setInterval(observer, options.delay);

            return this;
        }

        if ($.fn.vwScroller) {
            var $more_articles = $('.single-more-articles');
            $more_articles.vwScroller({ visibleClass: 'single-more-articles--visible', position: 0.55 })
            $more_articles.find('.single-more-articles-close-button').on('click', function() {
                $more_articles.hide();
            });
        }

        $('button.single-more-articles-close').on('click', function() {
            $('.single-more-articles').removeClass('single-more-articles--visible');
        });
    }

    $("body").bind("cut copy paste", function (e) {
        // e.preventDefault();
    });
   
    $("body").on("contextmenu",function(e){
        //return false;
    });

    //Load functions
    $(document).ready(function() 
    {
        openSearchForm();
        OffCanvas();
        headerSticky();
        megaMenu();
        WidgetSubMenu();
        scrollProgress();
        moreArticles();
    });

})(jQuery);





jQuery(document).ready(function()
{
    console.log(ajax_posts);
    var ppp = ajax_posts.js_option.load_more!='' ? parseInt(ajax_posts.js_option.load_more) : parseInt(3); // Post per page
    var offset = ajax_posts.js_option.posts_per_page!='' ? parseInt(ajax_posts.js_option.posts_per_page) : parseInt(3); // offset
    // var offset = parseInt(0); // Post per page

    var pageNumber = 1;

    var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
        bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

    function load_posts(newOffset, postBox, category, author)
    {
        pageNumber++;
        // console.log(offset);
        var str = '&author='+author+'&category='+category+'&offset='+newOffset+'&pageNumber='+pageNumber+'&ppp='+ppp+'&action=more_post_ajax';
        jQuery.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_posts.ajaxurl,
            data: str,
            success: function(data)
            {
                offset = offset+ppp;
                var $data = jQuery(data);
                if($data.length)
                {
                    jQuery(postBox).append($data);
                    jQuery("#more_posts").attr("disabled",false);
                } 
                else
                {
                    jQuery("#more_posts").text('No more posts');
                    jQuery("#more_posts").attr("disabled",true);
                    jQuery('.noMorePostsFound').show();
                }
            },
            beforeSend: function() 
            {
                jQuery('.dcsLoaderImg').show();
            },
            complete: function()
            {
                jQuery('.dcsLoaderImg').hide();
            },
            error : function(jqXHR, textStatus, errorThrown) 
            {
                $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }

        });
        return false;
    }

    jQuery("#more_posts").on("click",function()
    { 
        var newOffset = offset;
        var postBox = jQuery(this).data('post-box');
        var category = jQuery(this).data('category');
        var author = jQuery(this).data('author');

        jQuery("#more_posts").attr("disabled",true); // Disable the button, temp.
        load_posts(newOffset, postBox, category, author);
        newOffset = offset+ppp;
    });
});