jQuery(document).ready(function ($) {
    var slider_auto, slider_loop, rtl;

    if (best_recipe_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (best_recipe_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (best_recipe_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }

    $('.site-banner .owl-carousel').owlCarousel({
        loop: slider_loop,
        center: true,
        autoplay: slider_auto,
        autoplayTimeout: 5000,
        items: 1,
        nav: true,
        dots: false,
        margin: 30,
        rtl: rtl,
        responsive: {
            600: {
                items: 1.285,
                margin: 20,
            },

            767: {
                items: 1.1,
                margin: 10,
            },

            1024: {
                items: 1.285,
                margin: 30,
                nav: true,
            },
        }
    });
});