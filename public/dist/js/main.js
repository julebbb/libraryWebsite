let paragraph = $("#loadingP");
let line = $('.line');
let divLoad = $("#divLoad");

//Loading page animation
jQuery(document).ready(function ($) {
    line.css('height', '100vh');
    line.css('border-radius', '0');

    paragraph.css("opacity", 0);

    if (paragraph.css("opacity", 0)) {

        setTimeout(function () {
            paragraph.text('Ready !');
            paragraph.css("opacity", 1);
        }, 200);
    }

    if (line.css('height', '100vh')) {
        setTimeout(function () {
            line.css('width', '100vw');
            paragraph.css('background', 'transparent')
            divLoad.css('opacity', 0);
            if (divLoad.css('opacity', 0)) {
                setTimeout(function () {
                    divLoad.remove();

                }, 1000);
            }

        }, 1000);

    }

    $('.logoLink').hover(function () {
        $('.logoBook1').css("animation", "2s linear infinite boing1");
        $('.logoBook2').css("animation", "2s linear infinite boing1");
        $('.logoBook3').css("animation", "2s linear infinite boing2");
        $('.logoBookOpen').css("animation", "3s infinite ease bookopen alternate")
    });
    $('.logoLink').mouseout(function () {
        $('.logoBook1').css("animation", "");
        $('.logoBook2').css("animation", "");
        $('.logoBook3').css("animation", "");
        $('.logoBookOpen').css("animation", "")

    });
    
});
