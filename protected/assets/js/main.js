$(document).ready(function () {


    $('[data-popup-open]').on('click', function (e) {
        e.preventDefault();
        $('#bg-layer').fadeIn(500);
        $('.' + $(this).attr('data-popup-open')).fadeIn(500);
    });

    $('.popup-close').on('click', function (e) {
        e.preventDefault();
        $('#bg-layer').fadeOut(500);
        $(this).parent().parent().fadeOut(500);
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

        $("li:has(a[href='#" + $(this).data("currentTab") + "'])").removeClass("actived");
        $("li:has(a[href='#" + $(this).data("nextTab") + "'])").addClass("actived");

        $(".tab_content").hide();

        $(".tab_content#" + $(this).data("nextTab")).fadeIn();

        return false;
    });

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("actived");
        $(this).addClass("actived");
        $(".tab_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });

});