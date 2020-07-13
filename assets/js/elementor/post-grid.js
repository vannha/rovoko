(function ($) {
    var RovokoWidgetPostsHandler = function ($scope, $) {
        var $project_grid = $scope.find('.rovoko-post-wrapper').eq(0);
        if ($project_grid.length > 0) {
            var $id = $project_grid.attr('id'),
                $loading_class = 'loading';
            $project_grid.find('.view-all-btn a.ef5-btn').live('click', function () {
                //console.log($id);
                var $this = $(this),
                    $link = $this.attr('href');
                $this.addClass($loading_class);
                jQuery.get($link, function (data) {
                    $project_grid.removeClass($loading_class);
                    var $items = $(data).find('#' + $id).find('.articles').html();
                    $project_grid.find('.articles').append($items).show('slow');
                    $project_grid.find('.view-all-btn a.ef5-btn').removeClass($loading_class);
                    if ($(data).find('#' + $id).find('.view-all-btn').length > 0) {
                        var newlink = $(data).find('#' + $id).find('.view-all-btn a').attr('href');
                        $project_grid.find('.view-all-btn a').attr('href', newlink);
                    } else {
                        $project_grid.find('.view-all-btn').remove();
                    }
                });
                return false;
            });
        }
    };
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_post_grid.default', RovokoWidgetPostsHandler);
    });
})(jQuery);