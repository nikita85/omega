/**
 * Created by steblin on 5/22/14.
 */


$(document).ready(function () {

    /*slider*/

    function teacherSlider(teacherTab) {
        this.tab = teacherTab;
        this.slider = teacherTab.find('.tutors-carousel');
        this.sliderWrap = this.slider.find('.slider-wrap');
        this.sliderNextBtn = this.slider.find('.slider_nav.next_');
        this.sliderPrevBtn = this.slider.find('.slider_nav.prev_');
        this.tutors = this.slider.find('.teachers');
        this.curActive = $('.teachers:first');
        this.slideWidth = $(this.tutors[0]).outerWidth(true);
        this.rightVisible = 0;

        var isAnimated = false;
        var self = this;

        makeActive(this.curActive);

        this.tab.find('.teacher_info[data-rel=' + $(this.curActive).attr("id") + ']').show();

        this.tutors.each(function () {
            $(this).on('click', function (e) {

                var target = e && e.target || event.srcElement;


                if (isAnimated || (!$(target).hasClass('tutor-preview') && !$(target).hasClass('full-info'))) {
                    return false;
                }

                if ($(target).hasClass('full-info')) {
                    $('html, body').animate({
                        scrollTop: $(".wrapper-tutors-page").offset().top
                    }, 1000);
                }

                e.preventDefault();

                if (!$(this).hasClass('active')) {

                    isAnimated = true;

                    var curActiveId = self.curActive.attr('id');
                    makeInactive(self.curActive);

                    self.curActive = $(this);
                    var newActiveId = self.curActive.attr('id');
                    makeActive(self.curActive);

                    self.tab.find('.tutor-details[data-rel=' + curActiveId + ']').fadeOut(500, function () {
                        self.tab.find('.tutor-details[data-rel=' + newActiveId + ']').fadeIn(500, function () {
                            isAnimated = false;
                        });
                    });
                }
            });
        });

        if (this.tutors.length > 4) {
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
            if (self.rightVisible <= 4) {
                self.sliderPrevBtn.hide();
            }
            if (self.rightVisible >= self.tutors.length) {
                self.sliderNextBtn.hide();
            }
        }

        function slideToImage(index) {
            self.sliderWrap.css({left: self.slideWidth * -index + 'px'});
            self.rightVisible = index + 4;
            updateSliderButtons();
        }

        function makeActive(teacher) {
            teacher.addClass('active');
        }

        function makeInactive(teacher) {
            teacher.removeClass('active');
        }
    }

    new teacherSlider($('.wrapper-tutors-page'));

    /*end slider*/

});