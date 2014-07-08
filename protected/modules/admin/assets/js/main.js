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
   });


    $('form').on('submit', function(){
        $(this).find('[name*="##uid##"]').attr('name', '');
    });

    /*TIME ROW*/
    $('.timeRow').not('.timeRowTemplate').find('.jqxWidget').each(function(){
        var timeValue = $(this).attr('value');

        $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'hh:mm tt', showCalendarButton: false});

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

        timeRow.find('[name]').each(function(){
            var nameAttr = $(this).attr('name');
            $(this).attr('name' , nameAttr.replace('##uid##', uiid));
            if($(this).hasClass('jqxWidget')){
                $(this).jqxDateTimeInput({ width: '100px', height: '25px', formatString: 'hh:mm tt', showCalendarButton: false});
            }
        });
        timeRow.insertBefore($('.addTimeRow'));
    }
    /*END TIME ROW*/

    /*DATE PERIOD ROW*/

    $('.datePeriodRow').not('.datePeriodRowTemplate').each(function(){
        var row = $(this);
        row.find('.jqxWidget.date').each(function(){
            $(this).jqxDateTimeInput({width: '200px', height: '25px', formatString: 'yyyy-MM-dd'});
        });
        row.find('.jqxWidget.text').each(function(){
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

    /*MONTH PUZZLE*/

    if ($('#monthPuzzle').length){

        var radioButtons = $('input[name="active_month_puzzle"]');

        radioButtons.each(function(){
            if($(this).attr('data-checked') == 1){
                $(this).prop("checked", true);
            }
        });

        radioButtons.on('change', function(){
            var puzzleId = $(this).val();

            $.ajax("switchActivePuzzle", {
                type: 'POST',
                cache: false,
                data: {puzzleId: puzzleId},
                dataType:'JSON',
                success: function(data) {
                    if (data.success) {
                       console.log(data)
                    } else {
                        //window.location.href = "/admin/knowledgeBase/index";
                    }
                }
            });
        });
    }

    /*END MONTH PUZZLE*/

    /*EDIT ORDERS*/

    $('.seminar_edit_block').on('change', '.edit_seminar', function(){
        var seminarId = $(this).val(),
            editBlock = $(this).parent(),
            gradeSelect = editBlock.find('.edit_grade'),
            timeSlotSelect = editBlock.find('.edit_timeSlot'),
            datePeriodSelect = editBlock.find('.edit_datePeriod');


        console.log(editBlock, gradeSelect);


        $.ajax("/admin/orders/getSeminarDetails", {
            type: 'POST',
            cache: false,
            data: {seminarId: seminarId},
            dataType:'JSON',
            success: function(data) {
                if (data.success) {

                   var details = data.details;

                    gradeSelect.empty();
                    timeSlotSelect.empty();
                    datePeriodSelect.empty();

                    $.each(details.grades, function(key, grade) {
                        gradeSelect.append($("<option/>", {
                            value: grade.id,
                            text: grade.title
                        }));
                    });

                    $.each(details.timeSlots, function(key, timeSlot) {
                        timeSlotSelect.append($("<option/>", {
                            value: timeSlot.id,
                            text: timeSlot.title
                        }));
                    });

                    $.each(details.datePeriods, function(key, datePeriod) {
                        datePeriodSelect.append($("<option/>", {
                            value: datePeriod.id,
                            text: datePeriod.title
                        }));
                    });


                } else {
                    //window.location.href = "/admin/knowledgeBase/index";
                }
            }
        });
    });

    /*END EDIT ORDERS*/

    /*SEARCH FILTERS*/

    var modelName = 'EnrollFormSummer';
    $('.search-button').click(function(){
        $('.search-form').slideToggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $('#summer-seminars-grid').yiiGridView('update', {
            data: $(this).serialize()
        });
        return false;
    });

    $('.filter_name').click(function () {
        var filterName = $(this),
            filterContent = $(this).next(),
            filterInputName = filterContent.attr('data-input-name');
        $(this).next().slideToggle(400, function () {
            if ($(this).is(":hidden")) {
                filterName.text(filterName.text().replace('disable', 'enable'));
                $(this).find('select, input').attr('name', '');
            } else {
                filterName.text(filterName.text().replace('enable', 'disable'));
                $(this).find('select, input').attr('name', modelName + '[' + filterInputName + ']');
                if (filterInputName === 'filter_datePeriod') {
                    var curInputName = $(this).find('input:eq( 0 )').attr('name');
                    $(this).find('input:eq( 0 )').attr('name', curInputName + '[start_date]');
                    $(this).find('input:eq( 1 )').attr('name', curInputName + '[end_date]');
                } else if (filterInputName === 'filter_timeSlot') {
                    curInputName = $(this).find('input:eq( 0 )').attr('name');
                    $(this).find('input:eq( 0 )').attr('name', curInputName + '[start_time]');
                    $(this).find('input:eq( 1 )').attr('name', curInputName + '[end_time]');
                }
            }
        })
    });

    setTimeout(function(){
        $('.search-form').find('input, select').each(function(){
            $(this).attr('name', '');
        })
   }, 0);


    /*END SEARCH FILTERS*/

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


});

