/*-------------------------<><><> START MAIN SCRIPT <><><>-------------------------*/

/*
--------------------------
Template Name:   MESH MAG - Magazine HTML Responsive Template.
Version:         1.3
Date:            20 November 2017
Primary use:     Site Template ( HTML5, CSS3, jQuery ) - Magazine.
Author:          Ahmed_Saleh.
--------------------------
*/

/*
[ Start Table of Contents ]
--------------------------
- 1#GENERAL SCRIPTS
    - THEIA STICKY SIDEBAR
    - FORM INPUT ERROR
    - TOP BAR - SEARCH BAR
    - TOP BAR - ACCOUNTS > HOME PREVIEW 1
    - POST SHARE
    - INTRO SLIDER
    - INTRO SLIDER > HOME PREVIEW 1
    - SECTION5 - CARO SLIDER
    - SECTION6 - TABS
    - SECTION8 - FAD SLIDER
    - NEWS SECTION
    - POPULAR SECTION
    - ARCHIVE SECTION
    - TICKER
    - SCROLL TO TOP

- 2#PAGES SCRIPTS 
    - SITEMAP PAGE - ACCORDION
    - LOGIN & REGISTER PAGES - CHECKBUTTON
    - POST RELATED ( LEFT, RIGHT, FULL ) PAGES
    - POST OPTION
    - POST COMMENTS ( LEFT, RIGHT, FULL, VIDEOS ) PAGES
    
- 3#RESPONSIVE SCRIPTS
    - RESPONSIVE NAV BAR
    - RESPONSIVE NAV MENU
-------------------------
[ End Table of Contents ]
*/

/*global $, window, setInterval, clearInterval, setTimeout*/

