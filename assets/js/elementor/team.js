(function ($) {
    var RovokoWidgetTeamHandler = function ($scope, $) {
        var $carousel = $scope.find('.rovoko-carousel').eq(0);
        if ($carousel.length > 0) {
            var $settings = $carousel.data('settings');
            //console.log($settings);
            $carousel.owlCarousel({
                rtl: $settings['rtl'],
                loop: $settings['loop'],
                margin: $settings['margin'],
                autoplay: $settings['autoplay'],
                autoplayTimeout: $settings['autoplay_speed'],
                autoplayHoverPause: $settings['pause_on_hover'],
                nav: $settings['nav'],
                navContainer: $carousel.parent().find('.ef5-owl-nav'),
                navClass: ['ef5-owl-nav-button ef5-owl-prev', 'ef5-owl-nav-button ef5-owl-next'],
                navText: ['<span class="flaticon-back"></span>', '<span class="flaticon-next"></span>'],
                dots: $settings['dots'],
                dotsContainer: $carousel.parent().find('.ef5-owl-dots'),
                dotClass: 'ef5-owl-dot',
                center: $settings['center'],
                responsive: {
                    0: {
                        items: $settings['slides_to_show_mobile']
                    },
                    768: {
                        items: $settings['slides_to_show_tablet']
                    },
                    992: {
                        items: $settings['slides_to_show']
                    },
                }
            });

        }
    };

    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_team.default', RovokoWidgetTeamHandler);
    });
})(jQuery);