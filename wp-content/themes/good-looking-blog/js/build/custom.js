jQuery(document).ready(function ($) {
    //search modal
    $('.header-search > button').on('click', function () {
        $('.header-search-form').fadeIn();
        $('.search-field').focus();
    });
    $('.header-search .close').on('click', function () {
        $('.header-search-form').fadeOut();
    });

    $('.search-form').on('click', function (e) {
        e.stopPropagation();
    });

    $('.header-search-form').on('click', function () {
        $('.header-search-form').fadeOut();
    });

    //mobile-menu
    $('<button class="angle-down"> </button>').insertAfter( $(".main-navigation.mobile-navigation ul .menu-item-has-children > a"));
    $('.main-navigation.mobile-navigation ul li .angle-down').on('click', function () {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    var adminBar = document.querySelector('#wpadminbar');
    if (adminBar !== null) {
        var adminHeight = adminBar.offsetHeight;
        var mobHeaderTop = document.querySelector('.header-bottom-slide-inner');
        // mobHeaderTop.style.top = adminHeight + 'px';
    }

    //mobileheaderwhenadminbarpresent
    function styleOne() {
        if (document.querySelector('.site-header.style-one') !== null) {
            var StyleOne = document.querySelector('.site-header.style-one');
            StyleOne.style.top = adminHeight + 'px';
        }
    }
    
    window.addEventListener('resize', function () {
        styleOne();
    });

    window.addEventListener('load', function () {
        styleOne();
    });

    //accessibility
    $('.menu li a, .menu li').on('focus', function() {
        $(this).parents('li').addClass('focus');
    }).blur(function() {
        $(this).parents('li').removeClass('focus');
    });

    $("#menu-opener").on('click', function () {
        $("body").addClass("menu-open");
        $(".mobile-menu-wrapper .primary-menu-list").addClass("toggled");
    });
  
    $(".mobile-menu-wrapper .close-main-nav-toggle ").on('click', function () {
    $("body").removeClass("menu-open");
    $(".mobile-menu-wrapper .primary-menu-list").removeClass("toggled");
    });

});