(function($) 
{
    'use strict';

    // Page loading
    $(window).on('load', function() {
        $('.preloader').delay(450).fadeOut('slow');
    });

    // Scroll progress
    var scrollProgress = function() {
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
    var openSearchForm = function() {
        $('button.search-icon').on('click', function() {
            $('body').toggleClass("open-search-form");
            $('.mega-menu-item').removeClass("open");
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('.search-close').on('click', function() {
            $('body').removeClass("open-search-form");
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
    $(document).ready(function() {
        openSearchForm();
        OffCanvas();
        headerSticky();
        megaMenu();
        WidgetSubMenu();
        scrollProgress();
        moreArticles();
    });

})(jQuery);