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

    //Copy to clipboard
    var loginBox = function() {
        $('.site-login').on('click', function(event) {
            event.preventDefault();

            $('.login-container').toggleClass('hidden');
        });
    }

    //Copy to clipboard
    var loginSlide = function() {

        $('#signUp').on('click', function(event) {
            $('.account-box').addClass('right-panel-active');
        });
        $('#signIn').on('click', function(event) {
            $('.account-box').removeClass('right-panel-active');
        });
        $('.close-form').on('click', function(event) {
            $('.login-container').toggleClass('hidden');
        });

    }

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
        loginBox();
        loginSlide();
    });

})(jQuery);





jQuery(document).ready(function()
{
    var ppp = ajax_options.js_option.load_more!='' ? parseInt(ajax_options.js_option.load_more) : parseInt(3); // Post per page
    var offset = ajax_options.js_option.posts_per_page!='' ? parseInt(ajax_options.js_option.posts_per_page) : parseInt(3); // offset
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
            url: ajax_options.ajax_url,
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

    jQuery('form#login').on('submit', function(e){
        e.preventDefault();
        var form = jQuery(this);
        var error;
        var username = form.find("#user_login");
        var password = form.find("#user_password");
        var security = form.find("#login_security");

        form.find(".login_msg").removeClass('error').addClass('notice').show().text(ajax_options.loadingmessage)
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_options.ajax_url,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': username.val(), 
                'password': password.val(), 
                'login_security': security.val() 
            },
            success: function(data) {
                if (data.loggedin == true){
                    form.find(".login_msg").html(data.message).removeClass('error').addClass('success').show();
                    window.location.reload();
                } else {
                    if(data.invalid_username == true){
                        showerror( username );
                    } else{
                        hideerror(username);
                    }
                    if(data.incorrect_password == true){
                        showerror( password );
                    } else{
                        hideerror(password);
                    }
                    form.find(".login_msg").text(data.message).removeClass('success').addClass('error').show();
                }
            },
            error: function (jqXHR, exception) {
                
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else if (jqXHR.responseText === '-1') {
                    msg = 'Please refresh page and try again.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                form.find(".login_loader").hide();
                form.find(".login_msg.fail").hide();
                form.find(".login_msg.fail").html(msg).show();
            },
        });
    });


    /*
    * AJAX registration
    */
    jQuery('form#register').on('submit', function(e){
        e.preventDefault();
        var form        = jQuery(this);
        var username    = form.find("#username");
        var email       = form.find("#email");
        var password    = form.find("#password");
        var register_security = form.find("#register_security");

        form.find(".register_msg").removeClass('error').addClass('notice').show().text(ajax_options.loadingmessage);
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_options.ajax_url,
            data: { 
                'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
                'username': username.val(), 
                'email': email.val(), 
                'password': password.val(), 
                'register_security': register_security.val(),
            },
            success: function(data) {
                if ( data.registered == true ) {
                    form.find(".register_msg").text(data.message).removeClass('error').addClass('success').show();
                    window.location.reload();
                } else {
                    form.find(".register_msg").text(data.message).removeClass('success').addClass('error').show();
                }
            },
            error: function (jqXHR, exception) {
                
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status === 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status === 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else if (jqXHR.responseText === '-1') {
                    msg = 'Please refresh page and try again.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                form.find(".register_msg").text(msg).removeClass('success').addClass('error').show();
            },
        });
    });

    jQuery('.bookmark-btn').on('click', function(e) {
        e.preventDefault();
        var el      = jQuery(this)
        var id      = el.data("post");
        var action  = el.attr("data-action");
        var item    = el.attr("data-item") ? el.attr("data-item") : '';
        var icon    = el.find("i");

        if (item=='') {
            icon.removeClass('fa-heart').addClass('fa-spinner fa-spin');
        }

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_options.ajax_url,
            data: { 
                'action': action,
                'id': id, 
                'security': ajax_options.get_favorites,
            },
            success: function(data) {

                if (item!='') {
                    el.closest('tr').remove();
                } else {
                    if (action=='addbookmark') {
                        el.addClass('bookmarked');
                        el.attr('data-action', 'deletebookmark');
                        el.attr('data-bookmark-active', data.active);
                        el.attr('title', data.title);
                        // icon.removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        el.removeClass('bookmarked');
                        el.attr('data-action', 'addbookmark');
                        el.attr('data-bookmark-active', data.active);
                        el.attr('title', data.title);
                        // icon.removeClass('fa-solid').addClass('fa-regular');
                    }
                }
            },
            complete:function(){
                icon.removeClass('fa-spinner fa-spin').addClass('fa-heart');
            },
            error: function (jqXHR, exception) {

            },
        });
    });

    // $('body').on('click','.pf-favorites-link',function(){
    //     $.maindivfav = $(this);

    //     $.maindivfav.children('i').switchClass('fa-heart','fa-spinner fa-spin');

    //     setTimeout(function(){
    //         $.ajax({
    //             type: 'POST',
    //             dataType: 'json',
    //             url: ajax_options.ajaxurl,
    //             data: {
    //                 'action': 'pfget_favorites',
    //                 'item': $.maindivfav.attr('data-pf-num'),
    //                 'active':$.maindivfav.attr('data-pf-active'),
    //                 'security': ajax_options.pfget_favorites
    //             },
    //             success:function(data){
    //                 var obj = [];
    //                 $.each(data, function(index, element) {
    //                     obj[index] = element;
    //                 });

    //                 if (!$.isEmptyObject(obj)) {

    //                     if (obj.user == 0) {
    //                         $.pfOpenLogin('open','login');
    //                     }else{
    //                         if (obj.active == 'true') {
    //                             var datatextfv = 'true';
    //                         }else{
    //                             var datatextfv = 'false';
    //                         };
    //                         $.maindivfav.attr('data-pf-active',datatextfv);
    //                         $.maindivfav.attr('title',obj.favtext);
                            
    //                         if ($.maindivfav.data('pf-item') == true) {
    //                             $.maindivfav.children('#itempage-pffav-text').html(obj.favtext);
    //                         };
    //                     };
    //                 };

    //             },
    //             complete:function(){
    //                 $.maindivfav.children('i').removeClass('fa-spinner fa-spin').addClass('fa-heart');
    //             }
    //         });
    //     },1000);
    // });
}); 
function validateEmail(value){
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(value) == false) {
        return false;
    }
    return true;
}
function showerror(element) {
    element.css("border-color","red");
}
function hideerror(element) {
    element.css("border-color","");
}