$(function () {
    
    /* Start of use strict */
    "use strict";
    
    //* Variables *//
        /* Main Variable */
    var bdy = $("body > div"),
        jsPlugs = ("js_plugins"),
        jsPlugs_caro = ("js_plugins_caro"),
        /* Post Share */
        pstshr_butt = $(".post-share-butt i"),
        mv_lf = ("mov-left"),
        /* Post Option */
        txt_siz_clicked = false;
    
/*---------------/// START 1#GENERAL SCRIPTS ///---------------*/
    
    //---------- START THEIA STICKY SIDEBAR ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger Sticky Sidebar with Theia Plugin */
        $('.main-content, .sidebar-content').theiaStickySidebar({
            // Plugin Settings
            additionalMarginTop: 40
        });
        
    }
    //---------- END THEIA STICKY SIDEBAR ----------//
    
    
    
    //---------- START FORM INPUT ERROR ----------//
    $('input[type="submit"]').on('click', function (e) {
        
        e.preventDefault();
        
        var inputEmail = $('input[type="email"]'),
            errorClass = ('error-input');
        
        $(this).parents('form').find(inputEmail).toggleClass(errorClass);
        
        if ($(inputEmail).hasClass(errorClass)) {
            
            $(inputEmail).val($(inputEmail).val() + ' < Error Message Here!');
            
        } else {
            
            $(inputEmail).val(' ');
            
        }
        
    });
    //---------- END FORM INPUT ERROR ----------//
    
    
    
    //---------- START TOP BAR - SEARCH BAR ----------//
    /* show and hide search input when click and move social bar */
    $(".search-bar i").on("click", function (e) {
        
        e.preventDefault();
        
        var shw_inpt = ("shw_inpt"),
            shw_inpt_2 = ("shw_inpt_2");
        /* 
            if search icon has class "shw_inpt" .. show search input and move social bar to left,
            if not .. hide search input and move social bar to right.
        */
        if ($(this).hasClass(shw_inpt)) {
           
            $(this).next().animate({width: "0", padding: "0"}, 400).parents('.top-bar').find('.social-bar').css("margin-left", "0");
        
            /* Home Preview 1 */
        } else if ($(this).hasClass(shw_inpt_2)) {
            
            $(this).next().animate({width: "190px", padding: "0 20px"}, 400).parents('.top-bar').find('.social-bar').css("margin-left", "-13.5%");
            
        } else {
            
            $(this).next().animate({width: "190px", padding: "0 20px"}, 400).parents('.top-bar').find('.social-bar').css("margin-left", "-18%");
        }
        
        /* toggle class "shw_inpt" */
        $(this).toggleClass(shw_inpt);
        
        return false;
        
    });
    //---------- END TOP BAR - SEARCH BAR ----------//
    
    
    
    //---------- START TOP BAR - ACCOUNTS > HOME PREVIEW 1 ----------//
    $('.accounts-wrap').on('click', function () {
        
        $('.accounts').fadeToggle('fast');
        
    });
    //---------- END TOP BAR - ACCOUNTS > HOME PREVIEW 1 ----------//
    
    
    
    //---------- START POST SHARE ----------//
    /* show and hide social icons when click on post share button */
    pstshr_butt.on("click", function () {
        
        $(this).toggleClass(mv_lf).parent().next().fadeToggle(350).parents(".post-img")
            .on("mouseleave", function () {
            
                pstshr_butt.removeClass(mv_lf).parent().next().fadeOut();
            
            });
        
    });
    //---------- END POST SHARE ----------//
    
    
    
    //---------- START INTRO SLIDER ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger intro slider with bxSlider */
        $(".intr-slid").bxSlider({
            mode: "vertical",
            slideMargin: 5,
            pager: false,
            auto: true,
            autoHover: true,
            pause: 6000
        });
        
    }
    //---------- END INTRO SLIDER ----------//
    
    
    
    //---------- START INTRO SLIDER > HOME PREVIEW 1 ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger intro slider with bxSlider */
        $(".intr-slid-preview_1").bxSlider({
            mode: "horizontal",
            slideMargin: 5,
            pager: false,
            auto: true,
            autoHover: true,
            pause: 4000,
            speed: 800
        });
        
    }
    //---------- END INTRO SLIDER > HOME PREVIEW 1 ----------//
    
    
    
    //---------- START SECTION5 - CARO SLIDER ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger caro slider with owlCarousel */
        $("#caro-slider").owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 20,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                544: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
        
    }
    //---------- END SECTION5 - CARO SLIDER ----------//
    
    
    
    //---------- START SECTION6 - TABS ----------//
    /* add class active to first (a) */
    $(".section6 .tab-bar a:first").addClass("active");
    /* hide menu that not the first */
    $(".section6 .tab-content .menu:not(:first)").hide();
    
    /* add class active to (a) when click and show the related menu */
    $(".section6 .tab-bar a").on("click", function () {
        
        var tab_attr = $(this).attr("href");
        
        $(this).addClass("active").parent().siblings().find("a").removeClass("active");
        
        $(tab_attr).fadeIn(500).siblings().hide();
        
        return false;
        
    });
    //---------- END SECTION6 - TABS ----------//
    
    
    
    //---------- START SECTION8 - FAD SLIDER ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger fad slider slider with owlCarousel */
        $("#fad-slider").owlCarousel({
            items: 1,
            animateOut: "fadeOut",
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 15,
            nav: true,
            navText: [""],
            dots: false,
            smartSpeed: 700
        });
        
        /* show slider caption when click on caption open and hide when click on caption close */
        $(".section8 .opti").on("click", function () {
            
            var capt = $(".section8 .caption"),
                captOpn = $(".caption-open"),
                captClos = $(".caption-close");
            
            if ($(this).hasClass("caption-open")) {
                
                capt.animate({"bottom": "0"}, 250, function () {
                    
                    captOpn.fadeOut("fast");
                    captClos.show().parent().prev().css("top", "-180px");
                    
                });
                
            } else {
                
                capt.animate({"bottom": "-100%"}, 250, function () {
                    
                    captOpn.fadeIn();
                    captClos.hide().parent().prev().css("top", "0");
                    
                });
                
            }
            
        });
        
    }
    //---------- END SECTION8 - FAD SLIDER ----------//
    
    
    
    //---------- START NEWS SECTION ----------//
    function vertSlider() {
        
        var vertsliderbar = $(".vert-slider-bar"),
            vertslidercontents = $(".vert-slider-contents"),
            content_height = vertslidercontents.height(),
            current_index = 0,
            interval;
        
        /* add class active to first li */
        vertsliderbar.find("li").first().addClass("active");
        
        function Clickslide() {
            
            /* get the index of the clicked link */
            var index = $(".vert-slider-bar li div").index(this);
            
            /* set the current_index variable to keep track of the current index */
            current_index = index;
            
            /* animate slider to top */
            vertslidercontents.children().stop().animate({
                top : (content_height * index * -1)
            }, 1000);
            
            vertsliderbar.find("li").eq(current_index).addClass("active")
                .siblings().removeClass("active");
        }
        
        function autoSlide() {
            
            current_index += 1;
            /* loop to beginning if necessary */
            if (current_index >= vertslidercontents.children().children().children().length) {
                current_index = 0;
            }
            
            vertsliderbar.find("li div").eq(current_index).trigger("click");
        }
        
        vertsliderbar.find("li div").on("click", Clickslide);
        
        /* stop slider when mouseenter and resume when mouseleave */
        interval = setInterval(autoSlide, 5000);
        
        $(".vert-slider").on("mouseenter", function () {
            
            clearInterval(interval);
            
        }).on("mouseleave", function () {
            
            interval = setInterval(autoSlide, 5000);
            
        });
        
    }
    vertSlider();
    //---------- END NEWS SECTION ----------//
    
    
    
    //---------- START POPULAR SECTION ----------//
    if (bdy.hasClass(jsPlugs)) {
        
        /* trigger popular slider with owlCarousel */
        $("#popular-section").owlCarousel({
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 20,
            nav: false,
            smartSpeed: 700
        });
        
    }
    //---------- END POPULAR SECTION ----------//
    
    
    
    //---------- START ARCHIVE SECTION ----------//
    function accordion() {
        
        var acc_info = $(".archive-section .accord-info");
        
        /* click on accord info and toggle classes and check others accord info */
        acc_info.on("click", function () {
            
            $(this).toggleClass("not-opn opn").next().slideToggle()
                .parents(".accord-wrap").find(acc_info).not(this)
                .removeClass("opn").addClass("not-opn");
            
            /* slide up others accord content */
            $(".accord-content").not($(this).next()).slideUp();
            /* add class opn to first accord info and add class not opn to others accord info */
        }).addClass("not-opn").first().removeClass("not-opn").addClass("opn");
        
        /* click on post date and toggle classes */
        $(".archive-section .post-date").on("click", function () {
            
            $(this).toggleClass("not-opn opn").next().slideToggle();
            /* add class opn to first post date and add class not opn to others post date */
        }).addClass("not-opn").first().removeClass("not-opn").addClass("opn");
        
    }
    accordion();
    //---------- END ARCHIVE SECTION ----------//
    
    
    
    //---------- START TICKER ----------//
    function ticker() {
        
        var ul = $(".ticker ul"),
            Sum = 0,
            tickerwidth = $(".ticker").width(),
            left = 0,
            interval;
        
        /* get ul width dynamically */
        ul.each(function () {
            
            if (ul.children("li").length >= 1) {
                
                $(this).children("li").each(function (i, e) {
                    Sum += $(e).outerWidth(true);
                });
                
                $(this).width(Sum + 1);
                
            }
            
            /* start ticker loop */
            function startTicker() {
                
                left -= 1;
                
                if (left < -ul.width()) {
                    left = tickerwidth;
                }
                
                ul.css("left", left + "px");
                
            }
            
            /* stop ticker when mouseenter and resume when mouseleave */
            interval = setInterval(startTicker, 12);
            
            ul.on("mouseenter", function () {
                
                clearInterval(interval);
                
            }).on("mouseleave", function () {
                
                interval = setInterval(startTicker, 12);
                
            });
            
        });
        
    }
    ticker();
    //---------- END TICKER ----------//
    
    
    
    //---------- START SCROLL TO TOP ----------//
    /* animate body to top when click */
    $(".scroll-top").on("click", function () {
        
        $("html, body").animate({scrollTop: 0}, 1500);
        
    });
    //---------- END SCROLL TO TOP ----------//
    
