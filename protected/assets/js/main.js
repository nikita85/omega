$(document).ready(function () {

    var classesCalendar = $('.register');

    if (classesCalendar.length) {

        var curColId = null;

        classesCalendar.on('mouseenter', 'td, th', function () {
            var colId = $(this).attr('data-col-id');
            if (colId != curColId) {
                if ($.isNumeric(curColId)) {
                    classesCalendar.find('[data-col-id=' + curColId + ']').removeClass('hovered');
                }
                if (colId) {
                    classesCalendar.find('[data-col-id=' + colId + ']').addClass('hovered');
                }
                curColId = colId;
            }
        });

        classesCalendar.on('mouseleave', function () {
            if ($.isNumeric(curColId)) {
                classesCalendar.find('[data-col-id=' + curColId + ']').removeClass('hovered');
                curColId = null;
            }
        });

        classesCalendar.on('click', 'tr:gt(6) td[data-col-id]', function () {
            $(this).toggleClass('select');
        });
    }

});