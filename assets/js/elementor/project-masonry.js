(function ($) {
    var RovokoWidgetProjectsHandler = function ($scope, $) {
        var $project_masonry = $scope.find('.rovoko-project-wrapper').eq(0);
        if ($project_masonry.length > 0) {
            var $id = $project_masonry.attr('id'),
                $loading_class = 'loading';
            $project_masonry.find('.view-all-btn a.ef5-btn').live('click', function () {
                var $this = $(this),
                    $link = $this.attr('href');
                $this.addClass($loading_class);
                jQuery.get($link, function (data) {
                    $project_masonry.removeClass($loading_class);
                    var items = $(data).find('#' + $id).find('.projects').html().replace('<div class="ef5-masonry-sizer"></div>', '').replace('<div class="ef5-masonry-gutter"></div>', '');
                    $project_masonry.find('.ef5-posts-masonry').imagesLoaded(function () {
                        $project_masonry.find('.ef5-posts-masonry').append(items).isotope('appended', items);
                        $project_masonry.find('.ef5-posts-masonry').isotope('reloadItems');
                    });
                    $project_masonry.find('.view-all-btn a.ef5-btn').removeClass($loading_class);
                    if ($(data).find('#' + $id).find('.view-all-btn').length > 0) {
                        var newlink = $(data).find('#' + $id).find('.view-all-btn a').attr('href');
                        $project_masonry.find('.view-all-btn a').attr('href', newlink);
                    } else {
                        $project_masonry.find('.view-all-btn').remove();
                    }
                });
                return false;
            });
        }
    };
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_project_masonry.default', RovokoWidgetProjectsHandler);
    });
})(jQuery);