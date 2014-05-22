/**
 * Created by steblin on 5/22/14.
 */


$(document).ready(function () {

    /*slider*/

    function teacherSlider(teacherTab) {
        this.tab = teacherTab;
        this.slider = teacherTab.find('.for_teacher_slider');
        this.sliderWrap = this.slider.find('.slider_wrap');
        this.sliderNextBtn = this.slider.find('.slider_nav.next_');
        this.sliderPrevBtn = this.slider.find('.slider_nav.prev_');
        this.teacherImages = this.slider.find('.teachers_img');
        this.curActive = this.tab.find('.teachers_img.active') || $('.teachers_img:first');
        this.slideWidth = $(this.teacherImages[0]).outerWidth(true);
        this.rightVisible = 0;

        var isAnimated = false;
        var self = this;

        makeActive(this.curActive);
        this.tab.find('.teacher_info[data-rel=' + $(this.curActive).attr("id") + ']').show();

        this.teacherImages.each(function () {
            $(this).on('click', function () {

                if (isAnimated || $(this).hasClass('active')) {
                    return false;
                }
                isAnimated = true;

                var curActiveId = self.curActive.attr('id');
                makeInactive(self.curActive);

                self.curActive = $(this);
                var newActiveId = self.curActive.attr('id');
                makeActive(self.curActive);

                self.tab.find('.teacher_info[data-rel=' + curActiveId + ']').fadeOut(500, function () {
                    self.tab.find('.teacher_info[data-rel=' + newActiveId + ']').fadeIn(500, function () {
                        isAnimated = false;
                    });
                });
            });
        });

        if (this.teacherImages.length > 6) {
            slideToImage(this.curActive.index());
            this.sliderNextBtn.click(function () {

                if (isAnimated) {
                    return false;
                }
                isAnimated = true;
                self.rightVisible++;
                self.sliderPrevBtn.show();
                self.sliderWrap.animate({left: "-=" + self.slideWidth}, function () {
                    updateSliderButtons();
                    isAnimated = false;
                });
            });

            this.sliderPrevBtn.click(function () {
                if (isAnimated) {
                    return false;
                }
                isAnimated = true;
                self.rightVisible--;
                self.sliderNextBtn.show();
                self.sliderWrap.animate({left: "+=" + self.slideWidth}, function () {
                    updateSliderButtons();
                    isAnimated = false;
                });
            });
        } else {
            this.sliderNextBtn.hide();
            this.sliderPrevBtn.hide();
        }

        function updateSliderButtons() {
            if (self.rightVisible <= 6) {
                self.sliderPrevBtn.hide();
            }
            if (self.rightVisible >= self.teacherImages.length) {
                self.sliderNextBtn.hide();
            }
        }

        function slideToImage(index) {
            self.sliderWrap.css({left: self.slideWidth * -index + 'px'});
            self.rightVisible = index + 6;
            updateSliderButtons();
        }

        function makeActive(teacher) {
            var curPos = teacher.backgroundPosition().split(' ');
            var newPos = curPos;
            newPos[1] = '-100px';
            newPos = newPos.join(' ');

            teacher.css({backgroundPosition: newPos});
            teacher.addClass('active');
        }

        function makeInactive(teacher) {

            var curPos = teacher.backgroundPosition().split(' ');
            var newPos = curPos;
            newPos[1] = '0px';
            newPos = newPos.join(' ');

            teacher.css({backgroundPosition: newPos});
            teacher.removeClass('active');
        }
    }

    if ($('.teachers_tabs').length) {
        $('.tab_container > div').each(function () {
            new teacherSlider($(this));
        });
    }

    /*end slider*/

});