function getBaseURL() {
    return location.protocol + "//" + location.hostname + (location.port != "" ? ':' + location.port : '');
}
function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    num = Math.floor(num / 100).toString();
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' +
            num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num);
}

var TOURS = {
    init: function () {
        $('#btn-filter').click(function () {
            $('#div-filter-mobile').addClass('div-filter');
        });
        $('#span-close').click(function () {
            $('#div-filter-mobile').removeClass('div-filter');
        });
        $('.btn-search-filter').click(function () {
            var idForm = $(this).attr("data-id-form");
            if(idForm === "frm-filter-mobile"){
                $('#frm-filter-mobile #span-close').click();
            }
            TOURS.filter_tours(idForm, 1);
        });
        $('#div-page').on('click', '.page-link', function () {
            var idForm = screen.width >= 768 ? "frm-filter" : "frm-filter-mobile",
                link = $(this).attr('href'), page = 1;
            if (link.indexOf("#?page=") > -1) {
                link = link.split("#?page=");
                page = parseInt(link[1]);
                TOURS.filter_tours(idForm, page);
            }
            TOURS.gotoTop();
        });
        $('.btn-clear-filter').click(function () {
            var idForm = $(this).attr("data-id-form");
            $('#' + idForm)[0].reset();
            $('.price-range-field').css("background", "#E6E6E6");
            $('.bubble').hide();
            $('.max_day').val(0);
            $('.max_price').val(0);
            if(idForm === "frm-filter-mobile"){
                $('#frm-filter-mobile #span-close').click();
            }
            TOURS.filter_tours(idForm, 1);
        });
        $('.price-range-field').change(function () {
            if ($(this).val() == "0") {
                $(this).next('.bubble').hide();
            } else {
                $(this).next('.bubble').show();
            }
        })
        TOURS.getDataFilter();
    },
    filter: function () {
        const allRanges = document.querySelectorAll(".range-wrap");
        allRanges.forEach(wrap => {
            const range = wrap.querySelector(".range");
            const bubble = wrap.querySelector(".bubble");

            range.addEventListener("input", () => {
                setBubble(range, bubble);
            });
            setBubble(range, bubble);
        });

        function setBubble(range, bubble) {
            const val = range.value;
            const min = range.min ? range.min : 0;
            const max = range.max ? range.max : 100;
            const newVal = Number(((val - min) * 100) / (max - min));
            bubble.innerHTML = formatCurrency(val) + bubble.getAttribute('data');

            // Sorta magic numbers based on size of the native UI thumb
            bubble.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`;
            if (val > 0) bubble.style.display = 'block';
        }
    },
    updatePrice: function (formId) {
        var priceDiscount = parseInt($('#price_discount').val()),
            numberHuman = parseInt($('#' + formId + ' .number_human').val()),
            element = $('#' + formId + ' .select-date').find('option:selected'),
            price = element.attr("data"),
            priceTotal = numberHuman * price;
        $('#' + formId + ' .p_price').html(formatCurrency(priceTotal) + 'vnđ');
        $('#' + formId + ' .p_price_total').html(formatCurrency(priceTotal - priceDiscount) + 'vnđ');
    },
    detail_tour: function () {
        var maxDay = parseInt($('#max_number_day').val());
        $('#block-date-tour').on('click', ".item-day", function () {
            var day = parseInt($(this).attr('data'));
            $('.item-day').removeClass('slick-selected');
            $('.item-day' + day).addClass('slick-selected');
            $('#number_day').val(day);
        });
        $('#block-date-tour').on('click', ".owl-next", function () {
            var day = parseInt($('#number_day').val());
            if (day < maxDay) {
                $('#number_day').val(++day);
                $('.item-day').removeClass('slick-selected');
                $('.item-day' + day).addClass('slick-selected');
                $('#number_day').val(day);
            }
        });
        $('#block-date-tour').on('click', ".owl-prev", function () {
            var day = parseInt($('#number_day').val());
            if (day > 1) {
                $('#number_day').val(--day);
                $('.item-day').removeClass('slick-selected');
                $('.item-day' + day).addClass('slick-selected');
                $('#number_day').val(day);
            }
        });
        $('.title-tab').click(function () {
            var num = $(this).attr('data');
            const parent = $(this).closest('.div-tab').parent();
            const parentTab = $(this).closest('.slick-list');
            $(parentTab).find('.title-tab').removeClass('title-tab-active');
            $(this).addClass('title-tab-active');
            $(parent).children('.div-content-tab').hide();
            $(parent).children('.div-content-tab' + num).show();
            $(parent).children('.regular_tab' + num).slick('refresh');
        });
        $('.p-sub').click(function () {
            var formId = $(this).attr('form-id'),
                number = parseInt($('#' + formId + ' .number_human').val());
            if (number > 1) {
                $('#' + formId + ' .number_human').val(--number);
            }
            TOURS.updatePrice($(this).attr('form-id'));
        });
        $('.number_human').change(function () {
            var number = parseInt($(this).val());
            if (isNaN(number)) number = 1;
            $(this).val(parseInt(number));
            TOURS.updatePrice($(this).attr('form-id'));
        });
        $('.select-date').change(function () {
            TOURS.updatePrice($(this).attr('form-id'));
        });
        $('.p-add').click(function () {
            var formId = $(this).attr('form-id'),
                number = parseInt($('#' + formId + ' .number_human').val());
            $('#' + formId + ' .number_human').val(++number);
            TOURS.updatePrice($(this).attr('form-id'));
        });
        setTimeout(function () {
            $('.div-bor-date-active').each(function () {
                const height = $(this)[0].scrollHeight;
                $(this).css('height', height + 'px');
            });
        }, 300)
        $('.div-mt').click(function () {
            const height = $(this).parent()[0].scrollHeight;
            if ($(this).parent().hasClass('div-bor-date-active')) {
                $(this).parent().css('height', '');
                $(this).parent().removeClass('div-bor-default')
                $(this).parent().removeClass('div-bor-date-active')
            } else {
                $(this).parent().css('height', height + 'px');
                $(this).parent().addClass('div-bor-date-active');
            }
        });
        $('.div-txt-tab').click(function () {
            const stt = $(this).attr('data');
            const parent = $('.div-bor-date' + stt);
            if (parent.hasClass('div-bor-date-active')) {
                parent.css('height', '');
                parent.removeClass('div-bor-default')
                parent.removeClass('div-bor-date-active')
            } else {
                parent.css('height', parent[0].scrollHeight + 'px');
                parent.addClass('div-bor-date-active');
            }
        });
    },
    submit_booking: function () {
        jQuery('.btn-booking').click(function () {
            var idForm = jQuery(this).attr('data-id');
            var form = jQuery("#" + idForm), elmBtn = jQuery("#" + idForm + ' .btn-booking');
            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                elmBtn.prop("disabled", true);
                elmBtn.addClass("btn-disabled");
                var data = form.serialize();
                jQuery.ajax({
                    type: 'POST',
                    url: getBaseURL() + '/submit-booking',
                    data: data,
                    success: function (data) {
                        elmBtn.prop("disabled", false);
                        elmBtn.removeClass("btn-disabled");
                        if (data.status == 'error') {
                            toastr.warning(data.msg);
                        } else {
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
        /* $('#p_close_booking').click(function () {
             $('#wrapper-booking').removeClass("wrapper-booking");
         });
         $('#p-icon-booking').click(function () {
             if($('#wrapper-booking').hasClass("wrapper-booking")){
                 $('#wrapper-booking').removeClass("wrapper-booking");
             }else{
                 $('#wrapper-booking').addClass("wrapper-booking");
             }
         });*/
    },

    getDataFilter: function () {
        $('#div-page').on('click', 'a', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            jQuery.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (msg) {
                    if (msg.count == 0) {
                        jQuery('#content-tours').html("<h3 class='text-center h3-no-tour'>Không có tour nào thỏa mãn điều kiện tìm!</h3>")
                        jQuery('#div-page').html('');
                    } else {
                        jQuery('#content-tours').html(msg.rows);
                        jQuery('#div-page').html(msg.paging);
                        jQuery('.page').html(msg.page);
                    }
                }
            })

        });
    },

    gotoTop: function () {
        var top = jQuery('#owl-carousel-tour').height();
        if(screen.width >= 1025){
            top = top - 110;
        }else{
            top = top - 10;
        }
        document.body.scrollTop = top;
        document.documentElement.scrollTop = top;
    },
    filter_tours: function (idForm, page) {
        var form = jQuery("#" + idForm);
        if (page) {
            jQuery(".page").val(page);
        }
        if(screen.width >= 1400){
            jQuery(".limit").val(9);
        }else{
            jQuery(".limit").val(6);
        }
        var data = form.serialize();
        jQuery.ajax({
            url: getBaseURL() + '/filter-tour',
            type: 'get',
            dataType: 'json',
            data: data,
            success: function (msg) {
                if (msg.count == 0) {
                    jQuery('#content-tours').html("<h3 class='text-center h3-no-tour'>Không có tour nào thỏa mãn điều kiện tìm!</h3>")
                    jQuery('#div-page').html('');
                } else {
                    jQuery('#content-tours').html(msg.rows);
                    jQuery('#div-page').html(msg.paging);
                    jQuery('.page').html(msg.page);
                }
                //TOURS.gotoTop();
            }
        })
    },
    search_tours: function(){
        $('#inp-search').on('input', function() {
            jQuery('#inp-search-mobile').val(jQuery('#inp-search').val());
            TOURS.filter_tours('frm-filter-mobile', 1);
        });
    },
}
jQuery(document).ready(function () {
    TOURS.init();
    TOURS.filter();
    TOURS.search_tours();
    TOURS.detail_tour();
    TOURS.submit_booking();
    TOURS.filter_tours("frm-filter", 1);
})
