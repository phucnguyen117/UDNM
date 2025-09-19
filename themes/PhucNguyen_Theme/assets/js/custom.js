jQuery(document).ready(function($) {
    // Hỗ trợ toggle menu đa cấp trên mobile
    $('.menu-item-has-children > a').on('click', function(e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).next('.sub-menu').slideToggle();
        }
    });
});

