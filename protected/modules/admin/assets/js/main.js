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
    var myForm = document.getElementById('seminar-form');
    myForm.onsubmit = function() {
        var allInputs = myForm.getElementsByTagName('input');
        var input, i;

        for(i = 0; input = allInputs[i]; i++) {
            if(input.getAttribute('name') && !input.value) {
                input.setAttribute('name', '');
            }
        }
    };

    /*TIME ROW*/
    $('.timeRow').not('.timeRowTemplate').find('.jqxWidget').each(function(){
        var timeValue = $(this).attr('value');

        $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'HH:mm', showCalendarButton: false});

        if(timeValue){
            $(this).jqxDateTimeInput('setDate', new Date(ConvertToDate(timeValue)));
        }
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
            $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'HH:mm', showCalendarButton: false});
        });
        timeRow.insertBefore($('.addTimeRow'));
    }
    /*END TIME ROW*/

    /*DATE PERIOD ROW*/

    $('.datePeriodRow').not('.datePeriodRowTemplate').find('.jqxWidget.date').each(function(){
        var row = $(this);
        row.find('.jqxWidget.date').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            $(this).jqxDateTimeInput({width: '200px', height: '25px', formatString: 'yyyy-MM-dd'});
        });
        row.find('.jqxWidget.text').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            $(this).jqxInput({height: 25, width: 200 });
        });
    });


    function addDatePeriodRow(){
        var row = $('.datePeriodRowTemplate').clone(true).removeClass('datePeriodRowTemplate').show(),
            uiid = guid();

        row.find('.jqxWidget.date').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            $(this).jqxDateTimeInput({width: '200px', height: '25px', formatString: 'yyyy-MM-dd'});
        });
        row.find('.jqxWidget.text').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            $(this).jqxInput({height: 25, width: 200 });
        });
        row.insertBefore($('.addDatePeriodRow'));
    }

    $('.addDatePeriodRow').on('click', function(e){
        addDatePeriodRow();
    });

    $('.removeDatePeriodRow').on('click', function(e){
        $(this).parent().remove();
    });

    /*END DATE PERIOD ROW*/



    function guid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    }

    function ConvertToDate(stringTime)
    {
        var date = new Date();
        hours = stringTime.substr(0,2);
        minutes = stringTime.substr(3,2);
        date.setHours(parseInt(hours));
        date.setMinutes(parseInt(minutes));

        return date;
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