/*---------------/// END 1#GENERAL SCRIPTS ///---------------*/

/*
/
/
/
/
/
*/

/*---------------/// START 2#PAGES SCRIPTS ///---------------*/
    
    //---------- START SITEMAP PAGE - ACCORDION ----------//
    /* add class not opn to accord title and add class opn to the first and show next */
    $(".sitemap .accord .title").on("click", function () {
        
        $(this).toggleClass("not-opn opn").next().slideToggle(500);
        
    }).first().addClass("opn").parent().siblings().find(".title").addClass("not-opn");
    //---------- END SITEMAP PAGE - ACCORDION ----------//
    
    
    
    //---------- START LOGIN & REGISTER PAGE - CHECKBUTTON ----------//
    $('.account .checkbox input').on('click', function () {
        
        $(this).toggleClass('check-ico');
        
    });
    
    $('.forgot-pass').on('click', function (e) {
        
        e.preventDefault();
        
        var forgt = $('.forgot');
        
        forgt.show().find('.form-close').on('click', function () {
            
            forgt.hide();
            
        });
        
    });
    //---------- END LOGIN & REGISTER PAGE - CHECKBUTTON ----------//
    
    
    
    //---------- START POST RELATED ( LEFT, RIGHT ) SIDEBAR PAGES ----------//
    if (bdy.hasClass(jsPlugs_caro)) {
        
        /* trigger caro slider with owlCarousel */
        $("[class*='-sidebar'] #caro-slider").owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 20,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
        
    }
    //---------- END POST RELATED ( LEFT, RIGHT ) SIDEBAR PAGES ----------//
    
    
    
    //---------- START POST OPTION ( LEFT, RIGHT, FULL, VIDEOS ) PAGES ----------//
    /* Post Text Size */
    $('.post-option .txt-siz span').on('click', function () {
       
        var post = $('.post-body > p');
        
        if (!txt_siz_clicked && $(this).hasClass('incr-font')) {
            
            txt_siz_clicked = true;
            
            $(post).animate({fontSize: '+=1px'});
            
            setTimeout(function () {
                
                txt_siz_clicked = false;
                
            }, 1000);
            
            if ($(post).css('font-size') === '24px') {
                
                $(post).animate().stop();
                
            }
            
        } else if (!txt_siz_clicked && $(this).hasClass('decr-font')) {
            
            txt_siz_clicked = true;
            
            $(post).animate({fontSize: '-=1px'});
            
            setTimeout(function () {
                
                txt_siz_clicked = false;
                
            }, 1000);
            
            if ($(post).css('font-size') === '17px') {
                
                $(post).animate().stop();
                
            }
            
        }
        
    });
    
    /* Post Print */
    $('.post-option .prnt span').on('click', function () {
        
        window.print();
        
        return false;
        
    });
    
    /* Post Send to Email */
    $('#sendToMail').on('click', function () {
       
        var article_url = window.location.href,
            article_headline = $('.post-head > .post-title').text();
        
        // Be careful with SPACES in concatenation
        $(this).attr('href', 'mailto:?&subject=MESH MAG New Article&body=' +
            'Hi my friend,,, You can read a new article ' + '"' + article_headline + '"' +
            ' at this link ' + article_url);
        
    });
    //---------- END POST OPTION ( LEFT, RIGHT, FULL, VIDEOS ) PAGES ----------//
    
    
    
    //---------- START POST RELATED FULL WIDTH PAGE ----------//
    if (bdy.hasClass(jsPlugs_caro)) {
        
        /* trigger caro slider with owlCarousel */
        $(".post-fullwidth #caro-slider").owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 20,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
        
    }
    //---------- END POST RELATED FULL WIDTH PAGE ----------//
    
    
    
    //---------- START POST COMMENTS ( LEFT, RIGHT, FULL, VIDEOS ) PAGES ----------//
    /* add class active to site tab */
    $(".comments .bar li a[href='#site']").addClass("active");
    /* hide comm that not the first */
    $(".comments .comm:not(#site)").hide();
    
    /* add class active to (a) when click and show the related comm */
    $(".comments .bar li a").on("click", function () {
        
        var comm_attr = $(this).attr("href");
        
        $(this).addClass("active").parent().siblings().find("a").removeClass("active");
        
        $(comm_attr).fadeIn(500).siblings().hide();
        
        return false;
        
    });
    //---------- END POST COMMENTS ( LEFT, RIGHT, FULL, VIDEOS ) PAGES ----------//
    
/*---------------/// END 2#PAGES SCRIPTS ///---------------*/

/*
/
/
/
/
/
*/

/*---------------/// START 3#RESPONSIVE SCRIPTS ///---------------*/
    
    //---------- START RESPONSIVE NAV BAR ----------//
    /* show and hide nav bar when click button */
    $(".nav-respon-butt").on("click", function () {
        
        $(this).next(".nav-bar").fadeToggle();
        
    });
    //---------- END RESPONSIVE NAV BAR ----------//
    
    
    
    //---------- START RESPONSIVE NAV MENU ----------//
    /* show and hide nav menu and menu arrow when click button */
    $(".menu-respon-butt").on("click", function () {
        
        $(this).toggleClass("shw_arw").next(".menu").fadeToggle();
        
    });
    //---------- END RESPONSIVE NAV MENU ----------//
    
/*---------------/// END 3#RESPONSIVE SCRIPTS ///---------------*/
    
});

/*-------------------------<><><> END MAIN SCRIPT <><><>-------------------------*/