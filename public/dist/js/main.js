let paragraph = $("#loadingP");
let line = $('.line');
let divLoad = $("#divLoad");

let darkDiv = $('.darkDiv');
let navSite = $('.navSite');
let logoDiv = $('.logo');
let blueBlock = $(".decorate");


//Loading page animation
jQuery(document).ready(function ($) {

    //Animation open 
    line.css('height', '100vh');
    line.css('border-radius', '0');

    paragraph.css("opacity", 0);

    //Change loading to ready when page are load
    if (paragraph.css("opacity", 0)) {

        setTimeout(function () {
            paragraph.text('Ready !');
            paragraph.css("opacity", 1);
        }, 200);
    }

    //Open page and remove loading page when it's done
    if (line.css('height', '100vh')) {

        setTimeout(function () {
            line.css('width', '100vw');
            paragraph.css('background', 'transparent')
            divLoad.css('opacity', 0);

            if (divLoad.css('opacity', 0)) {

                setTimeout(function () {
                    divLoad.remove();

                }, 800);
            }

        }, 1000);

    }

    //Active a animation like in load page when mouse is on logo
    $('.logoLink').hover(function () {
        $('.logoBook1').css("animation", "2s linear infinite boing1");
        $('.logoBook2').css("animation", "2s linear infinite boing1");
        $('.logoBook3').css("animation", "2s linear infinite boing2");
        $('.logoBookOpen').css("animation", "3s infinite ease bookopen alternate")
    });
    //Remove animation when is out
    $('.logoLink').mouseout(function () {
        $('.logoBook1').css("animation", "");
        $('.logoBook2').css("animation", "");
        $('.logoBook3').css("animation", "");
        $('.logoBookOpen').css("animation", "")

    });

    //When window is less than 992 px
    if (window.innerWidth < 992) {      
    
        //If click in logo dropdown of menu appear
        $('#logoLink').click(function() {

            //Display menue
            $(".navSite, .decorate").css({
                "transform": "skew(0deg)",
                "height": "20em",
                "width": "100vw",
                "left": "0",
                "position": "fixed",
            });
            $('.headerIndex').css("align-items", "baseline");

            //Display div and button who we can return to index if they click on
            darkDiv.css('display', 'block');
            $('.close').css("display", "block");

            $('.navList').css("display", "block");
            $('#logo').css("margin", "auto");

            logoDiv.addClass("col-12");
            logoDiv.css({
                "margin": "10px 0",
                'position': 'fixed',
            });

            //Fade in animation
            setTimeout(function () {
                $('.navList').css("opacity", "1");
                $('.close').css("opacity", "1");

            }, 1000);

        });

        //Remove dropdown
        $('.darkDiv, .close').click(function() {
            navSite.css({
                "transform": "skew(-44deg)",
                "width": "320px",
                "left": "-235px",
                "position": "absolute",

            });

            $('.headerIndex').css("align-items", "center");

            blueBlock.css({
                "transform": "skew(-51deg)",
                "left": "-35px",
                "width": "160px",
                "height": "50vh",
                "position": "absolute"
            })

            darkDiv.css('display', 'none');
            $('.navList').css("opacity", "0");
            $(".close").css("display", "none")

            logoDiv.css({
                "margin": "10px",
                "position": "initial",
                "opacity": "0"
            });

            $('.close').css("opacity", "0");
            

            setTimeout(function () {
                $('.navList').css("display", "none");
                logoDiv.removeClass("col-12");
                logoDiv.css("opacity", "1");
                
            }, 1000);
        });

        $(window).scroll(function() {
            
            let scroll = window.scrollY;

            //When menu is not visible a button on top appear
            if (scroll > 300) {
                $(".on_top").css("display", "flex");
            } else {
                $(".on_top").css("display", "none");
            }
        });
    
} else {

    //Animation for reduce element when they are hover in book element
    $('.linkBook').hover(function() {
        $('.cardBook').css("transform", "scale(0.98)")
    });
    $('.linkBook').mouseout(function() {
        $('.cardBook').css("transform", "scale(1)")
    });
}
});
