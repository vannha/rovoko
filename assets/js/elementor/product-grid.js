(function ($) {
    var RovokoWidgetProductsHandler = function ($scope, $) {
        var $product_grid = $scope.find('.rovoko-product-wrapper').eq(0);
        if ($product_grid.length > 0) {
            var $id = $product_grid.attr('id'),
                $loading_class = 'loading';
            $product_grid.find('.view-all-btn a.ef5-btn').live('click', function () {
                var $this = $(this),
                    $link = $this.attr('href');
                $this.addClass($loading_class);
                jQuery.get($link, function (data) {
                    $product_grid.removeClass($loading_class);
                    var items = $(data).find('#' + $id).find('.products').html().replace('<div class="ef5-masonry-sizer"></div>', '').replace('<div class="ef5-masonry-gutter"></div>', '');
                    $product_grid.find('.ef5-posts-masonry').imagesLoaded(function () {
                        $product_grid.find('.ef5-posts-masonry').append(items).isotope('appended', items);
                        $product_grid.find('.ef5-posts-masonry').isotope('reloadItems');
                    });
                    $product_grid.find('.view-all-btn a.ef5-btn').removeClass($loading_class);
                    if ($(data).find('#' + $id).find('.view-all-btn').length > 0) {
                        var newlink = $(data).find('#' + $id).find('.view-all-btn a').attr('href');
                        $product_grid.find('.view-all-btn a').attr('href', newlink);
                    } else {
                        $product_grid.find('.view-all-btn').remove();
                    }
                });
                return false;
            });
        }
    };
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_product_grid.default', RovokoWidgetProductsHandler);
    });
})(jQuery);