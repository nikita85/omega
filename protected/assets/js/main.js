$(document).ready(function () {


    $('[data-popup-open]').on('click', function (e) {
        e.preventDefault();
        $('#bg-layer').fadeIn(500);
        $('.' + $(this).attr('data-popup-open')).fadeIn(500);
    });

    $('.popup-close, .thank-close').on('click', function (e) {
        e.preventDefault();
        $('#bg-layer').fadeOut(500);
        $(this).parents('.popup').fadeOut(500);
    });

    /* Apploicant Form */
    $('.cv_file_name').val('');

    $('.applicant_back_to_form').on('click', function (e) {
        e.preventDefault();
        $('.applicant_form_success').hide();
        $('#applicant-form').show();
    });


    var link = window.location.pathname;
    $('.header-menu li a[href="' + link + '"]').parent().addClass('active');

    /* tabs */


    $(".tab_content").hide();
    $("ul.tabs li:first").addClass("actived").show();
    $(".tab_content:first").show();


    $(".js-continue-button").click(function () {
        var tabIsValid = true;
        $(this).parent().find(".label-name.required:not([for*=gender])").each(function(){
            var inputBlock = $(this).next(),
                input = inputBlock.find('input');
            if(!input.val()){
                tabIsValid = false;
                input.addClass('input-error');
            } else {
                if(input.attr('type') === 'email' && !isValidEmailAddress(input.val())) {
                    tabIsValid = false;
                    input.addClass('input-error');
                }
            }
        });

        if(!tabIsValid){
            return;
        }

        $("li:has(a[href='#" + $(this).data("currentTab") + "'])").removeClass("actived");
        $("li:has(a[href='#" + $(this).data("nextTab") + "'])").addClass("actived");

        $(".tab_content").hide();

        $(".tab_content#" + $(this).data("nextTab")).fadeIn();

        return false;
    });

    $("ul.tabs li").click(function (e) {
        e.preventDefault();
       /* $("ul.tabs li").removeClass("actived");
        $(this).addClass("actived");
        $(".tab_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;*/
    });


    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    };
});