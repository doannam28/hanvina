$(document).ready(function () {
    let numberItem = screen.width >= 768 ? 2 : 1;
    let numberItemNew = screen.width >= 768 ? 3 : 1;
    $(".regular_new").slick({
        dots: screen.width < 768,
        infinite: false,
        autoplay: true,
        slidesToShow: numberItemNew,
        slidesToScroll: 1
    });
    if (screen.width < 768) {
        $(".regular_tg").slick({
            dots: true,
            infinite: true,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }

    $('#mb-values').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        dots: false,
        autoplay: false,
        responsive: {
            0: {
                items: 1.3,
                nav: false,
                dots: false,
            },
            600: {
                items: 3,
                nav: false,
                dots: false,
            },
            1000: {
                items: 5,
                nav: false,
                loop: false,
                dots: false,
            }
        }
    })

    $('#mb-mission').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        dots: false,
        autoplay: false,
        responsive: {
            0: {
                items: 1.2,
                nav: false,
                dots: false,
            },
            600: {
                items: 3,
                nav: false,
                dots: false,
            },
            1000: {
                items: 5,
                nav: false,
                loop: false,
                dots: false,
            }
        }
    })

    const items = $('.value-card-col');

    items.hover(function() {
        items.addClass('item-not-hover');
        $(this).removeClass('item-not-hover').addClass('item-hover');
    }, function() {
        items.removeClass('item-hover item-not-hover');
    });

});
