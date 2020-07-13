(function ($) {
    var RovokoWidgetImageGalleryHandler = function ($scope, $) {
        var $gallery = $scope.find('.rovoko-image-gallery').eq(0);
        if ($gallery.length > 0) {
            var $settings = $gallery.data('settings');
            $gallery.fotorama({
                direction: $settings['rtl'],
                minwidth: '100%',
                navwidth: '100%',
                nav: $settings['nav'],
                navposition: $settings['navposition'],
                thumbwidth: $settings['thumbsize']['width'],
                thumbheight: $settings['thumbsize']['height'],
                thumbmargin: $settings['margin'],
                thumbborderwidth: $settings['thumbborderwidth'],
                arrows: $settings['arrows'],
                loop: $settings['loop'],
                allowfullscreen: $settings['allowfullscreen'],
                click: $settings['click'],
                swipe: $settings['swipe'],
                autoplay: $settings['autoplay'],
                ratio: $settings['ratio'],
            });
            console.log($settings);
        }
    };

    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_image_gallery.default', RovokoWidgetImageGalleryHandler);
    });
})(jQuery);