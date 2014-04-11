/**
 * Created with JetBrains PhpStorm.
 * User: steale
 * Date: 6/14/13
 * Time: 4:00 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ajaxStart(function () {
    showLayer();
});

$(document).ajaxStop(function () {
    hideLayer();
});

function showLayer(){
    $('#layer_container').css({'opacity':0}).show().animate({'opacity':0.7},500);
}

function hideLayer(){
    $('#layer_container').animate({'opacity':0}, 500, function(){$(this).hide()});
}

function emulationButtonEnable(){
    if ($( "input:checked").length>0){
        $(".bulkActionsDeleteBtn, .bulkActionsEditBtn").removeClass('disabled');
    }
    else{
        $(".bulkActionsDeleteBtn, .bulkActionsEditBtn").addClass('disabled');
    }
}

$(document).ready(function(){
   $(".logoImage").click(function(){
      location.pathname="/";
//      location.reload();
   });

    $('.timeRow').not('.timeRowTemplate').find('.jqxWidget').each(function(){
        $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'T', showCalendarButton: false});
    });

    $('.addTimeRow').on('click', function(e){
        addTimeRow();
    });

    $('.removeTimeRow').on('click', function(e){
        $(this).parent().remove();
    });

    function addTimeRow(){
        var timeRow = $('.timeRowTemplate').clone(true).removeClass('timeRowTemplate').show(),
            uiid = guid();

        timeRow.find('.jqxWidget').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'T', showCalendarButton: false});
           // console.log(nameAttr.replace('##uid##', guid()));
        });
        timeRow.insertBefore($('.addTimeRow'));
    }

    function guid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }

    //addTimeRow();

/*    $(".checkbox-column input").change(emulationButtonEnable);


    window.alert = function(message, title) {
        $('#error-alert-window .modal-header h3').html(title);
        $('#error-alert-window .modal-body').html(message);

        $('#error-alert-window').modal();

    };

    window.alert.error = function(message) {
        window.alert(message, 'Ошибка');
    };*/

});

