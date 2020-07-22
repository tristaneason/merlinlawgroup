(function($) {
    // to set first item to active
    //$('.accordion > li:eq(0) a').addClass('active').next().slideDown();

    $('.accordion a, #attorney-filter-search').click(function(e) {
        var dropDown = $(this).closest('li').find('.accordion-answer');
        var dropDownDiv = $('.attorney-filter-cats');

        $(dropDownDiv).toggleClass('block');
        $(this).closest('.accordion').find('.accordion-answer').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');

        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');

        }

        dropDown.stop(false, true).slideToggle();

        e.preventDefault();
    });
})(jQuery);
