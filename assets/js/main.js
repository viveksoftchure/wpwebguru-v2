(function($) 
{
    'use strict';

    // Page loading
    $(window).on('load', function() 
    {
        $('.preloader').delay(450).fadeOut('slow');
    });

    // toggle dark/light
    var toggleLight = function() 
    {
        var n = document.querySelectorAll(".js-toggle-dark-light"),
            l = document.documentElement;
        n.forEach(function (t) 
        {
            t.addEventListener("click", function (e) 
            {
                e.preventDefault();
                var t = l.getAttribute("data-theme");
                null !== t && "dark" === t ? (l.setAttribute("data-theme", "light"), localStorage.setItem("selected-theme", "light")) : (l.setAttribute("data-theme", "dark"), localStorage.setItem("selected-theme", "dark"));
            });
        });
    };

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
        $(document).keydown(function(e){
            if(e.keyCode == 27) {
                if ($('.search-popup').hasClass('visible')) {
                    $('.search-popup').removeClass('visible');
                } else {
                    $('.search-popup').addClass('visible');
                }
            }
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
    var megaMenu = function() 
    {
        $('.sub-mega-menu .nav-pills > a').on('mouseover', function(event) 
        {
            $(this).tab('show');
        });
    };

    //Copy to clipboard
    var coptToClipboard = function() {
        $('.js-copy-link').on('click', function(event) {
            var copyText = $(this).data("clipboard-text");
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copyText).select();
            document.execCommand("copy");
            $temp.remove();

            $(this).find('.tooltip').text('Copied');
            setTimeout(function() {
                $(this).find('.tooltip').text('Copy');
            },500);
        });
    }

    // Back to top
    var scrollToTop = function() {
        $(window).scroll(function() {
            var height = $(window).scrollTop();

            if (height > 400) {
                $('#backto-top').fadeIn('slow');
            } else {
                $('#backto-top').fadeOut('slow');
            }
        });

        $("#backto-top").on('click', function(event) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    }

    $("body").bind("cut copy paste", function (e) {
        // e.preventDefault();
    });
   
    $("body").on("contextmenu",function(e){
        //return false;
    });

	/*
	* add prettyprint on pre
	*/
	jQuery(".prettyprint").each(function(){
		jQuery(this).html( PR.prettyPrintOne(jQuery(this).html()) );
	});

   
    // $(".social-link").on("click", function(e) {
    //     var url = $(this).data('link');
    //     var target = $(this).data('target');

    //     window.open(url, target);
    // });

    //Load functions
    $(document).ready(function() 
    {
        toggleLight();
        openSearchForm();
        OffCanvas();
        headerSticky();
        megaMenu();
        WidgetSubMenu();
        scrollProgress();
        coptToClipboard();
        scrollToTop();
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

    function load_posts(button, newOffset, postBox, category, author)
    {
        pageNumber++;
        // console.log(offset);
        var str = '&author='+author+'&category='+category+'&offset='+newOffset+'&pageNumber='+pageNumber+'&ppp='+ppp+'&action=more_post_ajax';
        
        button.addClass('loading');
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
                    jQuery('#more_posts').hide();
                }
                button.removeClass('loading');
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

    jQuery("#more_posts").on("click",function() { 
        var newOffset = offset;
        var postBox = jQuery(this).data('post-box');
        var category = jQuery(this).data('category');
        var author = jQuery(this).data('author');
        
        load_posts(jQuery(this), newOffset, postBox, category, author);
        newOffset = offset+ppp;
    });
});