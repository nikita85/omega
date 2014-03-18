$(document).ready(function () {

    var classesCalendar = $('.register');

    if (classesCalendar.length) {

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
                                if (!enrollmentForm.checkForFullSelection()) {
                                    enrollmentForm.confirmButton.removeClass('table-button-active');
                                }
                                return;
                            }
                        }

                        $(this).addClass('select');
                        curColumn[cellType + 'Selection'] = $(this);

                        if (enrollmentForm.checkForFullSelection()) {
                            enrollmentForm.confirmButton.addClass('table-button-active');
                        }
                    };

                }(column, cellType));
            }
        }

        var enrollmentForm = {
            node: classesCalendar,
            curColId: null,
            selectableColCount: 7,
            infoColumn: $('.register tr td:not([data-col-id])'),
            columns: [],
            confirmButton: $('.table-button')
        };

        enrollmentForm.checkForFullSelection = function () {
            var fullSelection = false;

            for (var i = 0; i < enrollmentForm.columns.length; i++) {
                if (enrollmentForm.columns[i].hasFullSelection()) {
                    fullSelection = true;
                    break;
                }
            }

            return fullSelection;
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
                    return curColumn.timeSelection && curColumn.gradeSelection && curColumn.weekSelection;
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

            attachColumnClicks(column);

            enrollmentForm.columns.push(column);
        }

        enrollmentForm.node.on('mouseleave', function () {
            deselectHoveredColumn();
            enrollmentForm.curColId = null;
        });

        enrollmentForm.infoColumn.on('mouseenter', function () {
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
    }

});