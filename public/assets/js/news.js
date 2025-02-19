$(document).ready(function () {
    $('#owl-carousel-news').owlCarousel({
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

    const owl =  $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        dots: true,
        autoplay: true,
        responsive: {
            0: {
                items: 2.2,
                nav: false,
                dots: true,
            },
            600: {
                items: 3,
                nav: false,
                dots: true,
            },
            1000: {
                items: 5,
                nav: false,
                loop: false,
                dots: true,
            }
        }
    })

    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
    });
    $('.customPreviousBtn').click(function() {
        owl.trigger('prev.owl.carousel');
    });


    let numberItem = screen.width >= 768 ? 2 : 1;
    $(".regular_5").slick({
        dots: false,
        infinite: false,
        autoplay: true,
        slidesToShow: numberItem,
        centerMode: true,
        slidesToScroll: 1
    });
    let numberItemNew = screen.width >= 768 ? 3.1 : 1;
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
            infinite: false,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }
    if (window.location.search.includes('?page=')) {
        var top = jQuery('#section-news').height() + jQuery('#block-destination').height();
        if(screen.width >= 1025){
            top = top - 50;
        }
        document.body.scrollTop = top;
        document.documentElement.scrollTop = top;
    }
});
