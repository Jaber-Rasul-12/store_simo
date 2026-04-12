(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
    
})(jQuery);

$(document).ready(function() {
    var currentRating = 0;
    
    // Star click event
    $('.star-rating i').click(function() {
        currentRating = $(this).data('rating');
        $('#rating').val(currentRating);
        $('.rating-value').text(currentRating + '/5');
        
        // Update stars
        $('.star-rating i').each(function() {
            if ($(this).data('rating') <= currentRating) {
                $(this).removeClass('far').addClass('fas selected');
            } else {
                $(this).removeClass('fas selected').addClass('far');
            }
        });
        
        // Hide error if shown
        $('#rating-error').hide();
    });
    
    // Star hover events
    $('.star-rating i').hover(
        function() { // mouseenter
            var hoverRating = $(this).data('rating');
            $('.star-rating i').each(function() {
                if ($(this).data('rating') <= hoverRating) {
                    $(this).addClass('hover');
                }
            });
        },
        function() { // mouseleave
            $('.star-rating i').removeClass('hover');
        }
    );
    
    // Form submission
    $('#commentForm').submit(function(e) {
        var rating = $('#rating').val();
        
        if (rating == '0' || rating == '') {
            e.preventDefault();
            $('#rating-error').show();
            $('.star-rating').addClass('is-invalid');
            return false;
        }
        
        return true;
    });
    
    // Optional: Reset rating on form reset
    $('#commentForm button[type="reset"]').click(function() {
        currentRating = 0;
        $('#rating').val('0');
        $('.rating-value').text('0/5');
        $('.star-rating i').removeClass('fas selected').addClass('far');
        $('#rating-error').hide();
    });
});