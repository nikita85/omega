$(document).ready(function () {

    var classesCalendar = $('.register');

    if (classesCalendar.length) {
        /*
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
         });*/

        $('.popup-messsage-table-button').on('click', function () {
            $(this).parent().fadeOut(500);
        });


        function attachColumnClicks(column) {
            var cellTypes = ['week', 'time', 'grade'];

            for (var i = 0; i < cellTypes.length; i++) {

                var cellType = cellTypes[i];

                column[cellType + 'SelectCells'].on('click', function (curColumn, cellType) {

                    return function () {
                        var selection = curColumn[cellType + 'Selection'];

                        if (selection) {
                            selection.removeClass('select');
                            if (selection[0] == $(this)[0]) {
                                selection.removeClass('select');
                                curColumn[cellType + 'Selection'] = null;
                                return;
                            }
                        }

                        $(this).addClass('select');
                        curColumn[cellType + 'Selection'] = $(this);
                    };

                }(column, cellType));

            }
        }

        var enrollmentForm = {
            node: $('.register'),
            curColId: null,
            selectableColCount: 7,
            columns: []
        };

        for (var i = 1; i <= enrollmentForm.selectableColCount; i++) {
            var column = {
                id: i,
                node: enrollmentForm.node.find('[data-col-id=' + i + ']'),
                head: enrollmentForm.node.find('th[data-col-id=' + i + ']'),
                timeSelectCells: enrollmentForm.node.find('td[data-col-id=' + i + '][data-cell-type="time"]'),
                gradeSelectCells: enrollmentForm.node.find('td[data-col-id=' + i + '][data-cell-type="grade"]'),
                weekSelectCells: enrollmentForm.node.find('td[data-col-id=' + i + ']:not([data-cell-type])'),
                timeSelection: null,
                gradeSelection: null,
                weekSelection: null
            };

            column.hasSelection = function (curColumn) {
                return function () {
                    return curColumn.timeSelection || curColumn.gradeSelection || curColumn.weekSelection;
                }
            }(column);

            column.hasFullSelection = function (curColumn) {
                return function () {
                    if (curColumn.timeSelection && curColumn.gradeSelection && curColumn.weekSelection) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }(column);

            column.node.on('mouseenter', function (curColumn) {

                return function () {
                    if (enrollmentForm.curColId != curColumn.id) {
                        if (enrollmentForm.curColId) {
                            deselectHoveredColumn();
                        }

                        curColumn.node.addClass('hovered');
                        enrollmentForm.curColId = curColumn.id;
                    }
                };

            }(column));

            /*            column.weekSelectCells.on('click', function (curColumn) {

             return function () {
             if (curColumn.weekSelection) {
             curColumn.weekSelection.removeClass('select');
             if(curColumn.weekSelection[0] == $(this)[0]) {
             curColumn.weekSelection.removeClass('select');
             curColumn.weekSelection = null;
             return;
             }
             }

             $(this).addClass('select');
             curColumn.weekSelection = $(this);
             };

             }(column));*/
            attachColumnClicks(column);

            enrollmentForm.columns.push(column);
        }
        // hallo();
        enrollmentForm.node.on('mouseleave', function () {
            deselectHoveredColumn();
            enrollmentForm.curColId = null;
        });

        function deselectHoveredColumn() {
            if (enrollmentForm.curColId) {
                var hoveredColumn = enrollmentForm.columns[enrollmentForm.curColId - 1];

                if (!hoveredColumn.hasSelection()) {
                    hoveredColumn.node.removeClass('hovered');
                }
            }

        }


        console.log(enrollmentForm);


    }

});