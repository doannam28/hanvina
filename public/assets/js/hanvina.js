function getBaseURL () {
    return location.protocol + "//" + location.hostname+(location.port!=""?':'+location.port:'');
}

let pageYOffset = window.scrollY;
const HANVINA = {
    strip_tags: function (input, allowed) {
        input = input.trim();
        allowed = (((allowed || '') + '')
            .toLowerCase()
            .match(/<[a-z][a-z0-9]*>/g) || [])
            .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
        const tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
            commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
        return input.replace(commentsAndPhpTags, '')
            .replace(tags, function ($0, $1) {
                return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
    },
    init: function () {
        // Get the video
        $('.div-muted').click(function(){
            var video = document.getElementById($(this).attr('data'));
            if (video.muted) {
                video.muted = false;
                $(this).addClass("muted-on");
            } else {
                video.muted = true;
                $(this).removeClass("muted-on");
            }
        })
        $('input,textarea').change(function () {
            $(this).val(HANVINA.strip_tags($(this).val()));
        });
    },
    scroll: function () {
        function scrolled(event) {
            const isChange = $('#wrapper-menu').data('no-change');
            if(isChange){
                if ((pageYOffset > window.scrollY && window.scrollY > 120) || window.scrollY <= 120) {
                    //$('.navbar-red').css({opacity: 1,transition: "opacity 1s"});
                    $('.navbar-red').css({opacity: 1});
                } else{
                    //$(".navbar-red").css({opacity: 0,transition: "opacity 1s"});
                    $(".navbar-red").css({opacity: 0});
                }
            }
            else{
                if (pageYOffset > window.scrollY && window.scrollY > 120) {
                    //$(".navbar-white").css({opacity: 0,transition: "opacity 1s"});
                    //$(".navbar-red-scoll").css({opacity: 1,transition: "opacity 1s"});
                    $(".navbar-white").css({opacity: 0});
                    $(".navbar-red-scoll").css({opacity: 1});
                } else {
                    //$(".navbar-red-scoll").css({opacity: 0,transition: "opacity 1s"});
                    //$(".navbar-white").css({opacity: 1,transition: "opacity 1s"});
                    $(".navbar-red-scoll").css({opacity: 0});
                    $(".navbar-white").css({opacity: 1});
                }
            }
            pageYOffset = window.scrollY;
        }

        window.addEventListener('scroll', scrolled);
    },
    menuClick: function () {
        $(".navbar").on("click",".navbar-toggler",function(){
            var parent = $(this).attr('data-id');
            if($(this).hasClass("collapsed")){
                $(".menu_mobi").removeClass("active")
                //$("."+parent+" .menu_mobi").removeClass("active");
                $(".navbar-white").removeClass("navbar-red-open");
            }else{
                $("."+parent+" .menu_mobi").addClass("active");
                $(".navbar-white").addClass("navbar-red-open");
            }
        });
        $('#navbarSupportedContent').on('shown.bs.collapse', function () {
            $('body').addClass('no-scroll');
        });
        $('#navbarSupportedContent').on('hidden.bs.collapse', function () {
            $('body').removeClass('no-scroll');
        });
    },
    scrollMobile: function () {
        function scrolled(event) {
            if($('.navbar .navbar-toggler').hasClass("collapsed")) {
                const isChange = $('#wrapper-menu').data('no-change');
                if (isChange) {
                    if ((pageYOffset > window.scrollY && window.scrollY > 120) || window.scrollY <= 120) {
                        $('.navbar-red').css({opacity: 1, transition: "opacity 1s"});
                    } else {
                        $(".navbar-red").css({opacity: 0, transition: "opacity 1s"});
                    }
                } else {
                    if (window.scrollY < 120) {
                        $(".navbar-white").css({opacity: 1, transition: "opacity 1s"});
                        $(".navbar-red-scoll").css({opacity: 0, transition: "opacity 1s", top: "-200px"});
                    } else {
                        $(".navbar-white").css({opacity: 0, transition: "opacity 1s"});
                        if ((pageYOffset > window.scrollY && window.scrollY > 120)) {
                            $(".navbar-red-scoll").css({opacity: 1, transition: "opacity 1s", top: "0px"});
                        } else {
                            $(".navbar-red-scoll").css({opacity: 0, transition: "opacity 1s", top: "-200px"});
                        }
                    }
                }
                pageYOffset = window.scrollY;
            }
            $('.navbar-collapse.show').parent().parent().css("opacity","1");
        }
        window.addEventListener('scroll', scrolled);
    },
    submitPhone: function () {
        $('#btn-phone').click(function () {
            if ($('#input-phone').val() == "") {
                $('#input-phone').focus();
            }
            var idForm = 'register-phone';
            var form = jQuery("#"+idForm), elmBtn = jQuery("#"+idForm+' #btn-phone');
            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                elmBtn.prop("disabled", true);
                elmBtn.addClass("btn-disabled");
                var data = form.serialize();
                jQuery.ajax({
                    type : 'POST',
                    url  : getBaseURL()+'/register-phone',
                    data : data,
                    success :  function(data)
                    {
                        elmBtn.prop("disabled", false);
                        elmBtn.removeClass("btn-disabled");
                        if(data.status == 'error'){
                            toastr.warning(data.msg);
                        }else{
                            toastr.success(data.msg);
                            form[0].reset();
                            form.removeClass('was-validated');
                        }
                    },
                    error: function () {
                        elmBtn.prop("disabled", false);
                        elmBtn.removeClass("btn-disabled");
                        toastr.error('ERROR!');
                    }
                });
            }
            form.addClass('was-validated');
        });
    }
};
jQuery(document).ready(function(){
    HANVINA.init();
    if(screen.width >= 992) {
        HANVINA.scroll();
    }else{
        HANVINA.scrollMobile();
        HANVINA.menuClick();
    }
    HANVINA.submitPhone();
})
